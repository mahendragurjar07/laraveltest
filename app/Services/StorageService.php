<?php

namespace App\Services;

use App\Http\Requests\instructor\AddCourseLectureRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Closure;
use Image;
use File;

class StorageService {

    protected static function storeAs(
    FormRequest $request, String $file, String $location, Closure $callback = null
    ) {
        $fileNameToStore = '';
        if ($request->hasFile($file)) {
            $filenameWithExt = $request->file($file)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file($file)->getClientOriginalExtension();
            $fileNameToStore = preg_replace('/[^a-zA-z0-9_]/', '-', $filename) . '_' . time() . '.' . $extension;

            if ($callback) {
                $callback($extension, $fileNameToStore);
            }

            $request->file($file)->storeAs($location, $fileNameToStore);
        }
        return $fileNameToStore;
    }

     
    public static function getSpecialityImageUrl(String $filename) {
        try {
            $filePath = config('constants.SpecialityImagePath.ORIGNAL') . '/' . $filename;
            return self::checkImage($filePath);
            // return Storage::url($filePath);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    

    public static function uploadTeamImage(FormRequest $request) {
        try { 
            return self::storeAs(
                            $request, 'logo', config('constants.TeamImagePath.ORIGNAL'), function ($extension, $fileNameToStore) use ($request) {
                        
                    }
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function uploadPlayerImage(FormRequest $request) {
        try { 
            return self::storeAs(
                            $request, 'logo', config('constants.PlayerImagePath.ORIGNAL'), function ($extension, $fileNameToStore) use ($request) {
                        
                    }
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
}
