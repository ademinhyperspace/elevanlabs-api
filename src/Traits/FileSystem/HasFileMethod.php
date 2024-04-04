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
        $diskName = config('elevenlabs-api.storage.disk');
        Storage::disk($diskName)->put($path, new File($fileName));
        return Storage::disk($diskName)->url("$path/$fileName");
    }
}
