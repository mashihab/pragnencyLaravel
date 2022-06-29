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

        if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {

            $users = DB::table('nutrition')
                ->selectRaw('id,name, details,url')
                ->get();


            return new JsonResponse($users);

        } else {

            return new JsonResponse([
                'message' => 'Invalied Headers',
                'status' => 500
            ]);
        }


        //done


    }


    public function getGuide(Request $request)
    {

        if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {

            $users = DB::table('guide')
                ->selectRaw('id,name, details')
                ->get();


            return new JsonResponse($users);

        } else {

            return new JsonResponse([
                'message' => 'Invalied Headers',
                'status' => 500
            ]);
        }


    }

    public function getSports(Request $request)
    {

        if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {

            $users = DB::table('sports')
                ->selectRaw('id,name, details,url')
                ->get();


            return new JsonResponse($users);

        } else {

            return new JsonResponse([
                'message' => 'Invalied Headers',
                'status' => 500
            ]);
        }


    }
    public function getAppointment(Request $request)
    {

        if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {

            $users = DB::table('appointment')
                ->selectRaw('id,name, details,year,phone')
                ->get();


            return new JsonResponse($users);

        } else {

            return new JsonResponse([
                'message' => 'Invalied Headers',
                'status' => 500
            ]);
        }


    }
    public function getRest(Request $request)
    {

        if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {

            $users = DB::table('rest')
                ->selectRaw('id,name, details,url')
                ->get();


            return new JsonResponse($users);

        } else {

            return new JsonResponse([
                'message' => 'Invalied Headers',
                'status' => 500
            ]);
        }


    }
    public function getPragnancyProblem(Request $request)
    {

        if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {

            $users = DB::table('pragnancy_problem')
                ->selectRaw('id,name, details,url')
                ->get();


            return new JsonResponse($users);

        } else {

            return new JsonResponse([
                'message' => 'Invalied Headers',
                'status' => 500
            ]);
        }


    }
    public function getPregnancyPreparation(Request $request)
    {

        if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {

            $users = DB::table('pregnancy_preparation')
                ->selectRaw('id,name, details,url')
                ->get();


            return new JsonResponse($users);

        } else {

            return new JsonResponse([
                'message' => 'Invalied Headers',
                'status' => 500
            ]);
        }


    }
}

