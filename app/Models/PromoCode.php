<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PromoCode extends Model
{
    protected $table = 'promo_codes';
    
    public $timestamps = true;
    protected $keyType = 'string';
    public $incrementing = false;
    
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    
    protected $fillable = [
        'code',
        'eventId',
        'discount',
        'discountType',
        'maxUses',
        'usedCount',
        'startDate',
        'endDate',
        'isActive'
    ];

    protected $casts = [
        'startDate' => 'datetime',
        'endDate' => 'datetime',
        'isActive' => 'boolean',
        'discount' => 'decimal:2',
        'usedCount' => 'integer',
        'maxUses' => 'integer'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'eventId');
    }

    public function uses()
    {
        return $this->hasMany(PromoCodeUse::class, 'promoCodeId');
    }
} 