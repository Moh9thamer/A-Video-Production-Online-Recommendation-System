<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    function getAdmins(){
        $data = User::select("*")->where('role','=',1)->paginate(5);

        return view('admin/Users/usersList',['admins' =>$data]);

    }


    function add(Request $req){

        $validated = $req->validate([
            'name'     => 'required|regex:/^[\pL\s\-]+$/u',
            'email'    => 'email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->role = 1;
        $user->email = $req->email;
        $user->password =Hash::make($req->password);
        $user->save();
        $req->session()->flash('user',$req->name);
        return redirect()->back();
    }


    function delete($id){
            $data= User::find($id);
            $data->delete();
            Session::flash('message', 'User Deleted Successfully!');
            return redirect()->back();
    }

}
