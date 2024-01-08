<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Illuminate\Foundation\Vite;


class UserController extends Controller
{
   public function index()
   {
    
    $user = user::all();
    $data = [
        'status'=>200,
        "user"=>$user
  
    ];

    return response()->json($data,200);
   }
public function upload(Request $request)
{
 $validator=Validator::make($request->all(),

 [
   'name'=>'required',
   'password'=>'required',
   'email'=>'required|email'
 ]);

   if($validator->fails())
   {
    $data=[
        "status"=>422,
        "message"=>$validator->messages()
    ]; 
   
    return response()->json($data,422);

   } 
 else{
    $user = new user;

    $user->name=$request->name;
    $user->password=$request->password;
    $user->email=$request->email;

    $user->save();

    $data=[

        'status'=>200,
        'message'=>'The Data uploaded successfully' 
    ];
   return response()->json($data,200);


 }

}
public function edit(Request $request,$id)
{
 $validator = validator::make($request->all(),
 
 [
   'name'=>'required',
   'password'=>'required',
   'email'=>'required|email|unique:users,email'

 ]);

 if($validator->fails())
 {
    $data=[
        "status"=>422,
        "message"=>$validator->messages()
    
    ];

    return response()->json($data,422);

 }
 else
 {
    $user = user::find($id);

    $user->name=$request->name;
    $user->password=$request->password;
    $user->email=$request->email
    ;

    $user->save();

    $data=[
        'status'=>200,
        'message'=>'The data updated successfully'
    ];

    return response()->json($data,200);
 }
}
    public function delete($id)
    {
        $user=user::find($id);
        $user->delete();
        $data=
        [
            'status'=>200,
            'message'=>'The data deleted successfully'
        ];

        return response()->json($data,200);
    }
}
