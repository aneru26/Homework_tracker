<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkModel extends Model
{
    use HasFactory;

    protected $table ="homework";

    static public function getSingle($id) 
    {
        return self::find($id);
    }


    static public function getRecord()
    {
        
        $return = HomeworkModel::select('homework.*', 'class_models.name as class_name', 'subject_models.name as subject_name', 'users.name as created_by_name')
                ->join('users', 'users.id', '=', 'homework.created_by')
                ->join('class_models', 'class_models.id', '=', 'homework.class_id')
                ->join('subject_models', 'subject_models.id', '=', 'homework.subject_id')
                ->where('homework.is_delete','=', 0)
                ->orderBy('homework.id','desc')
                ->paginate(20);

        return $return;
    }

    static public function getRecordTeacher($class_ids)
    {
        
        $return = HomeworkModel::select('homework.*', 'class_models.name as class_name', 'subject_models.name as subject_name', 'users.name as created_by_name')
                ->join('users', 'users.id', '=', 'homework.created_by')
                ->join('class_models', 'class_models.id', '=', 'homework.class_id')
                ->join('subject_models', 'subject_models.id', '=', 'homework.subject_id')
                ->whereIn('homework.class_id', $class_ids)
                ->where('homework.is_delete','=', 0)
                ->orderBy('homework.id','desc')
                ->paginate(20);

        return $return;
    }

    static public function getRecordTeacherCount($class_ids)
    {
        // Ensure $class_ids is an array
        $class_ids = is_array($class_ids) ? $class_ids : [$class_ids];
    
        $return = HomeworkModel::select('homework.*')
            ->join('users', 'users.id', '=', 'homework.created_by')
            ->join('class_models', 'class_models.id', '=', 'homework.class_id')
            ->join('subject_models', 'subject_models.id', '=', 'homework.subject_id')
            ->whereIn('homework.class_id', $class_ids)
            ->where('homework.is_delete','=', 0)
            ->count();
    
        return $return;
    }
    

    static public function getRecordStudent($class_id, $student_id)
    {
        
        $return = HomeworkModel::select('homework.*', 'class_models.name as class_name', 'subject_models.name as subject_name', 'users.name as created_by_name')
                ->join('users', 'users.id', '=', 'homework.created_by')
                ->join('class_models', 'class_models.id', '=', 'homework.class_id')
                ->join('subject_models', 'subject_models.id', '=', 'homework.subject_id')
                ->where('homework.class_id', '=', $class_id)
                ->where('homework.is_delete','=', 0)
                ->whereNotIn('homework.id', function($query) use ($student_id) {
                    $query->select('homework_submit.homework_id')
                          ->from('homework_submit')
                          ->where('homework_submit.student_id', '=', $student_id);
                })
                ->orderBy('homework.id','desc')
                ->paginate(20);

        return $return;
    }
//Total Student Homework
    static public function getRecordStudentCount($class_id, $student_id)
    {
        
        $return = HomeworkModel::select('homework.id')
                ->join('users', 'users.id', '=', 'homework.created_by')
                ->join('class_models', 'class_models.id', '=', 'homework.class_id')
                ->join('subject_models', 'subject_models.id', '=', 'homework.subject_id')
                ->where('homework.class_id', '=', $class_id)
                ->where('homework.is_delete','=', 0)
                ->whereNotIn('homework.id', function($query) use ($student_id) {
                    $query->select('homework_submit.homework_id')
                          ->from('homework_submit')
                          ->where('homework_submit.student_id', '=', $student_id);
                })
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
}
