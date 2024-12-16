<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserPathController extends Controller
{
    //
    function login(Request $request){
       $user = User::where('email',$request->email)->first();
       if(!$user || !Hash::check($request->password,$user->password)){
        return ['result'=>"user not found","Success"=>false];
       }
       $success['token'] = $user->createToken('MyApp')->plainTextToken;
       $user['email']=$user->email;
       return ['success'=>true, "result"=>$success, "msg"=>"User register successfully"];
    }
    function signup(Request $request){
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user= User::create($input);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $user['name']=$user->name;
        $user['email']=$user->email;
        return ['success'=>true, "result"=>$success, "msg"=>"User register successfully"];
       
    }
}
