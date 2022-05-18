<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::getAllUser();
        $roles = UserRole::all();

        // return $users;
        return view('user.index')->with([
            'users'=>$users,
            'roles'=>$roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = UserRole::all();
        return view('user.create')->with([
            'roles'=>$roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->user_name = $request->name;
        $user->user_email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        // $user->password = bcrypt($request->password);
        $user->role_id = $request->role;
        $user->save();
        return redirect()->route('user.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = UserRole::all();
        $user->role_name = UserRole::findRoleById($user->role_id)->role_name;
        return view('user.show')->with([
            'user'=>$user,
            'roles'=>$roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with([
            'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->user_name = $request->name;
        $user->user_email = $request->email;
        $user->phone = $request->phone;
        if($request->role){
            $user->role_id = $request->role;
        }

        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('user.show', $user);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with([
            'msg'=>"Delete success"
        ]);
    }
}
