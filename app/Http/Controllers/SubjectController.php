<?php

namespace App\Http\Controllers;

use App\Models\classModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list() {

        $data['getRecord'] = SubjectModel::getRecord();
        $data['header_title'] = "Subject List";
        return view('admin.subject.list',$data);
    }

    public function add()
    {
        $data['getClass'] = classModel::getClass();
        $data['header_title'] = "Add Subject ";
        return view('admin.subject.add',$data);
        
    }

    public function insert(Request $request)
    {
        $save = new SubjectModel();
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save-> created_by = Auth::user()->id;
        $save-> save();

        return redirect('admin/subject/list')->with('succes',"Subject successfully created");
    }


    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Class ";
            return view('admin.subject.edit',$data);
        }
        else
        {
                abort(404);
        }
        
    }

    public function update($id, Request $request)
    {

        $save = SubjectModel::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->save();

        return redirect('admin/subject/list')->with('succes',"Subject successfully update");
    }

    public function delete($id)
    {
        $user = SubjectModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/subject/list')->with('succes',"Subject successfully deleted");
    }



    //student

    public function MySubject()
    {
        $data['getRecord'] = ClassSubjectModel::MySubject(Auth::user()->class_id);
        $data['header_title'] = "My Subject";
        return view('student.my_subject',$data);
    }
}
