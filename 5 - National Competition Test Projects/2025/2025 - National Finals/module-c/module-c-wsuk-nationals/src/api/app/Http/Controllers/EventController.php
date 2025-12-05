<?php

namespace App\Http\Controllers;

use App\Enums\EventType;
use App\Filters\EventFilter;
use App\Http\Resources\EventResource;
use App\Http\Resources\PaginationResource;
use App\Models\Event;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    /**
     * Returns all public events
     * @param Request $request
     * @param EventFilter $filters
     * @return JsonResponse
     */
    public function index(Request $request, EventFilter $filters): JsonResponse
    {
        $events = Event::query()
            ->public()
            ->filter($filters)
            ->with('category:cat_id,cat_name')
            ->get();

        return response()->json([
            'success' => true,
            'events' => EventResource::collection($events),
        ]);
    }

    /**
     * Show any public event with pictures
     * @param int $id
     * @param Request $request
     * @param EventFilter $filters
     * @return JsonResponse
     */
    public function show(int $id, Request $request, EventFilter $filters): JsonResponse
    {
        $event = Event::where('event_id', $id)->filter($filters)->firstOrFail();
        if ($event->is_public) {
            return response()->json([
                'success' => true,
                'event' => EventResource::make($event)
            ]);
        }

        $token = $request->bearerToken();
        $user = null;
        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);
            if ($accessToken) {
                $user = $accessToken->tokenable;
                Auth::setUser($user);
            }
        }

        // if user is not logged in or can't view the event, return it as not found
        if (!$user || Gate::denies('view', $event)) {
            throw new NotFoundHttpException();
        }

        return response()->json([
            'success' => true,
            'event' => EventResource::make($event)
        ]);
    }
}
