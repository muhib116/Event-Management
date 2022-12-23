<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guests extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $casts = [
        'settings' => 'array',
        "ip_info" => 'json'
    ];

    public function ticketSales() {
        return $this->hasMany(TicketSales::class, 'guest_id', 'id');
    }
}
