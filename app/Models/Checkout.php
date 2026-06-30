<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_first_name',
        'guest_last_name',
        'guest_phone',
        'guest_email',
        'guest_location',
        'product_id',
        'qty',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isGuestOrder(): bool
    {
        return empty($this->user_id);
    }

    public function customerDisplayName(): string
    {
        if ($this->isGuestOrder()) {
            return trim(($this->guest_first_name ?? '') . ' ' . ($this->guest_last_name ?? ''));
        }

        return '';
    }
}
