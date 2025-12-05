<?php

namespace App\Http\Controllers;

use App\Http\Requests\Events\CreateEventRequest;
use App\Http\Requests\Events\GetEventsRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\EventType;

class EventController extends Controller
{
    private const PER_PAGE = 10;

    /**
     * List all events.
     */
    public function index(GetEventsRequest $request)
    {
        if ($request->has('sort')) {
            $sort = $request->get('sort');
            $direction = $request->get('order', 'asc');

            // Sort by query parameters
            $query = Event::orderBy($sort, $direction);

            if ($sort === 'event_date') {
                // Also sort by time so that we apply the correct order
                $query->orderBy('event_time', $direction);
            }

            $events = $query->paginate(self::PER_PAGE)->withQueryString();
        } else {
            $defaultSort = 'event_date';
            $defaultOrder = 'desc';

            // Apply default sorting
            $events = Event::orderBy($defaultSort, $defaultOrder)->paginate(self::PER_PAGE);
        }

        $categories = Category::all();

        return view('events.index', compact('events', 'categories'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created event.
     */
    public function store(CreateEventRequest $request)
    {
        $data = $request->except('event_date_time');

        // Parse date and time separately from the combined input
        $dateTime = Carbon::parse($request->input('event_date_time'));

        $data['event_date'] = $dateTime->format('Y-m-d');
        $data['event_time'] = $dateTime->format('H:i');

        $event = new Event($data);

        $event->save();

        return redirect()->route('events.index')->with('success', sprintf('Event "%s" created successfully', $event->event_name));
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified event.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->except('event_date_time');

        if ($request->has('event_date_time')) {
            // Parse date and time separately from the combined input
            $dateTime = Carbon::parse($request->input('event_date_time'));

            $data['event_date'] = $dateTime->format('Y-m-d');
            $data['event_time'] = $dateTime->format('H:i');
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', sprintf('Event "%s" updated successfully', $event->event_name));
    }

    /**
     * Remove the specified event.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', sprintf('Event "%s" deleted successfully', $event->event_name));
    }

    /**
     * Manage access for the event
     * @param Event $event
     */
    public function createAccess(Event $event)
    {
        if ($event->event_type == EventType::PUBLIC) {
            return redirect()->route('events.index')->with('success', sprintf('The \'%s\' event is public', $event->event_name));
        }

        $event->loadMissing('eventAccesses');

        return view('events.access.create', compact('event'));
    }

    public function storeAccess(Event $event)
    {

    }

    /**
     * Toggle event active status
     */
    public function toggle(Event $event)
    {
        $event->update([
            'is_active' => !$event->is_active
        ]);

        return redirect()->back()->with('success', sprintf('Event "%s" successfully %s.', $event->event_name, $event->is_active ? 'activated' : 'deactivated'));
    }

    /**
     * Show public events to guests
     */
    public function publicEvents()
    {
        // Redirect authenticated admins to dashboard
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        $events = Event::where('event_type', EventType::PUBLIC)
            ->where('is_active', true)
            ->with('category')
            ->orderBy('event_date', 'desc')
            ->orderBy('event_time', 'desc')
            ->get();

        return view('events.public', compact('events'));
    }
}
