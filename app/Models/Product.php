<?php

namespace App\Models;

use App\Models\OrderDetail;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query,array $filters){
        // $query->when($filters['sc'] ?? false, function($query,$sc){
        //     return $query->where('slug','=',$sc);
        // });
        $query->when($filters['search'] ?? false, function($query,$search){
            return $query->where('name', 'like', '%' . $search . '%');
        });
        $query->when($filters['sc'] ?? false, function($query,$sc){
            return $query->whereHas('sub_category',function($query) use ($sc){
                $query->where('slug',$sc);
            });
        });
    }


    public function sub_category(){
        return $this->belongsTo(SubCategory::class);
    }

    public function orderdetail(){
        return $this->hasMany(OrderDetail::class);
    }
}