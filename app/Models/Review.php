<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";
    protected $guarded = [];

    public function order_detail(){
        return $this->belongsTo(OrderDetail::class);
    }
}
