<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Questions;
use App\Exports\ExamExport;

class QuestionRepository {


    public static function export($request){
        try{
            $report = Questions::with(['exam'])->orderBy('exam_id')->get();
            $fileName = 'schools';
            
            return Excel::download(new ExamExport($report), $fileName . '.xls');
        }catch(\Exception $ex){
            throw $ex;
        }
    }

}