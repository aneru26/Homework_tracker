<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classModel;
use App\Models\User;
use App\Models\AssignClassTeacherModel;
use App\Models\SubjectModel;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list()
    {
        $data['getRecord']= AssignClassTeacherModel::getRecord();
        $data['header_title'] = "Assign Class Teacher List ";
        return view('admin.assign_class_teacher.list',$data);
    }

    public function add()
    {
        
        $data['getClass'] = classModel::getClass();
        $data['getTeacher'] = User::getTeacher();
        $data['header_title'] = "Assign Class Teacher Add ";
        return view('admin.assign_class_teacher.add',$data);
        
    }


    public function insert(Request $request)
    {
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
    
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id,$teacher_id);
                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $save = new AssignClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id; 
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
    
            return redirect('admin/assign_class_teacher/list')->with('succes', "Teacher Successfully Assigned to Class");
        } 
        else {
            return redirect()->back()->with('error', 'Due to some error, please try again');
        }
    }

    public function edit($id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        if(!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data ['getAssignTeacherID'] = AssignClassTeacherModel::getAssignTeacherID($getRecord->class_id);
            $data['getClass'] = classModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = "Assign Teacher Edit ";
            return view('admin.assign_class_teacher.edit',$data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id,Request $request)
    {
        AssignClassTeacherModel::deleteTeacher($request->class_id);

        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
    
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id,$teacher_id);
                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $save = new AssignClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id; 
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
    
        }

        return redirect('admin/assign_class_teacher/list')->with('succes', "Teacher Successfully Assigned to Class");
    }

    public function delete($id)
    {
        $save = AssignClassTeacherModel::getSingle($id);
        $save->delete();
        

        return redirect()->back()->with('succes','Record successfully deleted');
    }


    public function edit_single($id)
    {
        $getRecord = AssignClassTeacherModel::getSingle($id);
        if(!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = classModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = "Assign Teacher Edit ";
            return view('admin.assign_class_teacher.edit_single',$data);
        }
        else
        {
            abort(404);
        }
    }


    public function update_single($id, Request $request)
    {
       
           
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id,$request->teacher_id);
                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();

                    
                    return redirect('admin/assign_class_teacher/list')->with('succes', "Teacher Successfully Update");
                }
                else
                {
                    $save = AssignClassTeacherModel::getSingle($id);
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $request->teacher_id; 
                    $save->status = $request->status;
                    $save->save();

                    return redirect('admin/assign_class_teacher/list')->with('succes', "Teacher Successfully Update");
                }

    }


    //teacher side work 

    public function MyClassSubject()
    {
        $data['getRecord'] = AssignClassTeacherModel::getMyClassSubject(Auth::user()->id);
        $data['header_title'] = "My Class & Subject ";
        return view('teacher.my_class_subject',$data);
    }
}
