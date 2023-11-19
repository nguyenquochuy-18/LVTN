<?php

namespace App\Services;



use Intervention\Image\Facades\Image;

class UploadService
{
    private string $path = 'uploads/ckeditor/';

    public function uploadCkeditor($request)
    {
        if($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . $file->getClientOriginalName();
            $saveLocation = $this->path . $fileName;
            Image::make($file)->save($saveLocation);
            $url = asset('uploads/ckeditor/'. $fileName);
            $ckeditorFuncNum = $request->input('CKEditorFuncNum');

            $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditorFuncNum, '$url')</script>";
            @header('Content-type: text/html; charset=utf-8');

            return $response;
        }
    }
}
