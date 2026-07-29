<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTicketTier extends Model
{
    protected $fillable = ['event_id', 'name', 'price', 'stock', 'start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
