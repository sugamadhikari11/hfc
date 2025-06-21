<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait FileService
{

    public function deviceBasedImageUpload($directory = 'uploads')
    {
        if (!empty(request()->file())) {
            $file = collect(request()->file())->first();
            $ext = strtolower($file->getClientOriginalExtension());
            $imageNameBase = md5(microtime());
            $uploadPath = public_path($directory);

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $originalName = $imageNameBase . '.' . $ext;
            $file->move($uploadPath, $originalName);

            $videoExtensions = ['mp4', 'avi', 'mov', 'mkv', 'webm'];
            if (in_array($ext, $videoExtensions)) {
                return [
                    'original' => "{$directory}/{$originalName}"
                ];
            }

            $sizes = [
                'thumbnail' => [150, 100],
                'mobile' => [480, 320],
                'tablet' => [768, 512],
                'desktop' => [1280, 720],
            ];

            $paths = [];

            foreach ($sizes as $label => [$width, $height]) {
                $resizedName = "{$imageNameBase}_{$label}.{$ext}";
                $resizedPath = "{$uploadPath}/{$resizedName}";
                $img = Image::make("{$uploadPath}/{$originalName}")
                    ->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                $img->save($resizedPath);

                $paths[$label] = "{$directory}/{$resizedName}";
            }

            $paths['original'] = "{$directory}/{$originalName}";

            return $paths;
        }

        return null;
    }

    /**
     * Upload image or video with resizing if image.
     */
    public function uploadDeviceImages($file, $folder = 'uploads')
    {
        $folder = trim($folder, '/');
        $uploadPath = public_path($folder);

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $filename = Str::random(20);
        $ext = strtolower($file->getClientOriginalExtension());
        $originalName = "$filename.$ext";
        $file->move($uploadPath, $originalName);

        $videoExtensions = ['mp4', 'avi', 'mov', 'mkv', 'webm'];
        if (in_array($ext, $videoExtensions)) {
            return [
                'original' => "$folder/$originalName"
            ];
        }

        $sizes = [
            'thumbnail' => [150, 100],
            'mobile' => [480, 320],
            'tablet' => [768, 512],
            'desktop' => [1280, 720],
        ];

        $paths = [];

        foreach ($sizes as $key => [$w, $h]) {
            $resizedName = "{$filename}_{$key}.{$ext}";
            $img = Image::make(public_path("$folder/$originalName"))
                ->resize($w, $h, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });
            $img->save(public_path("$folder/$resizedName"));
            $paths[$key] = "$folder/$resizedName";
        }

        $paths['original'] = "$folder/$originalName";

        return $paths;
    }

    /**
     * Delete all given image paths.
     */
    public function deleteDeviceImages($imagePaths)
    {
        if (is_array($imagePaths)) {
            foreach ($imagePaths as $path) {
                $filePath = public_path(parse_url($path, PHP_URL_PATH));
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }
        }
    }

    /**
     * Delete all image files found in the HTML content.
     */
    public function deleteImagesFromHtml($htmlContent)
    {
        $httpPrefix = request()->isSecure() ? 'https:' : 'http:';
        $imageUrls = [];

        $parts = explode('src="', $htmlContent);
        foreach ($parts as $part) {
            preg_match('/' . $httpPrefix . '\/\/[^"\']+/', $part, $matches);
            if (!empty($matches[0])) {
                $imageUrls[] = $matches[0];
            }
        }

        foreach ($imageUrls as $url) {
            $imagePath = parse_url($url, PHP_URL_PATH);
            $absolutePath = public_path($imagePath);
            if (file_exists($absolutePath)) {
                @unlink($absolutePath);
            }
        }
    }


    public function uploadMultipleDeviceImages($directory = 'uploads', $fieldName = 'images')
    {
        $uploadedFiles = request()->file($fieldName);
        $allUploadedPaths = [];

        if (!empty($uploadedFiles) && is_array($uploadedFiles)) {
            $uploadPath = public_path($directory);

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            foreach ($uploadedFiles as $file) {
                if (!$file instanceof \Illuminate\Http\UploadedFile || !$file->isValid()) {
                    continue;
                }

                $ext = strtolower($file->getClientOriginalExtension());
                echo $ext;
                $imageNameBase = md5(microtime() . $file->getClientOriginalName());
                $originalName = $imageNameBase . '.' . $ext;
                $file->move($uploadPath, $originalName);

                $videoExtensions = ['mp4', 'avi', 'mov', 'mkv', 'webm'];

                // If it's a video, skip resizing
                if (in_array($ext, $videoExtensions)) {
                    $allUploadedPaths[] = [
                        'original' => "{$directory}/{$originalName}"
                    ];
                    continue;
                }

                // Resize images to different device sizes
                $sizes = [
                    'thumbnail' => [150, 100],
                    'mobile'    => [480, 320],
                    'tablet'    => [768, 512],
                    'desktop'   => [1280, 720],
                ];

                $paths = [];

                foreach ($sizes as $label => [$width, $height]) {
                    $resizedName = "{$imageNameBase}_{$label}.{$ext}";
                    $resizedPath = "{$uploadPath}/{$resizedName}";

                    $img = Image::make("{$uploadPath}/{$originalName}")
                        ->resize($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });

                    $img->save($resizedPath);

                    $paths[$label] = "{$directory}/{$resizedName}";
                }

                $paths['original'] = "{$directory}/{$originalName}";
                $allUploadedPaths[] = $paths;
            }

            return $allUploadedPaths;
        }

        return null;
    }

}





