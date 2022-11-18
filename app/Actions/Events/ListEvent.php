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

        return view('event-action.index', [
            'events' => $events->paginate()->withQueryString(),
        ]);
    }

}