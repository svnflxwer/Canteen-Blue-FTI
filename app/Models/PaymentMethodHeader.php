<?php

namespace App\Models;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethodHeader extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function method(){
        return $this->hasMany(PaymentMethod::class);
    }
}