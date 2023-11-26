<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Models\TeamModel;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
        'user_type',
        'last_activity',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getSingle($id)
    {
        return self::find($id);  
    
    }

    static public function getTotalUser($user_type)
    {
        return self::select('users.id')
                    ->where('user_type','=',$user_type)
                    ->where('is_delete','=',0)
                    ->count();
    }

    static public function getAdmin()
    {
        $return = self::select('users.*')
                            ->where('user_type','=',1)
                            ->where('is_delete','=',0);
                            if(!empty(Request::get('name')))
                            {
                                $return = $return->where('name','like', '%'.Request::get('name').'%'); 
                            }
                            if(!empty(Request::get('email')))
                            {
                                $return = $return->where('email','like','%'.Request::get('email').'%'); 
                            }
                            if(!empty(Request::get('date')))
                            {
                                $return = $return->whereDate('created_at','=',Request::get('date')); 
                            }
        $return = $return->orderBy('id','desc')
                            ->paginate(5);
        
        return $return;
    }

    static public function getStudent()
    {
        $return = self::select('users.*','class_models.name as class_name') 
                            ->join('class_models', 'class_models.id', '=', 'users.class_id', 'left')
                            ->where('users.user_type','=',2)
                            ->where('users.is_delete','=',0);
            $return = $return->orderBy('users.id','desc')
                            ->paginate(5);
        
        return $return;
    }

    static public function getTeacher()
    {
        $return = self::select('users.*') 
                            ->where('users.user_type','=',3)
                            ->where('users.is_delete','=',0);
            $return = $return->orderBy('users.id','desc')
                            ->paginate(5);
        
        return $return;
    }

    static public function getTeacherStudent($teacher_id)
    {
        $return = self::select('users.*', 'class_models.name as class_name')
            ->join('class_models', 'class_models.id', '=', 'users.class_id', 'left')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class_models.id')
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
            ->where('assign_class_teacher.status', '=', 0)
            ->where('assign_class_teacher.is_delete', '=', 0)
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);
    
        $return = $return->orderBy('users.id', 'desc')
            ->groupBy('users.id', 'class_models.name') // Include class_models.name in GROUP BY
            ->paginate(5);
    
        return $return;
    }

    static public function getTeacherStudentCount($teacher_id)
    {
        $return = self::select('users.id')
            ->join('class_models', 'class_models.id', '=', 'users.class_id', 'left')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class_models.id')
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
            ->where('assign_class_teacher.status', '=', 0)
            ->where('assign_class_teacher.is_delete', '=', 0)
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'desc')
            ->count();
    
        return $return;
    }
    

    static public function getTeacherClass()
    {
        $return = self::select('users.*') 
                        ->where('users.user_type','=',3)
                        ->where('users.is_delete','=',0)
                        ->orderBy('users.id','desc')
                        ->get();

        return $return;
    }

    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }
   

    public function getProfilePictureUrl()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return "";
        
        }
    
}

public function getProfileDirect()
{
    if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
    {
        return url('upload/profile/'.$this->profile_pic);
    }
    else
    {
        return asset('upload/profile/user.jpg');
    
    }

}

    
}