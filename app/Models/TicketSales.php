<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSales extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'settings' => 'array',
    ];
    public function guests() {
        return $this->belongsTo(Guests::class, 'guest_id', 'id');
    }
    public function ticket() {
        return $this->belongsTo(EventTickets::class)->with('event');
    }

    public function organizer() {
        return $this->belongsTo(User::class, 'organizer_id', 'id');
    }

    public function ticket_number() {
        return $this->hasMany(TicketNumber::class, 'ticket_sale_id');
    }
    
}
