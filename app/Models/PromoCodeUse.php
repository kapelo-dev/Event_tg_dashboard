<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCodeUse extends Model
{
    protected $table = 'promo_code_uses';
    
    protected $fillable = [
        'promoCodeId',
        'ticketId',
        'userId',
        'discountAmount',
        'originalPrice',
        'finalPrice'
    ];

    protected $casts = [
        'discountAmount' => 'decimal:2',
        'originalPrice' => 'decimal:2',
        'finalPrice' => 'decimal:2'
    ];

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promoCodeId');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticketId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
} 