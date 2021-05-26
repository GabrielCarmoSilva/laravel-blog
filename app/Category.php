<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    public function posts() {
        return $this->hasMany('App\Post', 'category_id', 'id');
    }
}
