<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterval;

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

    public function getEventDuration($event) {
        if (!$event) return false;
        $start_at = Carbon::parse(date('Y-m-d H:i:s', strtotime("$event->start_date $event->start_time")));
        $end_at = Carbon::parse(date('Y-m-d H:i:s', strtotime("$event->end_date $event->end_time")));
        $value = $start_at->diffInSeconds($end_at);
        return $value;
    }

    public function getDurationFormate($value) {
        $dt = Carbon::now();
        $days = $dt->diffInDays($dt->copy()->addSeconds($value));
        $hours = $dt->diffInHours($dt->copy()->addSeconds($value)->subDays($days));
        $minutes = $dt->diffInMinutes($dt->copy()->addSeconds($value)->subDays($days)->subHours($hours));
        $op = CarbonInterval::days($days)->hours($hours)->minutes($minutes)->forHumans();
        return $op;
    }

    
}