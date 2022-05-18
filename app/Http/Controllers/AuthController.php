<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function userInfo(){
        return view('auth.user-info');
    }

    public function login(){
        return view('auth.login');
    }

    public  function auth(AuthRequest $request){


        $emailOrPhone = $request->email_phone;
        $password = $request->password;

        if(Auth::attempt(['user_email'=>$emailOrPhone, 'password'=>$password]) || Auth::attempt(['phone'=>$emailOrPhone, 'password'=>$password], true)){
            // return auth()->user();
            return redirect()->route('room.diagram')->with([ //change to dashboard
                 'msg'=>'Đăng nhập thành công!'
            ]);
        }else{
            return back()->with([
                'msg'=>'Email/Số điện thoại hoặc mật khẩu không đúng!'
            ]);
        }


        // $user = User::where('user_email', $request->email)->first();
        // if($user){
        //     if(Hash::check($request->password, $user->password)){
        //         $token = $user->createToken($request->email)->plainTextToken;
        //         return response([
        //             'msg'=>'Login success',
        //             'user'=>$user,
        //             'token'=>$token
        //         ],200);
        //     }else{
        //         return response([
        //             'msg'=>'Password is invalid',
        //         ],401);            }
        // }else{
        //     return response([
        //         'msg'=>'Email is invalid',
        //     ],401);
        // }



        // if(!$user || Hash::check($request->password, $user->password)){
        //     return response([
        //         'msg'=>'Password is invalid',
        //     ],401);
        // }
        // $token = $user->createToken($request->email)->plainTextToken;
        // return response([
        //     'msg'=>'Login success',
        //     'user'=>$user,
        //     'token'=>$token
        // ],200);
    }

    public function register(){
        return view('auth.register');
    }

    public function store(Request $request){
        $user = new User();
        $user->user_name = $request->name;
        $user->user_email = $request->email;
        $user->phone = $request->phone;
        // $user->password = Hash::make($request->password);
        $user->password = bcrypt($request->password);

        $user->role_id = $request->role;
        $user->save();
        return response([
            'user'=>$user,
        ],201);
    }

    public function logout(Request $request){
        // $request->user()->currentAccessToken()->delete();
        if(auth()->user()){
            Auth::logout();
            return redirect()->route('login')->with([
                'msg'=>"Bạn đã đăng xuất!"
            ]);
        }else{
            return redirect()->route('login');
        }
    }
}
