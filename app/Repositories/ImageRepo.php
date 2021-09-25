<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Illuminate\Support\Str;
//use Your Model

/**
 * Class ImageRepo.
 */
class ImageRepo extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }
    public static function uploadImage($requestImage)
    {
        if (Str::startsWith($requestImage, 'data:image')) {
            $image = $requestImage;

            $name = UuidV4::fromDateTime(now()) . '.jpg';

            $path = 'public/images/' . $name;

            $img = Image::make($image)->resize(320, 320);

            Storage::disk('local')->put($path, $img->encode());

            $url = asset('storage/images/' . $name);

            return $url;
        } else {
            return;
        }
    }
    public static function updateImage($requestImage, $oldImg)
    {
        if (Str::startsWith($requestImage, 'data:image')) {
            ImageRepo::deleteImage($oldImg);
            $image = $requestImage;

            $name = UuidV4::fromDateTime(now()) . '.jpg';

            $path = 'public/images/' . $name;

            $img = Image::make($image)->resize(320, 320);

            Storage::disk('local')->put($path, $img->encode());

            $url = asset('storage/images/' . $name);

            return $url;
        } else {
            return;
        }
    }
    public static  function deleteImage($image_path)
    {

        $realPath = str_replace($_SERVER['HTTP_HOST'], "", $image_path);

        if (File::exists(public_path($realPath))) {
            File::delete(public_path($realPath));
        }
    }
}
