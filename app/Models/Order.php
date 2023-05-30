<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderDetail;
use App\Models\StatusOrder;
use App\Models\PaymentHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    // use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderdetail(){
        return $this->hasMany(OrderDetail::class);
    }

    public function status_order(){
        return $this->belongsTo(StatusOrder::class);
    }

    public function payment(){
        return $this->belongsTo(PaymentHistory::class);
    }
}