<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::query();

        $events->when(request('search'), function ($query, $value) {
            $query->where('title', 'LIKE', '%'.$value.'%');
        });

        $events->when(request('filter'), function ($query, $value) {
            if ($value == 'finished') {
                $query->whereDate('end_date', '<', now());
            }

            if ($value == 'finished_last_7_days') {
                $query->whereDate('end_date', '<', now())
                    ->whereDate('end_date', '>', now()->subDays(7));
            }
            if ($value == 'upcoming') {
                $query->whereDate('start_date', '>', now());
            }

            if ($value == 'upcoming_within_7_day') {
                $query->whereDate('start_date', '>', now())
                    ->whereDate('start_date', '<', now()->addDays(7));
            }

            if ($value == 'running') {
                $query->whereDate('start_date', '<', now())
                    ->whereDate('end_date', '>', now());
            }
        });

        $events->orderByDesc('start_date');

        return view('event.index', [
            'events' => $events->paginate()->withQueryString(),
        ]);
    }

    public function store(EventRequest $request)
    {
        if (Event::create($request->validated())) {
            return redirect()->route('events.index')
                ->with('success', 'Event created successfully!');
        }

        return redirect()->route('events.index')
            ->with('error', 'Error while created event');
    }

    public function create()
    {
        return view('event.create');
    }

    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    public function destroy(Event $event)
    {
        if ($event->delete()) {
            return redirect()->route('events.index')
                ->with('success', 'Event delete successfully!');
        }

        return redirect()->route('events.index')
            ->with('error', 'Error while deleting event');
    }

    public function update(EventRequest $request, Event $event)
    {
        if ($event->update($request->validated())) {
            return redirect()->route('events.index')
                ->with('success', 'Event updated successfully!');
        }

        return redirect()->route('events.index')
            ->with('error', 'Error while updating event');
    }
}
