<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\requests;
use App\Models\rented_locations;
use App\Models\talent;
use App\Models\talents_hire_requests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\project;
use App\Models\location;
use App\Models\equipment;
use App\Models\talentReviews;
use App\Models\rented_equipments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class projectManagement extends Controller
{

           function saveInfo(Request $req)
           {


               if ($req->start_date < date("Y-m-d")){
                   return redirect()->back()->with('error2'," You can't start a project from the past");
               }
               else if ($req->start_date > $req->end_date){
                   return redirect()->back()->with('error1','The end date must be after the start date');
               }

               $project = new project();
               $project->manager_id = Auth::id();
               $project->title = $req->title;
               $project->description = $req->desc;
               $project->start_date = $req->start_date;
               $project->end_date = $req->end_date;
               $project->save();

               Session::flash('message', 'You have create a project');
               return redirect('projectManagement');
           }


           function projectsPage(){

               $data = project::where('manager_id',Auth::id())->get();
               return view('main/projectManagement',['projects' =>$data]);

           }

           function getProjectDashboard($id){

               $data = project::where('id',$id)->get();

               session(['projectID' => $id]);

                return view('projectManagement/dashboard',['data'=>$data]);

           }


            function getLocations(){

               $data = location::all();
                return view('projectManagement/locations',['locations'=>$data]);

            }


               function getEquipments(){
                   $data = equipment::all();
                   return view('ProjectManagement/equipments',['equipments'=>$data]);

               }

               function equipmentDetails($id){
                           $data = equipment::where('id',$id)->get();
                           return view('projectManagement/rentEquipment',['data'=>$data]);
                       }

                       function goToPayment(Request $req){

                      if ($req->start_date < date("Y-m-d")){
                           return redirect()->back()->with('error2'," You can't start the rental from the past");
                       }
                      else if ($req->start_date > $req->end_date){
                            return redirect()->back()->with('error1','The Drop-Off date must be after the Pick-Up date');
                        }
                       else{

                           //check the equipment is rented or not

                           $eq = rented_equipments::where('equipment_id', $req->equipment_id)->get();


                           foreach ($eq as $e){
                               if (($req->start_date >= $e->start_date) && ($req->start_date <= $e->end_date)){
                                 //start date is between
                                   return redirect()->back()->with('rented1', 'The equipment is rented in the selected dates');
                               }
                               else if(($req->end_date >= $e->start_date) && ($req->end_date <= $e->end_date)){
                                   //end date is between
                                   return redirect()->back()->with('rented1', 'The equipment is rented in the selected dates');
                               }

                           }
                       }
                           $start = strtotime($req->start_date);
                           $end = strtotime($req->end_date);

                           $days_between = (ceil(abs($end - $start) / 86400))+1;


                           $total = $days_between * $req->price;
                           return view('ProjectManagement/equipmentsPayment',['equipment_id'=>$req->equipment_id , 'total'=>$total , 'days'=>$days_between ,'start'=>$req->start_date , 'end'=>$req->end_date] );
               }


        function MakeRental(Request $req){


            $rental = new rented_equipments();
            $rental->equipment_id = $req->equipment_id;
            $rental->project_id = $req->project_id;
            $rental->price = $req->price;
            $rental->start_date = $req->start;
            $rental->end_date = $req->end;
            $rental->save();

            return redirect()->route('projectEquipments', ['id' => session()->get('projectID')])->with('message' ,'You have rent equipments to your project');

        }


        function getProjectEquipments(){

               $project_id = session()->get('projectID');


            $data1 = DB::table('rented_equipments')
                ->join('equipments', 'rented_equipments.equipment_id', '=' , 'equipments.id')
                ->where('rented_equipments.project_id' , '=' , $project_id )
                ->join('equipments_requests', 'equipments.request_id', '=', 'equipments_requests.id')
                ->get();

            $data = json_decode($data1,true);


               return view('projectManagement/projectEquipments',['equipments' => $data]);
        }






        function locationDetails($id){
            $data = location::where('id',$id)->get();
            return view('projectManagement/rentLocation',['data'=>$data]);
        }

        function goTolocationPayment(Request $req){

            if ($req->start_date < date("Y-m-d")){
                return redirect()->back()->with('error2'," You can't start the rental from the past");
            }
            else if ($req->start_date > $req->end_date){
                return redirect()->back()->with('error1','The end date must be after the start date');
            }
            else{

                //check the equipment is rented or not

                $eq = rented_locations::where('location_id', $req->location_id)->get();


                foreach ($eq as $e){
                    if (($req->start_date >= $e->start_date) && ($req->start_date <= $e->end_date)){
                        //start date is between
                        return redirect()->back()->with('rented1', 'The Location is rented in the selected dates');
                    }
                    else if(($req->end_date >= $e->start_date) && ($req->end_date <= $e->end_date)){
                        //end date is between
                        return redirect()->back()->with('rented1', 'The Location is rented in the selected dates');
                    }
                }
            }
            $start = strtotime($req->start_date);
            $end = strtotime($req->end_date);

            $days_between = (ceil(abs($end - $start) / 86400))+1;


            $total = $days_between * $req->price;
            return view('ProjectManagement/locationsPayment',['location_id'=>$req->location_id , 'total'=>$total , 'days'=>$days_between ,'start'=>$req->start_date , 'end'=>$req->end_date] );

        }


        function makeLocationRental(Request $req){
            $rental = new rented_locations();
            $rental->location_id = $req->location_id;
            $rental->project_id = $req->project_id;
            $rental->price = $req->price;
            $rental->start_date = $req->start;
            $rental->end_date = $req->end;
            $rental->save();

            return redirect()->route('projectLocations', ['id' => session()->get('projectID')])->with('message' ,'You have rent Location to your project');
        }

        function getProjectLocations(){
            $project_id = session()->get('projectID');


            $data1 = DB::table('rented_locations')
                ->join('locations', 'rented_locations.location_id', '=' , 'locations.id')
                ->where('rented_locations.project_id' , '=' , $project_id )
                ->get();


            $data = json_decode($data1,true);


            return view('projectManagement/projectLocations',['locations' => $data]);
        }



        function getTalents(){


               $ali ="";

            // start

            function python($arg){


                $arg =trim($arg);

                $process = new Process(['python','../test/hello.py',$arg],
                    null,
                    ['SYSTEMROOT' => getenv('SYSTEMROOT'), 'PATH' => getenv("PATH")]);
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                $output_data = $process->getOutput();

                return $output_data;


            }





            // end

            $project_id =session()->get('projectID');
            $data1 = project::where('id',$project_id)->first();
            $project_description = $data1->description;
           $keys =  python($project_description);
            $keys = str_replace(' ', '', $keys);
            $keys = str_replace('\'', '', $keys);

            $keys = str_replace(array("\r", "\n"), '', $keys);
            $keys=   substr($keys, 1, -1);
            $keys=  explode(',', $keys);



           //$keyWords = generateKeywordsFromText($project_description);
           $filteredTalents =array();



           foreach ($keys as $key){
               $filteredTalent  = DB::table('talents')
                   ->join('users', 'talents.user_id', '=' , 'users.id')
                   ->where('fields', 'LIKE', '%'.$key.'%')
                   ->get();

                $count =count($filteredTalent);

                if($count >0){
                    $filteredTalents = $filteredTalent;
                }

            }

            //end recommendation


            $data = DB::table('talents')
                ->join('users', 'talents.user_id', '=' , 'users.id')
                ->get();


            $data = json_decode($data,true);
            if(!empty($filteredTalents)){
                $filteredTalents = json_decode($filteredTalents,true);
            }
           // dd($filteredTalents);




            return view('projectManagement/Crew/crew',['talents'=>$data , 'recommends'=>$filteredTalents]);
        }


        function talentDetailsPage($id){


            $data = DB::table('talents')
                ->join('users', 'talents.user_id', '=' , 'users.id')
                ->where('talents.user_id' , $id)
                ->select('talents.picture','users.name','talents.profession','talents.gender', 'users.email','talents.phone', 'talents.experience','talents.daily_Rate','talents.languages','talents.cv', 'talents.id','talents.user_id')
                ->get();
            $data = json_decode($data,true);

            $fields= talent::where('talents.user_id' , $id)->get('fields');
            $fields1 = json_decode($fields,true);

            foreach ($fields1 as $f){
                foreach ($f as $s)
                    $fields = json_decode($s,true);
            }


            $data2 = DB::table('talent_reviews')
                ->join('users', 'talent_reviews.user_id', '=' , 'users.id')
                ->where('talent_reviews.talent_id' , $id)
                ->select('talent_reviews.comment','talent_reviews.created_at','users.name','talent_reviews.created_at')
                ->get();



            $data2 = json_decode($data2,true);

            $avg_stars = DB::table('talent_reviews')
                ->where('talent_reviews.talent_id' , $id)
                ->avg('rating');


            $avg_stars=  floor($avg_stars);




               return view('ProjectManagement/Crew/talentDetails',['talents'=>$data , 'comments'=>$data2, 'rating'=>$avg_stars , 'fields'=>$fields]);
        }


        function sendHireRequest(Request $req){

            $project_id = session()->get('projectID');




            $pro = project::where('id', $project_id)->get();

            $project_startDate = $pro[0]->start_date;
            $project_endDate = $pro[0]->end_date;




           // dd($project_endDate);


            if($req->start_date>= $project_startDate &&  $req->end_date<=$project_endDate)
            {
                if ($req->start_date < date("Y-m-d")){
                    return redirect()->back()->with('error2'," You can't hire from the past");
                }
                else if ($req->start_date > $req->end_date){
                    return redirect()->back()->with('error1','The end date must be after the start date');
                }
                else{

                    //check the talent is hired or not

                    $requests = talents_hire_requests::where('talent_id',$req->talent_id)
                        ->where('status','=','accepted')->get();


                    foreach ( $requests as $e){
                        if (($req->start_date >= $e->start_date) && ($req->start_date <= $e->end_date)){
                            //start date is between
                            return redirect()->back()->with('hired1', 'The talent is busy in the selected dates');
                        }
                        else if(($req->end_date >= $e->start_date) && ($req->end_date <= $e->end_date)){
                            //end date is between
                            return redirect()->back()->with('hired2', 'The talent is busy in the selected dates');
                        }
                    }
                }
            }
            else{
                return redirect()->back()->with('error3'," You can only hire withen the project period");
            }








            $data= project::where('id', $req-> session()->get('projectID'))->first();

            $start = strtotime($req->start_date);
            $end = strtotime($req->end_date);

            $days_between = (ceil(abs($end - $start) / 86400))+1;


            $total = $days_between * $req->price;

            $request = new talents_hire_requests();
            $request->project_id = session()->get('projectID');
            $request->project_title = $data->title;
            $request->project_desc = $data->description;
            $request->start_date = $req->start_date;
            $request->end_date = $req->end_date;
            $request->total_price = $total;
            $request->status = 'pending';
            $request->talent_id = $req->talent_id;
            $request->paid = 'no';
            $request->save();


            return redirect()->route('crewRequests')->with('message', 'A hire request has been sent to the talent');
        //    return view('ProjectManagement/Crew/crewRequests')->with('message', 'A hire request has been sent to the talent');

        }

        function getCrewRequests(){



            $data = DB::table('talents_hire_requests')
                ->join('talents', 'talents.id', '=' , 'talents_hire_requests.talent_id')
                ->where('project_id', session()->get('projectID'))
                ->where(function($query) {
                    $query ->where('status','pending' )
                        ->orWhere('status','rejected' );
                })
                ->join('users', 'talents.user_id', '=' , 'users.id')
                ->get();

            $data = json_decode($data,true);
             //  $data = talents_hire_requests::where('project_id', session()->get('projectID'))->get();
               return view('ProjectManagement/Crew/crewRequests',['requests' => $data]);
        }


    function getCrewAcceptedRequests(){



        $data = DB::table('talents_hire_requests')
            ->join('talents', 'talents.id', '=' , 'talents_hire_requests.talent_id')
            ->where('project_id', session()->get('projectID'))
            ->where('status', 'accepted')
            ->join('users', 'talents.user_id', '=' , 'users.id')
            ->select('users.name','talents.profession','talents_hire_requests.start_date','talents_hire_requests.end_date','talents_hire_requests.total_price','talents.phone','talents_hire_requests.id','talents.picture','talents_hire_requests.paid')
            ->get();

        $data = json_decode($data,true);
        return view('ProjectManagement/Crew/projectCrew',['requests' => $data]);
    }


    function goToTalentsPayment(Request $req){

               $id = $req->hire_request_id;

               $data = talents_hire_requests::where('id',$id)->get();

               return view('ProjectManagement/Crew/payment',['data'=>$data]);

    }

    function confirmTalentPayment(Request $req){


        talents_hire_requests::where('id' ,$req->hire_id)
            ->update(['paid' => 'yes']);

        return redirect()->route('crewAcceptedRequests')->with('message2', 'You have paid for a talent successfully');
    }


    function closeProject(){

               $project_id =  session()->get('projectID');


               $talents = talents_hire_requests::where('project_id',$project_id)->get();

               foreach ($talents as $talent){
                   if ($talent->status == 'accepted' && $talent->paid  == 'no'){
                       return redirect()->back()->with('message','You have to pay to all your crew before closing the project');
                   }
               }

        $data=talents_hire_requests::where('project_id',$project_id)->delete();
        $data1=rented_locations::where('project_id',$project_id)->delete();
        $data2=rented_equipments::where('project_id',$project_id)->delete();
        $data3=project::where('id',$project_id)->delete();


        return redirect()->route('projectsList')->with('message1', 'You have close a project');

    }


    function talentRating(request $req)
    {

        if($req->rating == null){
            return redirect()->back()->with('message','You must give a rate');
        }

        else {

                $result = talentReviews::where([
                    ['talent_id' ,$req->talent_id],
                    ['user_id' ,Auth::id()],
                ])->get();

                $count = count($result);

                if($count == 0){
                    $review = new talentReviews();
                    $review->talent_id =$req->talent_id;
                    $review->user_id = Auth::id();
                    $review->rating = (int)$req->rating + 1;
                    $review->comment = $req->comment;
                    $review->save();
                    return redirect()->back()->with('message2','Thank you for your review');
                }
                else{
                    return redirect()->back()->with('message3','You have give your review already');
                }



        }

    }

}
