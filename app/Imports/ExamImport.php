<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\{Exams, Questions};
use DB;
use Log;

class ExamImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        try{
            DB::beginTransaction();
            $errors = [];
            $totalRows = 1;
            if(count($rows)>0){
                foreach ($rows as $row) {
                    
                    $username = $this->parseValue($row['username']);
                    $question = $this->parseValue($row['question']);
                    $option1 = $this->parseValue($row['option1']);
                    $option2 = $this->parseValue($row['option2']);
                    $option3 = $this->parseValue($row['option3']);
                    $option4 = $this->parseValue($row['option4']);
                    $answer = $this->parseValue($row['answer']);
                    
                    if(!empty($username)){
                        $exam = $this->getExam($username);
                        if(!empty($exam)){

                            if(!empty($question)){

                                if(!empty(${$answer})){ // check answer option exist or not

                                    // Check If question already exist in exam then update
                                    $checkQuestion = $this->getQuestion($exam->id, $question);
                                    if(empty($checkQuestion)) {
                                        $newQuestion = new Questions();
                                    }else{
                                        $newQuestion = $checkQuestion;
                                    }
                                    $newQuestion->exam_id = $exam->id;
                                    $newQuestion->question = $question;
                                    $newQuestion->option1 = $option1;
                                    $newQuestion->option2 = $option2;
                                    $newQuestion->option3 = $option3;
                                    $newQuestion->option4 = $option4;
                                    $newQuestion->answer = $answer;
                                    $newQuestion->save();
                                }else{
                                    $errors[] = 'Error in row '.$totalRows.' : answer option is missing.';
                                }
                            }else{
                                $errors[] = 'Error in row '.$totalRows.' : required filed is missing.';
                            }

                        }
                    }else{
                        $errors[] = 'Error in row '.$totalRows.' : Exam username is missing';
                    }
                }
                Log::error($errors);
                DB::commit();
            }

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * @param String $string
     * @return String
    */
    public function parseValue($string)
    {
        return trim($string);
    }

    /**
     * @param String $title
     * @return Array
    */
    public function getExam($title){

        $exam = Exams::where(['title' => $title])->first();
        if(empty($exam)){
            $exam = new Exams();
            $exam->title = $title;
            $exam->save();
        }

        return $exam;
    }

    /**
     * @param String $qurstion
     * @return Array
    */
    public function getQuestion($examId, $question){
        return Questions::where(['exam_id' => $examId, 'question' => $question])->first();
    }

}
