<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'status'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'=> 'datetime',
    ];

    public function getEventStatusAttribute()
    {
        if($this->end_date->isPast())
            return 'Finished';

        if($this->start_date->isPast() && $this->end_date->isFuture())
            return "Running";

        return 'Upcoming';
    }

    public function scopeFilter($query, $filter = null){
        $query->when($filter, function ($query, $value) {
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

    }

}
