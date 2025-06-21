<?php

namespace App\Models\Blog;

use App\Models\User\User;
use App\Traits\FileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, FileService;

    protected $fillable = [
        'parent_id',
        'user_id',
        'category_id',
        'is_published',
        'title',
        'slug',
        'sub_title',
        'summary',
        'description',
        'files_field',
        'others_field',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_commentable',
    ];

    protected $casts = [
        'files_field' => 'array',
        'others_field' => 'array'
    ];


    protected static function booted()
    {
        static::created(function () {
            \Artisan::call('sitemap:generate');
        });

        static::updated(function () {
            \Artisan::call('sitemap:generate');
        });

        static::deleted(function () {
            \Artisan::call('sitemap:generate');
        });

        static::deleting(function ($item) {
            if ($item->files_field) {
                (new static)->deleteDeviceImages($item->files_field);
            }
        });

        static::updating(function ($item) {
            if ($item->isDirty('files_field')) {
                $oldPaths = $item->getOriginal('files_field');
                if ($oldPaths) {
                    (new static)->deleteDeviceImages($oldPaths);
                }
            }
        });


    }
    


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }


    public function parent()
    {
        return $this->belongsTo(Blog::class, 'parent_id');

    }

    public function child()
    {
        return $this->hasMany(Blog::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Blog::class, 'parent_id');
    }


}
