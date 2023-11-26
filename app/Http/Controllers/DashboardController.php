<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TeamModel;
use App\Models\classModel;
use App\Models\SubjectModel;
use App\Models\AssignClassTeacherModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkModel;
use App\Models\HomeworkSubmitModel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';
        if(Auth::user()->user_type == 1)
            {
                $data['TotalAdmin'] = User::getTotalUser(1);
                $data['TotalStudent'] = User::getTotalUser(2);
                $data['TotalTeacher'] = User::getTotalUser(3);

                $data['TotalClass'] = classModel::getTotalClass();
                $data['TotalSubject'] = SubjectModel::getTotalSubject();
    
                return view('admin.dashboard',$data);
            }
            else if(Auth::user()->user_type == 2)
            {

                $data['TotalSubject'] = ClassSubjectModel::MySubjectTotal(Auth::user()->class_id);
                $data['TotalHomework']= HomeworkModel::getRecordStudentCount(Auth::user()->class_id, Auth::user()->id);
                $data['TotalHomeworkSubmitted']= HomeworkSubmitModel::getRecordStudentTotal(Auth::user()->id);
                
                return view('student.dashboard',$data);
            } 
            else if(Auth::user()->user_type == 3)
            {
                $data['TotalStudent'] = User::getTeacherStudentCount(Auth::user()->id);
                $data['TotalClass'] = AssignClassTeacherModel::getMyClassSubjectGroupCount(Auth::user()->id);
                $data['TotalSubject'] = AssignClassTeacherModel::getMyClassSubjectCount(Auth::user()->id);
                $data['TotalHomework'] = HomeworkModel::getRecordTeacherCount(Auth::user()->id);
               
                return view('teacher.dashboard',$data);
            } 
    }
}
