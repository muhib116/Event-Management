<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventList extends Model
{
    use HasFactory;
    protected $fillable = [
        "eventType",
        "name",
        "description",
        "location",
        "url",
        "locationTips",
        "video_link",
        "eventCategory",
        "timezone",
        "start_date",
        "start_time",
        "end_date",
        "end_time",
        "website",
        "instagram",
        "twitter",
        "facebook",
        "settings",
    ];

    public function eventTickets() {
        return $this->hasMany(EventTickets::class, 'event_id');
    }

    public function images() {
        return $this->hasMany(Images::class, 'foreign_id');
    }
}
