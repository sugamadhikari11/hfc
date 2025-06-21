<?php

namespace App\Models\Page;

use App\Models\User\User;
use App\Traits\FileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, FileService;

    protected $fillable = [
        'is_published',
        'user_id',
        'parent_id',
        'title',
        'slug',
        'sub_title',
        'icons',
        'files_field',
        'others_field',
        'summary',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'page_section_name',
        'website',
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
        return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');

    }

    public function child()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

}
