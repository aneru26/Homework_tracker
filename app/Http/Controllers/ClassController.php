<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\classModel;

class ClassController extends Controller
{
    public function list() {

        $data['getRecord'] = classModel::getRecord();
        $data['header_title'] = "Class List";
        return view('admin.class.list',$data);
    }

    public function add()
    {
        
        $data['header_title'] = "Add Admin ";
        return view('admin.class.add',$data);
        
    }

    public function insert(Request $request)
    {
        $save = new classModel;
        $save->name = trim($request->name);
        $save->status = trim($request->status);
        $save-> created_by = Auth::user()->id;
        $save-> save();

        return redirect('admin/class/list')->with('succes',"Class successfully created");
    }


    public function edit($id)
    {
        $data['getRecord'] = classModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Class ";
            return view('admin.class.edit',$data);
        }
        else
        {
                abort(404);
        }
        
    }

    public function update($id, Request $request)
    {

        $save = classModel::getSingle($id);
        $save->name = trim($request->name);
        $save->status = trim($request->status);
        $save->save();

        return redirect('admin/class/list')->with('succes',"Class successfully update");
    }

    public function delete($id)
    {
        $user = classModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/class/list')->with('succes',"Class successfully deleted");
    }

}
