<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\requests;
use App\Models\hired_talents;
use Illuminate\Http\Request;
use App\Models\talent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\talents_hire_requests;


class talentsController extends Controller
{



    function talentPage(){
        $user_id = Auth::id();

        $data = talent::where('user_id',$user_id);
        $data1 = User::join('talents', 'users.id' ,'=', 'talents.user_id')->where('talents.user_id',$user_id)->get();
       // $data1 = talent::where('user_id',$user_id)->join('users', 'talents.user_id', '=', 'users.id')->get();

        $fields= talent::where('talents.user_id' , $user_id)->get('fields');
        $fields1 = json_decode($fields,true);

        foreach ($fields1 as $f){
            foreach ($f as $s)
                $fields = json_decode($s,true);
        }

        $avg_stars = DB::table('talent_reviews')
            ->where('talent_reviews.talent_id' , $user_id)
            ->avg('rating');


        $avg_stars=  floor($avg_stars);

        $count = $data->count();

        if($count == 0){
            return view('main/talentsForm');
        }
        else{
            return view('talents/dashboard',['talents'=>$data1 ,'fields'=>$fields, 'rating'=>$avg_stars]);
        }
    }


    function saveInfo(Request $req){


        $req->validate([
            'fields' => 'required|min:1',
            'pPicture'=>"required|file|image|mimes:jpg,png,jpeg|max:5000",
            "talentsCv" => "required|mimes:pdf|max:10000"
        ]);




        $uniqueFileName = uniqid() . $req->file('pPicture')->getClientOriginalName() . '.' . $req->file('pPicture')->getClientOriginalExtension();
        $req->file('pPicture')->storeAs('public/talentsPictures/',$uniqueFileName);

        $uniqueFileName2 = uniqid() . $req->file('talentsCv')->getClientOriginalName() . '.' . $req->file('talentsCv')->getClientOriginalExtension();
        $req->file('talentsCv')->storeAs('public/talentsCV/',$uniqueFileName2);

        $talent = new talent();
        $talent->user_id = Auth::id();
        $talent->phone = $req->phone;
        $talent->gender = $req->radio == 'Male' ? 'Male':'Female';
        $talent->daily_Rate = $req->rate;
        $talent->picture= $uniqueFileName;
        $talent->cv= $uniqueFileName2;
        $talent->fields = json_encode($req->fields);
        $talent->profession = $req->input('profession');
        $talent->languages = $req->input('languages');
        $talent->experience = $req->input('experience');

        $talent->save();

        return redirect()->action([talentsController::class,'talentPage'])->with('message', 'Thank you for joining us, you can start managing your talent account now  ');

    }


//to pass the data to the form
    function updateForm(){
        $user_id = Auth::id();

           // $data= talent::find($id);
           // dd($data);
        $data = talent::where('user_id' ,'=' , $user_id)->first();

            return view('talents/updateTalentProfile' , ['data' => $data]);

    }


    function updateTalent(Request $req){

        $req->validate([
            'fields' => 'required|min:1',
             'pPicture'=>"required|file|image|mimes:jpg,png,jpeg|max:5000",
            "talentsCv" => "required|mimes:pdf|max:10000"
        ]);

        $user_id = Auth::id();
            $talent= talent::where('user_id' ,'=' , $user_id)->first();


        $uniqueFileName = uniqid() . $req->file('pPicture')->getClientOriginalName() . '.' . $req->file('pPicture')->getClientOriginalExtension();
        $req->file('pPicture')->storeAs('public/talentsPictures/',$uniqueFileName);

        $uniqueFileName2 = uniqid() . $req->file('talentsCv')->getClientOriginalName() . '.' . $req->file('talentsCv')->getClientOriginalExtension();
        $req->file('talentsCv')->storeAs('public/talentsCV/',$uniqueFileName2);

        $talent->phone = $req->phone;
        $talent->profession = $req->input('profession');
        $talent->gender = $req->radio == 'Male' ? 'Male':'Female';
        $talent->daily_Rate = $req->rate;
        $talent->picture= $uniqueFileName;
        $talent->cv= $uniqueFileName2;
        $talent->fields = json_encode($req->fields);
        $talent->languages = $req->input('languages');
        $talent->experience = $req->input('experience');
        $talent->save();

        return redirect()->action([talentsController::class,'talentPage'])->with('message2', 'Your profile has been updated ');
    }

    function getPendingRequests(){


        $data = DB::table('talents_hire_requests')
            ->join('talents', 'talents.id', '=' , 'talents_hire_requests.talent_id')
            ->where('talents.user_id', Auth::id())
            ->join('projects', 'talents_hire_requests.project_id', '=' , 'projects.id')
            ->join('users', 'users.id', '=' , 'projects.manager_id')
            ->select('talents_hire_requests.id','talents_hire_requests.project_id','talents_hire_requests.project_title','talents_hire_requests.project_desc','talents_hire_requests.start_date','talents_hire_requests.end_date','talents_hire_requests.total_price','users.email')
            ->where('talents_hire_requests.status' ,'pending')
            ->get();



        $data = json_decode($data,true);



        return view('talents/pendingRequests',['requests'=>$data]);
    }


    function getAcceptedRequests(){
        $data = DB::table('talents_hire_requests')
            ->join('talents', 'talents.id', '=' , 'talents_hire_requests.talent_id')
            ->where('talents.user_id', Auth::id())
            ->join('projects', 'talents_hire_requests.project_id', '=' , 'projects.id')
            ->join('users', 'users.id', '=' , 'projects.manager_id')
            ->select('talents_hire_requests.project_id','talents_hire_requests.project_title','talents_hire_requests.project_desc','talents_hire_requests.start_date','talents_hire_requests.end_date','talents_hire_requests.total_price','users.email')
            ->where('talents_hire_requests.status' ,'accepted')
            ->get();

        $data = json_decode($data,true);



        return view('talents/acceptedRequests',['requests'=>$data]);
    }


    function talentRejectRequest(Request $req){


        $project_id = $req->project_id;
        $id = $req->id;





        $data = talent::where('user_id',Auth::id())->select('id')->first();

        talents_hire_requests::where('project_id', $project_id)
            ->where('talent_id', $data->id)
            ->where('id', $id)
            ->update(['status' => 'rejected']);

        return redirect()->back()->with('message','You have reject a project');

    }




    function talentAcceptRequest(Request $req){

        $project_id = $req->project_id;
        $id = $req->id;

        $talent_id = talent::where('user_id',Auth::id())->select('id')->first();

         talents_hire_requests::where('talent_id' ,$talent_id->id)
            ->where('project_id',$project_id)
             ->where('id', $id)
            ->where('status','pending')
             ->update(['status' => 'accepted']);

        return redirect()->route('acceptedRequests')->with('message', 'You have accept a hiring request.');

    }




}
