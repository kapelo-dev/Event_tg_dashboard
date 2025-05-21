<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $table = 'TicketType';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'description',
        'eventId'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'eventId');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'ticketTypeId');
    }
} 