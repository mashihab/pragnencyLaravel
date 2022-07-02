<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::GET('/nutrition', [\App\Http\Controllers\ApiController::class,'getNutrition']);
Route::GET('/guide', [\App\Http\Controllers\ApiController::class,'getGuide']);
Route::GET('/sport', [\App\Http\Controllers\ApiController::class,'getSports']);
Route::GET('/appointment', [\App\Http\Controllers\ApiController::class,'getAppointment']);
Route::GET('/rest', [\App\Http\Controllers\ApiController::class,'getRest']);
Route::GET('/pragnancy_problem', [\App\Http\Controllers\ApiController::class,'getPragnancyProblem']);
Route::GET('/pregnancy_preparation', [\App\Http\Controllers\ApiController::class,'getPregnancyPreparation']);
Route::GET('/guide_detals/{id}', [\App\Http\Controllers\ApiController::class,'getGuideDetailsById']);
Route::POST('/guide_detals_post', [\App\Http\Controllers\ApiController::class,'getGuideDetailsPost']);
Route::POST('/pragnency_signup', [\App\Http\Controllers\ApiController::class,'pragnencySignup']);
Route::GET('/get_all_user', [\App\Http\Controllers\ApiController::class,'getAllUser']);
Route::GET('/insert_auto', [\App\Http\Controllers\ApiController::class,'insertAuto']);
/*Route::GET('/send_notification', [\App\Http\Controllers\ApiController::class,'sendPushNotification']);*/
