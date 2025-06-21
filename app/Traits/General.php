<?php

namespace App\Traits;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

trait General
{
    public $data = [];

    public function __construct()
    {
        $this->data('title', $this->makeTitle());

    }

    public function makeTitle(): string
    {
        $serverName = env('APP_NAME');
        $path = Request::path();
        if ($path == '/') {
            $path = $serverName;
        }
        return str_replace('/', ' | ', $path);

    }

   public function customFileUpload($path, $inputName = 'image')
    {
        if (request()->hasFile($inputName)) {
            $file = request()->file($inputName);
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path($path);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);  // create directory recursively
            }

            $file->move($destinationPath, $filename);
            return $path . '/' . $filename;
        }
        return null;
    }



    public function data($key, $value = '')
    {
        return $this->data[$key] = $value;
    }

    public function make_slug($string)
    {
        return Str::slug($string);
    }
}
