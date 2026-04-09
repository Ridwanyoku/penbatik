<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'name', 'label', 'receiver_name', 
        'phone_number', 'full_address', 'city', 
        'postal_code', 'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}