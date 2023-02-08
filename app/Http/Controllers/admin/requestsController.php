<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\locationRequest;
use App\Models\equipmentRequest;
use App\Models\talent;
class requestsController extends Controller
{

    function getLocationRequests(){
        $requests = locationRequest::where('status','pending')->get();
        return  view('admin/Locations/requests')->with('requests',$requests);


    }

    function getAcceptedLocationRequests(){
        $requests = locationRequest::where('status','accepted')->get();
        return  view('admin/Locations/list')->with('requests',$requests);


    }

    function getAcceptedEquipmentsRequests(){
        $requests = equipmentRequest::where('status','accepted')->get();
        return  view('admin/equipments/list')->with('requests',$requests);


    }

    function getEquipmentRequests(){
        $requests = equipmentRequest::where('status','pending')->get();
        return  view('admin/equipments/requests')->with('requests',$requests);


    }


    function acceptLocRequest(Request $req){
        locationRequest::where('id', $req->id)
            ->update(['status' => 'accepted']);
        return redirect()->back()->with('message', 'The request has been accepted.');

    }

    function acceptEqRequest(Request $req){
        equipmentRequest::where('id', $req->id)
            ->update(['status' => 'accepted']);
        return redirect()->back()->with('message', 'The request has been accepted.');

    }


    function deleteEqRequest(Request $req){
        equipmentRequest::where('id', $req->id)
            ->delete();
        return redirect()->back()->with('message', 'The request has been deleted successfully.');
    }


    function deleteLocRequest(Request $req){
        locationRequest::where('id', $req->id)
            ->delete();
        return redirect()->back()->with('message', 'The request has been deleted successfully.');
    }


    function adminDashboard(){
        return view('admin/dashboard');
    }

function getTalentsList(){

        $data = talent::paginate(5);
        return view('admin/talents/list',['data'=>$data]);

    }

    function deleteTalent(Request $req){
        talent::where('id', $req->id)
            ->delete();
        return redirect()->back()->with('message', 'The talent has been deleted successfully.');
    }


}
