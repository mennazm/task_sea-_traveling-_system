<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{  
    protected $fillable = ['contract_id', 'trip_date'];
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}

