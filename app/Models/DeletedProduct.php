<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedProduct extends Model
{
    //
    use HasFactory;

    protected $table = 'deleted_products';

    protected $fillable = ['name', 'qty', 'price', 'product_id', 'description'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
