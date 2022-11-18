<?php

namespace App\Actions\Events;

use App\Models\Event;

class ListEvent
{
    public function __invoke()
    {
        $events = Event::query();

        $events->when(request('search'), function ($query, $value) {
            $query->where('title', 'LIKE', '%'.$value.'%');
        });

        $events->filter(request('filter'));


        $events->orderByDesc('start_date');

        return view('event-action.index', [
            'events' => $events->paginate()->withQueryString(),
        ]);
    }

}