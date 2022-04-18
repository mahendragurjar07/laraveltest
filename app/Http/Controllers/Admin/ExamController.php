<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Config;

use App\Imports\ExamImport;
use App\Repositories\{ExamRepository, QuestionRepository};
use App\Http\Requests\admin\ExamImportRequest;

class ExamController extends Controller
{   

	public function index(){
		return view('admin.exam.index');
	}

	public function getExamList(Request $request){
		try{
			return ExamRepository::getExamList($request);

		} catch (\Exception $e) {

			return response()->json(
				[
					'success' => false,
					'data' => '',
					'message' => $e->getMessage()
				],
				Config::get('constants.HttpStatus.BAD_REQUEST')
			);
		}
	}

    public function importExam(ExamImportRequest $request) {
        try{

            Excel::import(new ExamImport, $request->file('file'));
            return response()->json(
                [
                    'success' => true,
                    'data' => '',
                    'message' => 'Data imported successfully.'
                ],
                Config::get('constants.HttpStatus.OK')
            );

        } catch (\Exception $e) {

            return response()->json(
                [
                    'success' => false,
                    'data' => '',
                    'message' => $e->getMessage()
                ],
                Config::get('constants.HttpStatus.BAD_REQUEST')
            );
        }
    }


    /**
     * Export questions and exam
     * @param object $request
     * @throw Exception
     */
    public function export(Request $request){
        try
        {
            return QuestionRepository::export($request);
        }catch (\Exception $e) {
             throw $e;
        }
    }

}