<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\locationRequest;
use App\Models\equipmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class requests extends Controller
{
    function vendorsPage(){
        $user_id = Auth::id();

        $status ='';
        $result = locationRequest::where('user_id',$user_id)->get(['status']);;
        $count= $result->count();
        if($count == 0){
            $status ='no_request';
        }
        else if($count == 1){
               foreach ($result as $r){
                   if ($r->status == 'pending'){
                       $status= 'pending';
                   }
                   else if($r->status == 'accepted'){
                       $status= 'accepted';
                   }
               }
        }


        $status2 ='';
        $result2 = equipmentRequest::where('user_id',$user_id)->get(['status']);;
        $count2= $result2->count();
        if($count2 == 0){
            $status2 ='no_request';
        }
        else if($count2 == 1){
            foreach ($result2 as $r){
                if ($r->status == 'pending'){
                    $status2= 'pending';
                }
                else if($r->status == 'accepted'){
                    $status2= 'accepted';
                }
            }
        }

        return view('main/vendorsTypeSelection')->with('status',$status)->with('status2',$status2);
    }

    function saveLocationRequest(Request $req)
    {



        $req->validate([
            "file" => "required|mimes:pdf|max:10000"
        ]);

        $uniqueFileName = uniqid() . $req->file('file')->getClientOriginalName() . '.' . $req->file('file')->getClientOriginalExtension();
        $req->file('file')->storeAs('public/locationRequests/',$uniqueFileName);



       if($file = $req->file('file')){

              $lRequest = new locationRequest();
              $lRequest->user_id = Auth::id();
              $lRequest->phone = $req->phone;
              $lRequest->license= $uniqueFileName;
              $lRequest->save();

              return redirect()->action([requests::class, 'vendorsPage'])->with('Locmessage', 'Your Request has been submitted successfully, Please wait until you get your acceptance ');


      }
        return redirect()->back();
    }


    function saveEquipmentRequest(Request $req)
    {



        $req->validate([
            "file" => "required|mimes:pdf|max:10000"
        ]);


        $uniqueFileName = uniqid() . $req->file('file')->getClientOriginalName() . '.' . $req->file('file')->getClientOriginalExtension();
        $req->file('file')->storeAs('public/equipmentRequests/',$uniqueFileName);



        if($file = $req->file('file')){

            $lRequest = new equipmentRequest();
            $lRequest->user_id = Auth::id();
            $lRequest->phone = $req->phone;
            $lRequest->license= $uniqueFileName;
            $lRequest->address= $req->address;
            $lRequest->save();

            return redirect()->action([requests::class, 'vendorsPage'])->with('Equmessage', 'Your Request has been submitted successfully, Please wait until you get your acceptance ');


        }
        return redirect()->back();
    }







}
