<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model {

    protected $table = 'exams';

    public function questions() {
        return $this->hasMany('App\Models\Questions','exam_id','id');
    }
}
