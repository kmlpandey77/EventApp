<?php

namespace App\Actions\Events;

use App\Http\Requests\EventRequest;
use App\Models\Event;

class DeleteEvent
{
    public function __invoke(Event $event)
    {
        if ($event->delete()) {
            return redirect()->route('events.index')
                ->with('success', 'Event delete successfully!');
        }

        return redirect()->route('events.index')
            ->with('error', 'Error while deleting event');
    }
}