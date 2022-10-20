<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function Register()
    {
        return view('Auth.register');
    }
    public function RegisterPost(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'max:50', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
            'image' => ['required'],
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $ext=$request->name.'.'.$file->getClientOriginalExtension();
            $file->move('Users/Images/', $ext);
            $user->image=$ext;
        }
        $user->save();
        return redirect('login');
    }
// ---------------------------------------------------------------------------------------------------//
    public function Login()
    {
        return view('Auth.login');
    }
    public function LoginPost(Request $request)
    {
        $request->validate([
            'email'   =>['required'],
            'password' => ['required'],
        ]);
        $user=User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('UserID', $user->id);
                return redirect('home');
            }else{
                return back()->with('error','Password Not match');
            }
        }
        return back()->with('error','Your email is invalidate');
    }
//--------------------------------------------------------------------------------------------------//
    public function Dashboard()
    {
        if(session()->has('UserID')){
            $user=User::where('id','=', session('UserID'))->first();
            $data=[
                'usersdata'=>$user,
            ];
        }
        return view('Dashboard.home', $data);
    }
    public function LogOut(){
        if(session()->has('UserID')){
            session()->pull('UserID');
            return redirect('login');
        }
    }
//--------------------------------------------------------------------------------------------------//
    public function ForgatePass(){
        return view('Auth.forgatepass');
    }
    public function PasswordLink(Request $request){
        $request->validate([
            'email'=>['required','exists:users,email'],
        ]);
        $token=Str::random('50');
        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);

        $reset_link=route('ResetPassget',['token'=>$token, 'email'=>$request->email,]);
        $body="We have recive <b>Electro</b>".$request->email.".You can reset your password.";

        Mail::send('emailforgot',['reset_link'=>$reset_link, 'body'=>$body],function($message) use ($request){
            $message->from('noreaply@example.com', 'Electro');
            $message->to($request->email, 'Name')
                    ->subject('Resrt Password');
        });

        return back()->with('error','Send reset link! Please check your email');
    }

    function ResetPassget(){
        return view('Auth.reset-from');
    }

    public function UpdatePass(Request $request){
        $request->validate([
            'email'=>['required','exists:users,email'],
            'password' => ['required', 'min:8', 'max:50', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
        ]);
        $updatepass=DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        $user=User::where('email', $request->email)->update([
            'password'=>Hash::make($request->password)
        ]);
        DB::table('password_resets')->where(['email'=>$request->email])->delete();
        return redirect('login')->with('error', 'Password change successfull!');
    }

}
