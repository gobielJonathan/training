<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    const APPROVED = 1;
    const PENDING = 0;

    protected $fillable = ['status'];

    public function Training(){
        return $this->belongsTo(Training::class,'training_id')->withTrashed();
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Payment(){
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }
}
