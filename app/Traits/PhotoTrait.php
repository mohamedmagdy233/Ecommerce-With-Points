<?php

namespace App\Traits;

use Buglinjo\LaravelWebp\Exceptions\CwebpShellExecutionFailed;
use Buglinjo\LaravelWebp\Exceptions\DriverIsNotSupportedException;
use Buglinjo\LaravelWebp\Exceptions\ImageMimeNotSupportedException;
use Buglinjo\LaravelWebp\Webp;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait PhotoTrait
{
    /**
     * @throws CwebpShellExecutionFailed
     * @throws ImageMimeNotSupportedException
     * @throws DriverIsNotSupportedException
     */
    function saveImage($photo, $folder, $type = 'image', $quality_ratio = 70): string
    {
        // Determine the path in the storage folder
        $storagePath = storage_path('app/public/' . $folder);

        // Ensure the directory exists
        File::ensureDirectoryExists($storagePath);

        if ($type == 'image' || $type === null) {
            $webp = Webp::make($photo);
            $file_name = $folder . '/' . rand(1, 9999) . time() . '.webp';

            // Save the image in the storage path
            $webp->save($storagePath . '/' . basename($file_name), $quality_ratio);
        } else {
            $file_extension = $photo->getClientOriginalExtension();
            $file_name = $folder . '/' . rand(1, 9999) . time() . '.' . $file_extension;

            // Move the file to the storage path
            $photo->move($storagePath, basename($file_name));
        }

        // Return the path relative to the "public" disk (if you're using the "public" disk)
        return 'storage/' . $file_name;
    }
}
