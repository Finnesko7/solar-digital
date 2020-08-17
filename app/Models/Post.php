<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App\Models
 */
class Post extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $casts = [
      'created_at' => 'datetime:F j, Y, g:i a'
    ];
}
