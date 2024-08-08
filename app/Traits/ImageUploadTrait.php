<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

trait ImageUploadTrait
{
    public function uploadImages(array $images, $path = 'images')
    {
        $uploadedImages = [];

        foreach ($images as $image) {
            $uploadedImages[] = $this->uploadImage($image, $path);
        }

        return $uploadedImages;
    }

    public function uploadImage(UploadedFile $image, $path = 'images')
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs($path, $imageName, 'public');

        $this->createThumbnail($path . '/' . $imageName, $path . '/thumbnails/' . $imageName, 100, 100);

        return $imageName;
    }

    public function getImageUrl($imageId, $size = 'original')
    {
        $path = 'images';

        if ($size === 'thumbnail') {
            $path .= '/thumbnails';
        }

        return Storage::url($path . '/' . $imageId);
    }

    private function createThumbnail($sourcePath, $destinationPath, $width, $height)
    {
        $image = Image::make($sourcePath)->fit($width, $height);
        Storage::put($destinationPath, (string) $image->encode());
    }
}
