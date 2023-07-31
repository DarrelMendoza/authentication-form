<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', // The title of the post
        'message', // The content of the post
        'type', // Category of the post, can be either news, update or task
        'author_name', // The name of the post's author
        'author_id',
    ];
}
