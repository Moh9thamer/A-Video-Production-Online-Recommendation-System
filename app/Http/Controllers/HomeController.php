<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Models\locationRequest;
use App\Models\equipmentRequest;
use App\Models\talent;
use App\Models\User;


class HomeController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if($role == '1')
        {
            $countEqList = equipmentRequest::where('status' ,'accepted')->count();
            $countEqReq = equipmentRequest::where('status' ,'pending')->count();

            $countLocList = locationRequest::where('status' ,'accepted')->count();
            $countLocReq = locationRequest::where('status' ,'pending')->count();

            $countTalents = talent::count();
            $countAdmins= User::where('role' ,1)->count();

            return view('admin.dashboard',['c1'=>$countEqList , 'c2'=>$countEqReq , 'c3'=>$countLocList , 'c4'=> $countLocReq ,'c5'=>$countTalents , 'c6'=>$countAdmins] );
        }
        else{
            return view('main.dashboard');
        }
    }
}
