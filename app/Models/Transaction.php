<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'mobile_money_transactions';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $fillable = [
        'ticketId',
        'transactionReference',
        'amount',
        'phoneNumber',
        'provider',
        'status',
        'paymentUrl',
        'paymentToken',
        'responseData',
        'userId',
        'ticketTypeId',
        'quantity'
    ];

    protected $casts = [
        'amount' => 'float',
        'quantity' => 'integer',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticketId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticketTypeId');
    }
}
