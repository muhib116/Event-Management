<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'settings' => 'array',
        'perks' => 'array',
        'questions' => 'array',
    ];

    public function m_event() {
        return $this->belongsTo(MEvents::class);
    }
}
