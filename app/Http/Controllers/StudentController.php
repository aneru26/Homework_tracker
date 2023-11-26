<?php

namespace App\Http\Controllers;

use App\Models\classModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage;
use Mockery\CountValidator\AtMost;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord']= User::getStudent();
        $data['header_title'] = "Student List ";
        return view(request()->is('admin/*') ? 'admin.student.list' : 'teacher.student.list', $data);
    }

    public function add()
    {
        $data['getClass'] = classModel::getClass(); 
        $data['header_title'] = "Add Student ";
        return view(request()->is('admin/*') ? 'admin.student.add' : 'teacher.student.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'id_number' => 'max:9',
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->id_number = trim($request->id_number);
        $student->program = trim($request->program);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);

        if ($request->hasFile('profile_pic') && $request->file('profile_pic')->isValid()) 
        {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
    
            $uploadPath = public_path('upload/profile');

        // Store the file in the 'C:\xampp\htdocs\school.com\upload\profile' directory using the Storage facade.
        $file->move($uploadPath, $filename);

        $student->profile_pic = $filename;
        }
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 2;
        $student->save();

        $redirectPath = $request->is('admin/*') ? 'admin/student/list' : 'teacher/student/list';

    return redirect($redirectPath)->with('succes', "Student Successfully Added");

        
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
            $data['getClass'] = classModel::getClass();
            $data['header_title'] = "Edit Student ";
            return view(request()->is('admin/*') ? 'admin.student.edit' : 'teacher.student.edit', $data);
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
           

            
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->id_number = trim($request->id_number);
        $student->program = trim($request->program);    
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);


        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move(public_path('upload/profile/'), $filename);

            $student->profile_pic = $filename;
        }

        $student->status = trim($request->status);
        $student->email = trim($request->email);
        
        $student->password = Hash::make($request->password);
        $student->save();

        $redirectPath = $request->is('admin/*') ? 'admin/student/list' : 'teacher/student/list';
    
        return redirect($redirectPath)->with('succes', "Student successfully Updated");

       
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();

            return redirect()->back()->with('succes',"Student successfully Deleted");
        }
        else
        {
            abort(404);
        }
        
    }

    //Teacher MyStudent

    public function MyStudent()
    {

        $data['getRecord']= User::getTeacherStudent(Auth::user()->id);
        $data['header_title'] = " My Student List ";
        return view('teacher.my_student', $data);
    }
}
