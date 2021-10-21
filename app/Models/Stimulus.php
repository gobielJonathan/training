<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stimulus extends Model
{
    use HasFactory;
    protected $table = "stimulus";

    public function Detail(){
        return $this->hasMany(StimulusMap::class, 'stimulus_id');
    }

    public function Training(){
        return $this->belongsTo(Training::class, 'training_id', 'id');
    }
}
