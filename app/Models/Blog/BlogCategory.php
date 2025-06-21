<?php

namespace App\Models\Blog;

use App\Models\User\User;
use App\Traits\FileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory, FileService;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'sub_title',
        'description',
        'status',
        'files_field',
        'others_field',
        'meta_title',
        'meta_description',
        'meta_keywords',
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


    public function postedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }

}
