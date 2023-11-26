<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class ClassSubjectModel extends Model
{
    use HasFactory;

    protected $table ="class_subject_models";

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('class_subject_models.*', 'class_models.name as class_name', 'subject_models.name as subject_name', 'users.name as created_by_name')
                    ->join('subject_models', 'subject_models.id', '=', 'class_subject_models.subject_id')
                    ->join('class_models', 'class_models.id', '=', 'class_subject_models.class_id')
                    ->join('users', 'users.id', '=', 'class_subject_models.created_by')
                    ->where('class_subject_models.is_delete', '=', 0)
                    ->orderBy('class_subject_models.id', 'desc')
                    ->paginate(10);
    }

    static public function MySubject($class_id)
    {
        return self::select('class_subject_models.*', 'subject_models.name as subject_name', 'subject_models.type as subject_type')
                    ->join('subject_models', 'subject_models.id', '=', 'class_subject_models.subject_id')
                    ->join('class_models', 'class_models.id', '=', 'class_subject_models.class_id')
                    ->join('users', 'users.id', '=', 'class_subject_models.created_by')
                    ->where('class_subject_models.class_id', '=', $class_id)
                    ->where('class_subject_models.is_delete', '=', 0)
                    ->where('class_subject_models.status', '=', 0)
                    ->orderBy('class_subject_models.id', 'desc')
                    ->get();
    }

    static public function MySubjectTotal($class_id)
    {
        return self::select('class_subject_models.id')
                    ->join('subject_models', 'subject_models.id', '=', 'class_subject_models.subject_id')
                    ->join('class_models', 'class_models.id', '=', 'class_subject_models.class_id')
                    ->join('users', 'users.id', '=', 'class_subject_models.created_by')
                    ->where('class_subject_models.class_id', '=', $class_id )
                    ->where('class_subject_models.is_delete', '=', 0)
                    ->where('class_subject_models.status', '=', 0)
                    ->orderBy('class_subject_models.id', 'desc')
                    ->count();
    }

    static public function getAlreadyFirst($class_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }

    static public function getAssignSubjectID($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }

    static public function deleteSubject($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }
}
