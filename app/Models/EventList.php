<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventList extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'settings' => 'array',
    ];

    public function eventTickets() {
        return $this->hasMany(EventTickets::class, 'event_id');
    }

    public function images() {
        return $this->hasMany(Images::class, 'foreign_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function views() {
        return $this->hasOne(EventView::class, 'event_list_id', 'id');
    }

    public function tickets() {
        return $this->hasMany(EventTickets::class, 'event_id', 'id');
    }
    

    public function transaction() {
        return $this->hasOne(Transaction::class, 'event_list_id', 'id');
    }

}
