<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTickets extends Model
{
    use HasFactory;
    protected $fillable = [
        "event_id",
        "ticketType",
        "ticket_name",
        "ticket_stock",
        "stock_limit",
        "price",
        "purchase_limit",
        "ticket_description",
        "isTransferFeesToGuest",
        "questions",
        "perks",
        "sold",
        "settings",
    ];
}
