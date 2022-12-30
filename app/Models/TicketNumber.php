<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketNumber extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function ticketSales() {
        return $this->belongsTo(TicketSales::class, 'ticket_sale_id', 'id');
    }
}
