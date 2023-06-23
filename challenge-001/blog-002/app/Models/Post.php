<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $fillable = ['title', 'excerpt', 'body', 'id'];

    // Alternative way

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function category()
    {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author() // Assume foreign key is `author_id`, but db column is `user_id`, you should pass `user_id` as a foreign key
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
