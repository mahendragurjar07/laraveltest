<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model {

    protected $table = 'questions';

    public function exam() {
        return $this->hasOne('App\Models\Exams','id','exam_id');
    }
}
