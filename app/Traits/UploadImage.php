<?php

namespace App\Traits;


trait UploadImage
{
    public function uploadImage($disk = 'public', $image, $path, $old_image = null)
    {
        if ($old_image) {
            $this->deleteImage($old_image);
        }

        $image_name = \Illuminate\Support\Str::uuid() . '.' . $image->extension();

        $image_path = $image->storeAs($path, $image_name, $disk);

        return $image_path;
    }

    protected function deleteImage($image)
    {
        if (file_exists(public_path($image))) {
            unlink(public_path($image));
        }
    }

}
