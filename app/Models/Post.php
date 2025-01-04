<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Specify the attributes that can be mass-assigned
    protected $fillable = ['title', 'content'];    
}
