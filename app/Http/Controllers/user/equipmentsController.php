<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\equipment;
use App\Models\equipmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class equipmentsController extends Controller
{
    function getEquipments(){
        $data = equipment::select("*")->where('owner_id','=',Auth::id())->paginate(5);
        return view('vendors/equipments/list',['equipments' =>$data]);
    }

    function addEquipments(Request $req){



        $req->validate([
            'file'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"
        ]);



        $uniqueFileName = uniqid() . $req->file('file')->getClientOriginalName() . '.' . $req->file('file')->getClientOriginalExtension();
        $req->file('file')->storeAs('public/equipments/',$uniqueFileName);


        $request_id = equipmentRequest::select('id')->where('user_id','=', Auth::id())->first();;



        if($file = $req->file('file')){

            $equipment = new equipment();
            $equipment->owner_id = Auth::id();
            $equipment->name = $req->name;
            $equipment->description = $req->desc;
            $equipment->price = $req->price;
            $equipment->image= $uniqueFileName;
            $equipment->request_id= $request_id->id;
            $equipment->save();

            return redirect()->back()->with('Eqmessage', 'The equipment has been added');


        }
        return redirect()->back();
    }

    function deleteEquipments($id){
        $data= equipment::find($id);
        $data->delete();
        Session::flash('message', 'Equipment Deleted Successfully!');
        return redirect()->back();
    }


    function getRentalRequests(){

        $project_id = session()->get('projectID');

        $data1 = DB::table('rented_equipments')
            ->join('equipments', 'rented_equipments.equipment_id', '=' , 'equipments.id')
            ->where('equipments.owner_id' , '=' , Auth::id() )
            ->join('projects', 'rented_equipments.project_id', '=', 'projects.id')
            ->join('users', 'projects.manager_id', '=', 'users.id')
            ->get();


      $data = json_decode($data1,true);



        return view('vendors/equipments/rentalRequests',['requests' => $data]);
    }





    function getEquipmentsDashboard(){

        $id = Auth::user()->id;


        $data1 = DB::table('rented_equipments')
            ->join('equipments', 'rented_equipments.equipment_id', '=' , 'equipments.id')
            ->where('equipments.owner_id' , '=' , Auth::id() )
            ->count();


        $data2 = DB::table('equipments')
            ->where('equipments.owner_id' , '=' , Auth::id() )
            ->count();


        return view('vendors/equipments/dashboard',['c1' => $data1 , 'c2' =>$data2]);




    }

}
