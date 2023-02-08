<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\location;
use App\Models\locationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class locationsController extends Controller
{

    function getLocations(){
        $data = location::select("*")->where('owner_id','=',Auth::id())->paginate(5);
        return view('vendors/locations/list',['locations' =>$data]);

    }

    function addLocation(Request $req){


        $req->validate([
            'file'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"
        ]);



        $uniqueFileName = uniqid() . $req->file('file')->getClientOriginalName() . '.' . $req->file('file')->getClientOriginalExtension();
        $req->file('file')->storeAs('public/locations/',$uniqueFileName);



        if($file = $req->file('file')){

           $location = new location();
            $location->owner_id = Auth::id();
            $location->name = $req->name;
            $location->description = $req->desc;
            $location->price = $req->price;
            $location->address = $req->address;
            $location->image= $uniqueFileName;
            $location->save();

            return redirect()->back()->with('Locmessage', 'The location has been added');


        }
        return redirect()->back();
    }


    function getUpdatedLocation(){

    }


    function deleteLocation($id){
        $data= location::find($id);
        $data->delete();
        Session::flash('message', 'Locations Deleted Successfully!');
        return redirect()->back();
    }


    function getRentalRequests(){
        $project_id = session()->get('projectID');

        $data1 = DB::table('rented_locations')
            ->join('locations', 'rented_locations.location_id', '=' , 'locations.id')
            ->where('locations.owner_id' , '=' , Auth::id() )
            ->join('projects', 'rented_locations.project_id', '=', 'projects.id')
            ->join('users', 'projects.manager_id', '=', 'users.id')
            ->get();



        $data = json_decode($data1,true);



        return view('vendors/locations/rentalRequests',['requests' => $data]);
    }



    function getLocationsDashboard(){

        $id = Auth::user()->id;


        $data1 = DB::table('rented_locations')
            ->join('locations', 'rented_locations.location_id', '=' , 'locations.id')
            ->where('locations.owner_id' , '=' , Auth::id() )
            ->count();


        $data2 = DB::table('locations')
            ->where('locations.owner_id' , '=' , Auth::id() )
            ->count();


        return view('vendors/locations/dashboard',['c1' => $data1 , 'c2' =>$data2]);

    }

}


