<?php

namespace App\Http\Controllers;

use App\Models\Guids;
use App\Models\Members;
use App\Models\Nutrition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    public function getNutrition(Request $request)
    {



      //  $users = Nutrition::all();

    /*      if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821'){*/

              $users = DB::table('nutrition')
                  ->selectRaw('id,name, details,url')
                  ->get();


              return new JsonResponse($users);

          /* }else{

               return new JsonResponse([
                   'message' => 'Invalied Headers',
                   'status' => 500
               ]);
           }*/


        //done


    }
}
