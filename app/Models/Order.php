<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'user_id',
        'table_id',
        'subtotal',
        'iva',
        'total',
        'payment_method',
        'coments',
        'status'
    ];

    //relacion con User
    public function user(){

        return $this->belongsTo(User::class);
    }

    //relacion con Table orders_details
    public function orderDetails(){

        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    // relacion con Table
    public function table(){
        
        return $this->belongsTo(Table::class);
    }

    public function details(){
        
        return $this->hasMany(OrderDetail::class);
    }

}
