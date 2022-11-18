<?php

namespace App\Actions\Events;

use App\Http\Requests\EventRequest;
use App\Models\Event;

class CreatEvent
{
    public function __invoke()
    {
        return view('event-action.create');
    }

    public function store(EventRequest $request){

         if (Event::create($request->validated())) {
            return redirect()->route('events-action.index')
                ->with('success', 'Event created successfully!');
        }

        return redirect()->route('events-action.index')
            ->with('error', 'Error while created event');
    }

}