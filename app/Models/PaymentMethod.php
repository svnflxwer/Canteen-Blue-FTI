<?php

namespace App\Models;

use App\Models\PaymentHistory;
use App\Models\PaymentMethodHeader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function payment_method_header(){
        return $this->belongsTo(PaymentMethodHeader::class);
    }

    public function payment_history(){
        return $this->hasMany(PaymentHistory::class);
    }
}