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

        return 'Upcomming';
    }

}
