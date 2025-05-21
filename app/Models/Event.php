<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'is_multi_day',
        'has_specific_time',
        'start_time',
        'end_time',
        'location',
        'status',
        'organizer',
        'image_url',
        'category_id'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_multi_day' => 'boolean',
        'has_specific_time' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class, 'eventId');
    }

    public function agents()
    {
        return $this->belongsToMany(User::class, 'AgentEvent', 'eventId', 'agentId')
            ->withTimestamps();
    }

    public function tickets()
    {
        return $this->hasManyThrough(
            Ticket::class,
            TicketType::class,
            'eventId', // Foreign key on TicketType table...
            'ticketTypeId', // Foreign key on tickets table...
            'id', // Local key on events table...
            'id' // Local key on TicketType table...
        );
    }
} 