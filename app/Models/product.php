<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $id = 'product_id';
    protected $primaryKey = 'product_id';
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'product_id', 'product_id');
    }
}
