<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $dates = ['deleted_at'];
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'image',
        'category_id',
        'description',
        'status',
    ];
    public function category(){
        return $this -> belongsTo(Category::class, 'category_id');
    }

}
