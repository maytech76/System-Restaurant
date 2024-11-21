<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'orders_details';

    protected $fillable = [
        
        'order_id',
        'table_id',
        'product_id',
        'quantity',
        'price',
        'notes',
        'status',
    ];

    public function order(){

        return $this->belongsTo(Order::class);
    }

    public function table(){

        return $this->belongsTo(Table::class);
    }

    public function product(){

        return $this->belongsTo(Product::class, 'product_id');
    }

    public function details(){

    return $this->hasMany(OrderDetail::class);
    }
}
