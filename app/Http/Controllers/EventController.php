<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::query();

        $events->when(request('search'), function ($query, $value){
            $query->where('title', 'LIKE', '%'. $value .'%');
        });

        $events->when(request('filter'), function ($query, $value){
            if($value == 'finished')
                $query->whereDate('end_date', '<', now());

            if($value == 'finished_last_7_days'){
                $query->whereDate('end_date', '<', now())
                    ->whereDate('end_date', '>', now()->subDays(7));
            }
            if($value == 'upcoming')
                $query->whereDate('start_date', '>', now());

            if($value == 'upcoming_within_7_day'){
                $query->whereDate('start_date', '>', now())
                    ->whereDate('start_date', '<', now()->addDays(7));
            }

            if($value == 'running'){
                $query->whereDate('start_date', '<', now())
                    ->whereDate('end_date', '>', now());
            }
        });

        $events->orderByDesc('start_date');

        return view('event.index', [
            'events' => $events->paginate()->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
