<?php

namespace App\Http\Controllers;

use App\Http\Requests\Events\AccessEventRequest;
use App\Http\Requests\Events\StoreEventAccessRequest;
use App\Models\Event;
use App\Models\EventAccess;
use App\Models\EventType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EventAccessController extends Controller
{
    public function show(AccessEventRequest $request, string $path)
    {
        $event = Event::where('event_folder_path', $path)->firstOrFail();
        $event->loadMissing('pictures', 'category');

        // Check if event is inactive
        if (!$event->is_active) {
            // Admins can still view inactive events
            if (!Auth::check()) {
                return view('events.access.auth', ['path' => $path, 'error' => 'This event is currently inactive and cannot be accessed.']);
            }
        }

        if ($event->event_type === EventType::PRIVATE) {
            // Authenticated admin users don't need access code
            if (Auth::check()) {
                return view('events.access.show', compact('event'));
            }

            // Guest users need access code
            if ($request->missing('access_code')) {
                return view('events.access.auth', compact('path'));
            }

            $access = $event->eventAccesses->where(fn ($a) => decrypt($a->access_code) === $request->input('access_code'))->first();

            if (is_null($access)) {
                return view('events.access.auth', ['path' => $path, 'error' => 'Your access code is invalid. Please check your input and try again.']);
            }

            if (!$access->is_active) {
                return view('events.access.auth', ['path' => $path, 'error' => 'This event link is no longer active. Please ask your designated contact for access.']);
            }

            // Update last used date and increment use count
            $access->update(['last_used_date' => now()]);
            $access->increment('use_count');

            return view('events.access.show', compact('access', 'event'));
        }

        return view('events.access.show', compact('event'));
    }

    public function destroy(EventAccess $access)
    {
        $access->delete();
        return redirect()->back()->with('success', 'Access successfully deleted');
    }

    public function toggle(EventAccess $access)
    {
        $access->update([
            'is_active' => !$access->is_active
        ]);
        return redirect()->back()->with('success', sprintf('Access successfully %s.', $access->is_active ? 'activated' : 'deactivated'));
    }

    public function store(StoreEventAccessRequest $request, Event $event)
    {
        $code = $request->input('access_code');

        if (!$code) {
            // Auto-generate a unique code
            do {
                $code = Str::random(10);
                $exists = EventAccess::all()->first(function ($access) use ($code) {
                    try {
                        return decrypt($access->access_code) === $code;
                    } catch (\Exception $e) {
                        return false;
                    }
                });
            } while ($exists);
        } else {
            // Check if the code already exists globally across all events
            $existingAccess = EventAccess::all()->first(function ($access) use ($code) {
                try {
                    return decrypt($access->access_code) === $code;
                } catch (\Exception $e) {
                    return false;
                }
            });

            if ($existingAccess) {
                return redirect()->back()->withErrors(['access_code' => 'This access code already exists. Please use a different code. Access codes must be unique across all events.'])->withInput();
            }
        }

        $event->eventAccesses()->create([
            'access_code' => encrypt($code),
            'access_granted_date' => now()->toDateTimeString(),
            'is_active' => true
        ]);

        return redirect()->back()->with('success', 'New event code successfully added!');
    }

    /**
     * Verify access code from login page
     */
    public function verifyAccessCode()
    {
        $accessCode = request('access_code');

        if (!$accessCode) {
            return redirect()->route('login')->withErrors(['access_code' => 'Please enter an access code.']);
        }

        // Find the event access that matches this code
        $access = EventAccess::all()->first(function ($a) use ($accessCode) {
            try {
                return decrypt($a->access_code) === $accessCode;
            } catch (\Exception $e) {
                return false;
            }
        });

        if (!$access) {
            return redirect()->route('login')->withErrors(['access_code' => 'Invalid access code. Please check and try again.']);
        }

        if (!$access->is_active) {
            return redirect()->route('login')->withErrors(['access_code' => 'This access code is no longer active.']);
        }

        // Redirect to the event page with the access code
        $event = $access->event;
        return redirect()->route('events.show', ['path' => $event->event_folder_path, 'access_code' => $accessCode]);
    }

}
