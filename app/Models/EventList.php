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

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
