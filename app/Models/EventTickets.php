<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTickets extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $casts = [
        'settings' => 'array',
        'questions' => 'array',
    ];
    public function design() {
        return $this->hasOne(TicketDesign::class, 'event_ticket_id', 'id');
    }

    public function event() {
        return $this->belongsTo(EventList::class, 'event_id', 'id');
    }

    public function ticket_sales() {
        return $this->hasMany(TicketSales::class, 'ticket_id', 'id');
    }
}
