<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['contract_number', 'client_id', 'trips_count', 'start_date', 'end_date'];

   
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

   
    
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function getTripsDoneAttribute()
    {
        return $this->trips()->where('trip_date', '<=', now())->count();
    }

   
    
    public function getStatusAttribute()
    {
        $tripsDone = $this->trips_done;
        $today = Carbon::today();

        if ($today->gt(Carbon::parse($this->end_date)) && $tripsDone >= $this->trips_count) {
            return 'Ended'; 
            
        } elseif ($tripsDone >= $this->trips_count) {
            return 'Completed'; 
            
        } elseif ($today->between(Carbon::parse($this->start_date), Carbon::parse($this->end_date)) && $tripsDone < $this->trips_count) {
            return 'Current'; 
            
        } else {
            return 'Not Started'; 
            
        }
    }
 }
