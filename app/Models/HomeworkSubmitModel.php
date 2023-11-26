<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;


class HomeworkSubmitModel extends Model
{
    use HasFactory;

    protected $table = 'homework_submit';


    static public function getRecord($homework_id)
    {
        $return = HomeworkSubmitModel::select('homework_submit.*', 'users.name as first_name', 'users.last_name')
                ->join('users','users.id', '=', 'homework_submit.student_id')
                ->where('homework_submit.homework_id', '=', $homework_id);
                $return = $return->orderBy('homework_submit.id', 'desc');
                $return = $return->paginate(50);
        return $return;

        
    }

    static public function getRecordStudent($student_id)
    {
        $return = HomeworkSubmitModel::select('homework_submit.*','class_models.name as class_name', 'subject_models.name as subject_name')
                    ->join('homework', 'homework.id','=', 'homework_submit.homework_id')
                    ->join('class_models', 'class_models.id', '=', 'homework.class_id')
                    ->join('subject_models', 'subject_models.id', '=', 'homework.subject_id')
                    ->where('homework_submit.student_id', '=', $student_id)
                    ->orderBy('homework_submit.id', 'desc')
                    ->paginate(20);

        return $return;
    }
    //Total Submitted Homework
    static public function getRecordStudentTotal($student_id)
    {
        $return = HomeworkSubmitModel::select('homework_submit.id')
                    ->join('homework', 'homework.id','=', 'homework_submit.homework_id')
                    ->join('class_models', 'class_models.id', '=', 'homework.class_id')
                    ->join('subject_models', 'subject_models.id', '=', 'homework.subject_id')
                    ->where('homework_submit.student_id', '=', $student_id)
                    ->orderBy('homework_submit.id', 'desc')
                    ->count();

        return $return;
    }

    public function getDocument()
    {
        if(!empty($this->document_file) && file_exists('upload/homework/'.$this->document_file))
        {
            return url('upload/homework/'.$this->document_file);
        }
        else
        {
            return "";
        
        }
    
}

    public function getHomework()
    {
        return $this->belongsTo(HomeworkModel::class,"homework_id");
    }

    public function getStudent()
    {
        return $this->belongsTo(User::class,"student_id");
    }
}
