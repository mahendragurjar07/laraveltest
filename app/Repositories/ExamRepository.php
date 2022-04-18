<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\Exams;
use Yajra\DataTables\Facades\DataTables;
use App\Services\StorageService;

class ExamRepository {

    public static function get($request){
        try {
            
            return Exams::get();

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function getExamList($request){
        try {

            $result = Exams::get(); 

            return DataTables::of($result)
                    
                    ->addColumn('exam_title', function ($data) {
                        return $data->name;
                    })
                    ->addColumn('questions', function ($data) {
                        return $data->questions->count();
                    })
                    ->escapeColumns(null)
                    ->make(true);
                 
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}