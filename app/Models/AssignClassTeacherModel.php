<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssignClassTeacherModel extends Model
{
    use HasFactory;

    protected $table ="assign_class_teacher";


    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('assign_class_teacher.*', 'class_models.name as class_name','subject_models.name as subject_name', 'teacher.name as teacher_name','teacher.last_name as teacher_last_name', 'users.name as created_by_name')
                    ->join('users as teacher', 'teacher.id', '=', 'assign_class_teacher.teacher_id')
                    ->join('class_models', 'class_models.id', '=', 'assign_class_teacher.class_id')
                    ->join('subject_models', 'subject_models.id', '=', 'assign_class_teacher.subject_id')
                    ->join('users', 'users.id', '=', 'assign_class_teacher.created_by')
                    ->where('assign_class_teacher.is_delete', '=', 0)
                    ->orderBy('assign_class_teacher.id', 'desc')
                    ->paginate(10);
    }

    static public function getMyClassSubjectCount($teacher_id)
    {

        return self::select('assign_class_teacher.id')
        ->join('class_models', 'class_models.id', '=', 'assign_class_teacher.class_id')
        ->join('class_subject_models', 'class_subject_models.class_id', '=', 'class_models.id')
        ->join('subject_models', 'subject_models.id', '=', 'class_subject_models.subject_id')
        ->where('assign_class_teacher.is_delete', '=', 0)
        ->where('assign_class_teacher.status', '=', 0)
        ->where('subject_models.status', '=', 0)
        ->where('subject_models.is_delete', '=', 0)
        ->where('class_subject_models.status', '=', 0)
        ->where('class_subject_models.is_delete', '=', 0)
        ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
        ->count();
    }

    static public function getMyClassSubject($teacher_id)
    {

        return self::select('assign_class_teacher.*', 'class_models.name as class_name','subject_models.name as subject_name','subject_models.type as subject_type' )
        ->join('class_models', 'class_models.id', '=', 'assign_class_teacher.class_id')
        ->join('class_subject_models', 'class_subject_models.class_id', '=', 'class_models.id')
        ->join('subject_models', 'subject_models.id', '=', 'class_subject_models.subject_id')
        ->where('assign_class_teacher.is_delete', '=', 0)
        ->where('assign_class_teacher.status', '=', 0)
        ->where('subject_models.status', '=', 0)
        ->where('subject_models.is_delete', '=', 0)
        ->where('class_subject_models.is_delete', '=', 0)
        ->where('class_subject_models.status', '=', 0)
        ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
        ->get();
    }

    
    static public function getAlreadyFirst($class_id, $teacher_id)
    {
        return self::where('class_id', '=', $class_id)->where('teacher_id', '=', $teacher_id)->first();
    }

    static public function getAssignTeacherID($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }

    static public function deleteTeacher($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }

    static public function getMyClassSubjectGroup($teacher_id)
    {
        return AssignClassTeacherModel::select('assign_class_teacher.class_id', DB::raw('MAX(class_models.name) as class_name'), 'class_models.id as class_id')
    ->join('class_models', 'class_models.id', '=', 'assign_class_teacher.class_id')
    ->where('assign_class_teacher.is_delete', '=', 0)
    ->where('assign_class_teacher.status', '=', 0)
    ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
    ->groupBy('assign_class_teacher.class_id', 'class_models.id')
    ->get();

    }

    static public function getMyClassSubjectGroupCount($teacher_id)
    {
     return AssignClassTeacherModel::select('assign_class_teacher.id')
    ->join('class_models', 'class_models.id', '=', 'assign_class_teacher.class_id')
    ->where('assign_class_teacher.is_delete', '=', 0)
    ->where('assign_class_teacher.status', '=', 0)
    ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
    ->count();

    }
}
