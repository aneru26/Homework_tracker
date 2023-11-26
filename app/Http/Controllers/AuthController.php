<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;




class AuthController extends Controller
{
    public function login()
    {

        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard'); 
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('student/dashboard'); 
            } 
            else if(Auth::user()->user_type == 3)
            {
                return redirect('teacher/dashboard'); 
            } 
        }

        return view('auth.login');
    }

    public function Authlogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = User::find(Auth::id());
    
            if ($user->email_verified_at === null) {
                // User's email is not verified
                Auth::logout();
    
                $user->remember_token = Str::random(40);
    
                // Check if user is found before saving
                if ($user->save()) {
                    Mail::to($user->email)->send(new RegisterMail($user));
                    return redirect()->back()->with('error', 'Please verify your email first. We have sent you a verification link.');
                } else {
                    // Handle the case where the user could not be saved
                    return redirect()->back()->with('error', 'An error occurred while processing your request.');
                }
            }
    
            // Check user type and redirect accordingly
            switch ($user->user_type) {
                case 1:
                    return redirect('admin/dashboard');
                case 2:
                    return redirect('student/dashboard');
                case 3:
                    return redirect('teacher/dashboard');
                default:
                    // Handle unexpected user types here
                    break;
            }
        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }
    

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        // Validate the incoming request data
       $validatedData = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/|confirmed',
    'user_type' => 'required|in:2,3',
    // 'g-recaptcha-response' => 'required|captcha',
], [
    'password.regex' => 'The :attribute must contain at least one lowercase letter, one uppercase letter, one number, and one special character (@$!%*?&).',
]);


    
        // Create the user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->remember_token = Str::random(40);
    
        // Assign the selected user_type to the user
        $user->user_type = $validatedData['user_type'];
      
    
        $user->save();

        Mail::to($user->email)->send(new RegisterMail($user));
    
        // You can customize the redirection after registration as per your requirement
        return redirect('register')->with('succes', 'Registration successful.Please Verify your Email to Login.');
    }
    
    

    public function forgotpassword()
    {
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request)
    {
       $user = User::getEmailSingle($request->email);
       if(!empty($user))
       {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('succes',"Please check you Email and Reset your Password");
       }
       else
       {
            return redirect()->back()->with('error',"Email not Found");
       }
    }


    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function PostReset($token, Request $request )
    {
        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url(''))->with('succes', "Password Succesfully Reset");
        }
        else
        {
            return redirect()->back()->with('error',"Password does not match");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('/'));
    }

    public function verify($token)
    {
        $user = User::where('remember_token','=', $token)->first();
        if(!empty($user))
        {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();

            return redirect('/')->with('succes', " Your Account successfully Verified");
        }
        else
        {
            abort(404);
        }
    }


    
        public function checkLogin() {
        if (Auth::check()) {
          return response()->json(['isLoggedIn' => true]);
        } else {
          return response()->json(['isLoggedIn' => false]);
        }
      }

}
