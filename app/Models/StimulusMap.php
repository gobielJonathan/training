<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StimulusMap extends Model
{
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Stimulus(){
        return $this->belongsTo(Stimulus::class,'stimulus_id');
    }

}
