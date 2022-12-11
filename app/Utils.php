<?php

namespace App;

trait Utils
{
    /**
     * use Utils;
     * $this->imageUpload($request, 'image', 'uploads/product')
     */
    public function imageUpload($request, $name, $directory)
    {
        $doUpload = function ($image) use ($directory) {
            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extention = $image->getClientOriginalExtension();
            $imageName = $name . '_' . uniqId() . '.' . $extention;
            $image->move($directory, $imageName);
            return $directory . '/' . $imageName;
        };

        if (!empty($name) && $request->hasFile($name)) {
            $file = $request->file($name);
            if (is_array($file) && count($file)) {
                $imagesPath = [];
                foreach ($file as $key => $image) {
                    $imagesPath[] = $doUpload($image);
                }
                return $imagesPath;
            } else {
                return $doUpload($file);
            }
        }

        return null;
    }

    public function unlinkImages($image) 
    {
        if (is_array($image) && count($image)) {
            foreach ($image as $_image) {
                if (isset($_image) && file_exists($_image)) {
                    unlink($_image);
                }
            }
        } else {
            if (isset($image) && file_exists($image)) {
                unlink($image);
            }
        }
    }

    
}