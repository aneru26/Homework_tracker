<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord']= User::getAdmin();
        $data['header_title'] = "Admin List ";
        return view('admin.admin.list',$data);
    }

    public function add()
    {
        
        $data['header_title'] = "Add Admin ";
        return view('admin.admin.add',$data);
        
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->email = trim($request->email);
        $user->program = trim($request->program);
        $user->designation = trim($request->designation);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($user->getProfile))
            {
                unlink('upload/profile/'.$user->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move(public_path('upload/profile/'), $filename);

            $user->profile_pic = $filename;
           
        }

        $user-> save();

        return redirect('admin/admin/list')->with('succes',"Admin successfully created");
       
    }

    public function show($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Show Admin ";
            return view('admin.admin.show',$data);
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
            $data['header_title'] = "Edit Admin ";
            return view('admin.admin.edit',$data);
        }
        else
        {
                abort(404);
        }
        
    }


    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->program = trim($request->program);
        $user->designation = trim($request->designation);
        $user->email = trim($request->email);
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($user->getProfile))
            {
                unlink('upload/profile/'.$user->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move(public_path('upload/profile/'), $filename);

            $user->profile_pic = $filename;
        }

        $user->save();

        return redirect('admin/admin/list')->with('succes',"Admin successfully update");
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/admin/list')->with('succes',"Admin successfully deleted");
    }

}
