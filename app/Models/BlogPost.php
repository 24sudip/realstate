<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rel_to_cat()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_cat_id', 'id');
    }
}
