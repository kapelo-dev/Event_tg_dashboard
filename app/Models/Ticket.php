<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'Ticket';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $fillable = [
        'ticketTypeId',
        'userId',
        'status',
        'code',
        'createdAt',
        'updatedAt',
        'validationDate',
        'validatedById'
    ];

    protected $casts = [
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
        'validationDate' => 'datetime'
    ];

    protected $dates = [
        'createdAt',
        'updatedAt',
        'validationDate'
    ];

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticketTypeId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validatedById');
    }

    public function event()
    {
        return $this->hasOneThrough(
            Event::class,
            TicketType::class,
            'id', // Foreign key on TicketType table...
            'id', // Foreign key on events table...
            'ticketTypeId', // Local key on tickets table...
            'eventId' // Local key on TicketType table...
        );
    }

    public function transaction()
    {
        return $this->hasOne(MobileMoneyTransaction::class, 'ticketId');
    }
} 