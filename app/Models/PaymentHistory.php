<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}