<?php


namespace Drivezy\LaravelRecordManager\Library;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Class FileManager
 * @package Drivezy\LaravelRecordManager\Library
 */
class FileManager
{
    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    public static function uploadFileToS3 (UploadedFile $file)
    {
        $prefix = 'moe';
        $imageName = preg_replace('/\s+/', '', $file->getClientOriginalName());
        $imageName = 'uploads/' . $prefix . strtotime('now') . '_' . $imageName;

        return self::uploadToS3($imageName, $file);
    }

    /**
     * @param $name
     * @param $file
     *
     * @return string
     */
    public static function uploadToS3 ($name, $file)
    {
        Storage::disk('s3')->put($name, file_get_contents($file));
        Storage::disk('s3')->setVisibility($name, 'public');

        return Storage::disk('s3')->url($name);
    }
}
