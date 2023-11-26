<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function list()
    {
        $data['getRecord']= User::getTeacher();
        $data['header_title'] = "Teacher List ";
        return view(request()->is('admin/*') ? 'admin.teacher.list' : 'teacher.teacher.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add Teacher ";
        return view(request()->is('admin/*') ? 'admin.teacher.add' : 'teacher.teacher.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'id_number' => 'max:9',
        ]);

        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->id_number = trim($request->id_number);
        $teacher->program = trim($request->program);
        $teacher->designation = trim($request->designation);
        $teacher->gender = trim($request->gender);

        if ($request->hasFile('profile_pic') && $request->file('profile_pic')->isValid()) 
        {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
    
            $uploadPath = public_path('upload/profile');

        // Store the file in the 'C:\xampp\htdocs\school.com\upload\profile' directory using the Storage facade.
        $file->move($uploadPath, $filename);

        $teacher->profile_pic = $filename;
        }
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 3;
        $teacher->save();

        $redirectPath = $request->is('admin/*') ? 'admin/teacher/list' : 'teacher/teacher/list';

    return redirect($redirectPath)->with('succes', "Teacher Successfully Added");

        
    }

    public function show($id)
    {
        $data['getRecord'] = User::getSingle($id);
    
        if (!empty($data['getRecord']))
        {
            // Join the Team table to retrieve the team name
            $data['getRecord']->load('team');
    
            $data['header_title'] = "Edit Student ";
            return view(request()->is('admin/*') ? 'admin.student.show' : 'teacher.student.show', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Teacher ";
            return view(request()->is('admin/*') ? 'admin.teacher.edit' : 'teacher.teacher.edit', $data);
        }
        else
        {
                abort(404);
        }
        
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'id_number' => 'max:9|min:9'

            
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->id_number = trim($request->id_number);
        $teacher->program = trim($request->program);    
        $teacher->designation = trim($request->designation);
        $teacher->gender = trim($request->gender);


        if(!empty($request->file('profile_pic')))
        {
            if(!empty($teacher->getProfile))
            {
                unlink('upload/profile/'.$teacher->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move(public_path('upload/profile/'), $filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        
        $teacher->password = Hash::make($request->password);
        $teacher->save();

        $redirectPath = $request->is('admin/*') ? 'admin/teacher/list' : 'teacher/student/list';
    
        return redirect($redirectPath)->with('succes', "Teacher successfully Updated");

       
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();

            return redirect()->back()->with('succes',"Teacher successfully Deleted");
        }
        else
        {
            abort(404);
        }
        
    }
}
