<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait HandleImage
{
    protected $path = 'uploads/';
    protected $imageDefault = 'default-product.png';

    public function verifyImage($request)
    {
        return $request->hasFile('image') && $request->file('image');
    }

    public function storeImage($request)
    {
        if ($this->verifyImage($request)) {
            $file = $request->file('image');
            $fileName = time() . $file->getClientOriginalName();
            $saveLocation = $this->path . $fileName;
            Image::make($file)->save($saveLocation);
            return $fileName;
        }
        return null;
    }

    public function updateImage($request, $currentImage)
    {
        if ($this->verifyImage($request)) {
            $this->deleteImage($currentImage);
            return $this->storeImage($request);
        }
        return $currentImage;
    }

    public function deleteImage($imageName)
    {
        $path = $this->path . $imageName;
        if (file_exists($path) && $imageName != $this->imageDefault && !is_null($imageName)) {
            unlink($path);
        }
    }
}
