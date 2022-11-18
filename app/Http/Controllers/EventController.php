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

        $events->filter(request('filter'));


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
