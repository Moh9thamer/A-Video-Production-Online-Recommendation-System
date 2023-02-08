<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\facades\Auth;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\requestsController;
use App\Http\Controllers\requests;
use App\Http\Controllers\user\locationsController;
use App\Http\Controllers\user\equipmentsController;
use App\Http\Controllers\user\talentsController;
use App\Http\Controllers\user\projectManagement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// user should be logged in to visit those pages
Route::group(['middleware'=>['loginPages']],function(){



    //admin
    Route::group(['middleware'=>['adminPages']],function() {
        Route::get('usersList', [UsersController::class, 'getAdmins']);
        Route::post('addUser', [UsersController::class, 'add']);
        Route::get('deleteUser/{id}', [UsersController::class, 'delete']);
        Route::view('equipmentsList', 'admin/equipments/list');
       //Route::view('locationsList', 'admin/Locations/list');



        //locations
        Route::get('AcceptedLocationRequests',[requestsController::class,'getAcceptedLocationRequests']);
        Route::get('locationsRequests',[requestsController::class,'getLocationRequests']);
        Route::get('acceptLocRequest/{id}',[requestsController::class,'acceptLocRequest']);
        Route::get('deleteLocRequest/{id}',[requestsController::class,'deleteLocRequest']);

        //equipments
        Route::get('AcceptedEquipmentsRequests',[requestsController::class,'getAcceptedEquipmentsRequests']);
        Route::get('equipmentsRequests',[requestsController::class,'getEquipmentRequests']);
          Route::get('acceptEqRequest/{id}',[requestsController::class,'acceptEqRequest']);
        Route::get('deleteEqRequest/{id}',[requestsController::class,'deleteEqRequest']);


        //talents

        Route::get('talentsList',[requestsController::class,'getTalentsList']);
        Route::get('deleteTalent/{id}',[requestsController::class,'deleteTalent']);


    });


    //user
    Route::post('saveLocationRequest',[requests::class,'saveLocationRequest']);
    Route::post('saveEquipmentRequest',[requests::class,'saveEquipmentRequest']);
    Route::get('vendorSelection',[requests::class,'vendorsPage']);
    Route::view('locationRequest','main/locationRequest');
    Route::view('equipmentRequest','main/equipmentRequest');


    //talent
    Route::get('talentPage',[talentsController::class,'talentPage']);
    Route::post('saveTalentInfo',[talentsController::class,'saveInfo']);
    Route::get('updateTalentForm',[talentsController::class,'updateForm']);
    Route::post('updateTalent',[talentsController::class,'updateTalent']);
    Route::get('pendingRequests',[talentsController::class,'getPendingRequests']);
    Route::get('talentReject/{project_id}/{id}',[talentsController::class,'talentRejectRequest'])->name('talentReject');
    Route::get('talentAccept/{project_id}/{id}',[talentsController::class,'talentAcceptRequest'])->name('talentAccept');;
   // Route::get('talentAccept/{id}',[talentsController::class,'talentAcceptRequest']);
    Route::get('acceptedRequests',[talentsController::class,'getAcceptedRequests'])->name('acceptedRequests');


    //---------------------
//locations admin
    //Route::view('locationsDashboard','vendors/locations/dashboard');
    Route::get('locationsDashboard',[locationsController::class,'getLocationsDashboard']);
    Route::get('locationsList',[locationsController::class,'getLocations']);
    Route::post('addLocation',[locationsController::class,'addLocation']);
    Route::get('deleteLocation/{id}',[locationsController::class,'deleteLocation']);
    Route::get('rentalLocationsRequests',[locationsController::class,'getRentalRequests']);

    // equipments admin
    //Route::view('equipmentsDashboard','vendors/equipments/dashboard');
    Route::get('equipmentsDashboard',[equipmentsController::class,'getEquipmentsDashboard']);
    Route::get('equipmentsList',[equipmentsController::class,'getEquipments']);
    Route::post('addEquipments',[equipmentsController::class,'addEquipments']);
    Route::get('deleteEquipments/{id}',[equipmentsController::class,'deleteEquipments']);
    Route::get('rentalRequests',[equipmentsController::class,'getRentalRequests']);

    //Project Management ---------------------------------------------------------------------------------


    Route::get('projectManagement',[projectManagement::class,'projectsPage'])->name('projectsList');
    Route::get('projectDashboard/{id}',[projectManagement::class,'getProjectDashboard'])->name('projectDashboard');
    Route::view('projectForm','main/formProject');
    Route::post('saveProjectInfo',[projectManagement::class,'saveInfo']);
    Route::get('closeProject',[projectManagement::class,'closeProject']);


    Route::get('projectEquipments',[projectManagement::class,'getEquipments']);// Equipments List (to rent)
    Route::get('equipmentDetails/{id}',[projectManagement::class,'equipmentDetails']);
    Route::post('equipmentsPayment',[projectManagement::class,'goToPayment']);
    Route::post('MakeRental',[projectManagement::class,'MakeRental']);
    Route::get('projectEquipments/{id}',[projectManagement::class,'getProjectEquipments'])->name('projectEquipments');



    Route::get('projectLocations',[projectManagement::class,'getLocations']); // Locations List (to rent)
    Route::get('locationDetails/{id}',[projectManagement::class,'locationDetails']);
    Route::post('locationPayment',[projectManagement::class,'goToLocationPayment']);
    Route::post('makeLocationRental',[projectManagement::class,'makeLocationRental']);
    Route::get('projectLocations/{id}',[projectManagement::class,'getProjectLocations'])->name('projectLocations');


    Route::get('crewPage',[projectManagement::class,'getTalents']);
    Route::get('talentDetails/{id}',[projectManagement::class,'talentDetailsPage']);
    Route::post('sendHireRequest',[projectManagement::class,'sendHireRequest']);
    Route::get('crewRequests',[projectManagement::class,'getCrewRequests'])->name('crewRequests');
    Route::get('crewAcceptedRequests',[projectManagement::class,'getCrewAcceptedRequests'])->name('crewAcceptedRequests');
    Route::post('talentsPayment',[projectManagement::class,'goToTalentsPayment']);
    Route::post('confirmTalentPayment',[projectManagement::class,'confirmTalentPayment']);
    Route::post('talentRating',[projectManagement::class,'talentRating']);










});

// Main
Route::get('/', function () {

   if(Auth::check()){
       if (Auth::user()->role == '1'){
           return view('admin/dashboard');
       }
   }

    return view('main/dashboard');
});










Route::view('/Policy','main/policy');

Route::view('/Terms','main/terms');
//----------------------------------------------------------------------------------








//----------------------------------------------------------------------------------




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (Auth::user()->role == '1'){
        return view('admin/dashboard');
    }
    else{
        return view('main/dashboard');
    }
})->name('dashboard');



Route::get('redirects','App\Http\Controllers\HomeController@index')->name('redirects');;
