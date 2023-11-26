<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkModel;
use App\Models\AssignClassTeacherModel;
use App\Models\HomeworkSubmitModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 



class HomeworkController extends Controller
{
    public function list()
    {
        $data['getRecord']= HomeworkModel::getRecord();
        $data['header_title'] = "Homework";
        return view('admin.homework.list', $data);
    }

    public function add()
    {
      
        $data['getClass'] = classModel::getClass();
        $data['header_title'] = "Add New Homework";
        return view('admin.homework.add', $data);
    }

    public function insert(Request $request)
    {

        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if ($request->hasFile('document_file') && $request->file('document_file')->isValid()) 
        {
            $file = $request->file('document_file');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
    
            $uploadPath = public_path('upload/homework');

        // Store the file in the 'C:\xampp\htdocs\school.com\upload\profile' directory using the Storage facade.
        $file->move($uploadPath, $filename);

        $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('admin/homework/list')->with('succes',"Homework Successfully Created");
    }

    public function ajax_get_subject(Request $request)
{
    $class_id = $request->class_id;
    $getSubject = ClassSubjectModel::MySubject($class_id);
    $html = '<option value="">Select Subject</option>'; // Initialize with the default option

    foreach ($getSubject as $value) {
        $html .= '<option value="'.$value->subject_id.'">'.$value->subject_name.'</option>'; // Append to $html
    }

    $json['success'] = $html;
    return response()->json($json);
}

public function edit($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = classModel::getClass();
        $data['header_title'] = "Edit Homework";
        return view('admin.homework.edit', $data);
    }

    public function update(Request $request,$id)
    {

        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);


        if ($request->hasFile('document_file') && $request->file('document_file')->isValid()) 
        {
            $file = $request->file('document_file');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
    
            $uploadPath = public_path('upload/homework');

        // Store the file in the 'C:\xampp\htdocs\school.com\upload\profile' directory using the Storage facade.
        $file->move($uploadPath, $filename);

        $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('admin/homework/list')->with('succes',"Homework Successfully Updated");
    }
    
    public function delete($id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->is_delete= 1;
        $homework->save();

        return redirect()->back()->with('succes',"Homework Successfully Deleted");
    }

    public function submitted($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);

        if(!empty($homework))
        {
            $data['homework_id'] = $homework_id;
            $data['getRecord']= HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = "Submitted Homework";
            return view('admin.homework.submitted', $data);
        }
        else
        {
            abort(404);
        }
    }


    //Teacher Side 

    public function listTeacher()
    {
        $class_ids = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach ($getClass as $class) {
           $class_ids[] = $class->class_id;
        }
        $data['getRecord']= HomeworkModel::getRecordTeacher($class_ids);
        $data['header_title'] = "Homework";
        return view('teacher.homework.list', $data);
    }

    public function addTeacher()
    {
      
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = "Add New Homework";
        return view('teacher.homework.add', $data);
    }

    public function insertTeacher(Request $request)
    {

        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if ($request->hasFile('document_file') && $request->file('document_file')->isValid()) 
        {
            $file = $request->file('document_file');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
    
            $uploadPath = public_path('upload/homework');

        // Store the file in the 'C:\xampp\htdocs\school.com\upload\profile' directory using the Storage facade.
        $file->move($uploadPath, $filename);

        $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('teacher/homework/list')->with('succes',"Homework Successfully Created");
    }

    public function editTeacher($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = "Edit Homework";
        return view('teacher.homework.edit', $data);
    }

    public function updateTeacher(Request $request,$id)
    {

        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);


        if ($request->hasFile('document_file') && $request->file('document_file')->isValid()) 
        {
            $file = $request->file('document_file');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
    
            $uploadPath = public_path('upload/homework');

        // Store the file in the 'C:\xampp\htdocs\school.com\upload\profile' directory using the Storage facade.
        $file->move($uploadPath, $filename);

        $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('teacher/homework/list')->with('succes',"Homework Successfully Updated");
    }

    public function submittedTeacher($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);

        if(!empty($homework))
        {
            $data['homework_id'] = $homework_id;
            $data['getRecord']= HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = "Submitted Homework";
            return view('teacher.homework.submitted', $data);
        }
        else
        {
            abort(404);
        }
    }

    



    //Student Side 

    public function HomeworkStudent()
    {
        $data['getRecord']= HomeworkModel::getRecordStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = "Homework";
        return view('student.homework.list', $data);
    }

    public function SubmitHomework($homework_id)
    {
        $data['getRecord']= HomeworkModel::getSingle($homework_id);
        $data['header_title'] = "Submit My Homework";
        return view('student.homework.submit', $data);
    }

    public function SubmitHomeworkInsert($homework_id, Request $request)
    {

        $homework = new HomeworkSubmitModel;
        $homework->homework_id = $homework_id;
        $homework->student_id = Auth::user()->id;
        $homework->description = trim($request->description);

        if ($request->hasFile('document_file') && $request->file('document_file')->isValid()) 
        {
            $file = $request->file('document_file');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
    
            $uploadPath = public_path('upload/homework');

        // Store the file in the 'C:\xampp\htdocs\school.com\upload\profile' directory using the Storage facade.
        $file->move($uploadPath, $filename);

        $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('student/my_homework')->with('succes',"Homework Successfully Submitted");
    }

    public function HomeworkSubmittedStudent()
    {
        $data['getRecord']= HomeworkSubmitModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "Submitted Homework";
        return view('student.homework.submitted_list', $data);
    }
}
