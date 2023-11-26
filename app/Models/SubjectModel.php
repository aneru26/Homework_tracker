<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    use HasFactory;

    protected $table ="subject_models";

    static public function getSingle($id)
    {
        return self::find($id);
    }

    
    static public function getRecord()
    {
        $return = SubjectModel::select('subject_models.*','users.name as created_by_name')
                    ->join('users','users.id','subject_models.created_by')
                    ->where('subject_models.is_delete', '=', 0)
                    ->orderBy('subject_models.id','desc')
                    ->paginate(5);

        return $return;
    }

    static public function getSubject()
    {
        $return = SubjectModel::select('subject_models.*')
                    ->join('users','users.id','subject_models.created_by')
                    ->where('subject_models.is_delete', '=', 0)
                    ->where('subject_models.status', '=', 0)
                    ->orderBy('subject_models.name','asc')
                    ->get();

        return $return;
    }

    static public function getTotalSubject()
    {
        $return = SubjectModel::select('subject_models.id')
                    ->join('users','users.id','subject_models.created_by')
                    ->where('subject_models.is_delete', '=', 0)
                    ->where('subject_models.status', '=', 0)
                    ->count();
        return $return;
    }
   
}
