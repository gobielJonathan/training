<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    public function Training(){
        return $this->belongsTo(Training::class, 'training_id');
    }
    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
