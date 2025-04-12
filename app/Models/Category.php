<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = [
        // viết theo thứ tự trong db
        'name',
        'status',
    ];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
