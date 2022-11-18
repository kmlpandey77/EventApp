<?php

namespace App\Actions\Events;

use App\Http\Requests\EventRequest;
use App\Models\Event;

class UpdateEvent
{
    public function __invoke(Event $event)
    {
        return view('event-action.edit', compact('event'));
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