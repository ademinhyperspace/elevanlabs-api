<?php

namespace Shahinyanm\ElevenlabsApi\Traits\FileSystem;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

trait HasFileMethod
{
    /**
     * @param string $path
     * @param string $fileName
     * @return string
     */
    public function saveConvertedFile(string $path, string $fileName): string
    {
        Storage::disk('public')->put($path, new File($fileName));
        return Storage::disk('public')->url("$path/$fileName");
    }
}
