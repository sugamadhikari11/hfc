<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = ['gallery_id', 'title', 'caption', 'image_path'];
}
