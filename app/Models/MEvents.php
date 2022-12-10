<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MEvents extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'settings' => 'array',
    ];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function discounts() {
        return $this->hasMany(Discount::class);
    }
}
