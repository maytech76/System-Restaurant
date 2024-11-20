<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    use HasFactory;

    protected $fillable = [

        'name', 'user_id', 'image_path', 'status'
    ];

    // Definimos la relacion entre Waiter and User asi podriamos relizar consultas a la tabla usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
