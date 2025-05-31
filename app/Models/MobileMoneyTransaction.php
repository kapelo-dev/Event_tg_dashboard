<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileMoneyTransaction extends Model
{
    use HasFactory;

    protected $table = 'mobile_money_transactions';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $fillable = [
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
        'quantity',
        'ticketIds'
    ];

    protected $casts = [
        'amount' => 'float',
        'ticketIds' => 'array',
        'responseData' => 'json',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticketTypeId');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id', 'ticketIds');
    }

    public function getTicketIdsAttribute($value)
    {
        if (empty($value)) {
            return [];
        }
        return is_array($value) ? $value : json_decode($value, true) ?? [];
    }
} 