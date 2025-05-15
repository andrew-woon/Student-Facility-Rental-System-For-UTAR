<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Room;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  
        'facility_id', 
        'start_time', 
        'end_time', 
        'status',
        'reasons', 
        'feedback', 
        'feedback_by'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}

