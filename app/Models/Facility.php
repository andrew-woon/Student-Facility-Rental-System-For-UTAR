<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'location', 
        'description'
    ];

    protected static function booted()
    {
        static::deleting(function ($facility) {
            $facility->schedules()->delete();
        });
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
    

