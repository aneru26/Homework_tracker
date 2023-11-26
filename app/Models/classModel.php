<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classModel extends Model
{
    use HasFactory;

    protected $table ="class_models";

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        $return = classModel::select('class_models.*','users.name as created_by_name')
                    ->join('users','users.id','class_models.created_by')
                    ->where('class_models.is_delete', '=', 0)
                    ->orderBy('class_models.id','desc')
                    ->paginate(5);

        return $return;
    }

    static public function  getClass()
    {
        $return = classModel::select('class_models.*')
        ->join('users','users.id','class_models.created_by')
        ->where('class_models.is_delete', '=', 0)
        ->where('class_models.status', '=', 0)
        ->orderBy('class_models.name','asc')
        ->get();

return $return;
    }

    static public function  getTotalClass()
    {
        $return = classModel::select('class_models.id')
         ->join('users','users.id','class_models.created_by')
        ->where('class_models.is_delete', '=', 0)
        ->where('class_models.status', '=', 0)
        ->count();

return $return;
    }


}
