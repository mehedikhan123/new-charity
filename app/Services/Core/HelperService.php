<?php

namespace App\Services\Core;

class HelperService
{
    public static function getProgramTypes()
    {
        return [
            [ 'value' =>'trade show', 'text' => 'Trade Show' ],
            [ 'value' => 'conference', 'text' => 'Conference' ],
            [ 'value' => 'workshop', 'text' => 'Workshop' ],
            [ 'value' => 'seminar', 'text' => 'Seminar' ]
        ];
    }

    public static function getGenders()
    {
        return [
            [ 'value' =>'male', 'text' => 'Male' ],
            [ 'value' => 'female', 'text' => 'Female' ],
            [ 'value' => 'others', 'text' => 'Others' ]
        ];
    }

    public static function getNameTitles()
    {
        return [
            [ 'value' =>'mr.', 'text' => 'Mr.' ],
            [ 'value' => 'conference', 'text' => 'Mrs.' ],
            [ 'value' => 'miss', 'text' => 'Miss' ]
        ];
    }

    public static function uploadPhoto($key, $fileName, $col = null)
    {
        if(isset($col)) {
            $filePath = public_path('storage/uploads/photo/' . $col);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $finalName = $fileName . '-' . time() . '.' . $key->extension();
        $key->storeAs('public/uploads/photo/', $finalName);
        return $finalName;
    }

    public static function uploadPhotos($files, $fileNamePrefix, $col = null)
    {
        $uploadedFiles = [];

        foreach ($files as $file) {
            if (isset($col)) {
                $filePath = public_path('storage/uploads/photo/' . $col);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $finalName = $fileNamePrefix . '-' . time() . '-' . uniqid() . '.' . $file->extension();
            $file->storeAs('public/uploads/photo/', $finalName);
            $uploadedFiles[] = $finalName;
        }

        return $uploadedFiles;
    }
}
