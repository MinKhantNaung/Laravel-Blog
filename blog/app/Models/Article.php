<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id',
    ];

    // one article -> one cateogry
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    // one article -> many comments
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    // one article -> one user
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
