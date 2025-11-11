<?php

namespace App\Action;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class File
{
    public static function upload($file, $path, $size = [480, 480])
    {
        // $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        // Storage::putFileAs("public/$path", $file, $fileName);

        // return "storage/$path/" . $fileName;


        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $manager = new ImageManager(new Driver());

        $image = $manager->read($file);
        $image->resize($size[0], $size[1]);

        // $image->resize(480, 480, function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });

        // Save to storage
        Storage::put("public/$path/$fileName", (string) $image->encode());

        return "storage/$path/" . $fileName;

    }

    public static function fleUpload($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs("public/$path", $file, $fileName);

        return "storage/$path/" . $fileName;
    }

    public static function deleteFile($file)
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }
}
