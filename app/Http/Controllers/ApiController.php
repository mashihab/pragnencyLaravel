<?php

namespace App\Http\Controllers;

use App\Models\Guids;
use App\Models\Members;
use App\Models\Nutrition;
use App\Models\UserPregnancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{

    public function pragnencySignup(Request $request)
    {


        $name= $request->get('name');
        $details= $request->get('details');
        $phone= $request->get('phone');
        $period_date= $request->get('period_date');
        $token= $request->get('fcm_token');

        $mainuser = UserPregnancy::where('name', $name)->first();

        if ($mainuser) {

            $data = DB::table('user_pregnancy')
                ->selectRaw('id,name,details,phone,last_period_date,fcm_token')
                ->where('name',$name)
                ->get();


            return new JsonResponse($data);
        } else {
            $user_pragnency = new UserPregnancy();
            $user_pragnency->name = $name;
            $user_pragnency->details = $details;
            $user_pragnency->phone = $phone;
            $user_pragnency->fcm_token = $token;
            $user_pragnency->last_period_date = $period_date;
            $user_pragnency->save();

            return response()->json([
                "message" => "Member created"
            ], 200);
        }


            //return new JsonResponse($users);


    }

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getGuideDetailsById(Request $request)
    {

/*
        if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {*/

            $data = DB::table('nutrition')
                ->selectRaw('id,name, details,url')
                ->where('guide_id', $request->id)
                ->get();

            return new JsonResponse($data);

      /*  } else {

            return new JsonResponse([
                'message' => 'Invalied Headers',
                'status' => 500
            ]);
        }*/

    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getGuideDetailsPost(Request $request)
    {

        $id = $request->get('id');

        $data = DB::table('nutrition')
            ->selectRaw('id,name, details,url')
            ->where('guide_id', $id)
            ->get();

        return new JsonResponse($data);



    }


    public function getGuide(Request $request)
    {

        if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {

            $users = DB::table('guide')
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

    /**
     * @param Request $request
     */
    public function sendPushNotification()
    {

        $tokens = array('token_1','token_2','token_3');
        $title = "Title Here";
        $msg = "Subtitle or description Here";
//Custom Parameters if any
        $customParam = array(
            'redirection_id' => '2',
            'redirection_type' => 'post_page' //'post_page','category_page','blog_page'
        );
        push_notification_android($tokens,$title,$msg,$customParam);
        function push_notification_android($tokens,$title,$msg,$customParam) {
            $url = 'https://fcm.googleapis.com/fcm/send';
            $api_key = 'fcm_server_api_key';
            $messageArray = array();
            $messageArray["notification"] = array (
                'title' => $title,
                'message' => $msg,
                'customParam' => $customParam,
            );
            $fields = array(
                'registration_ids' => $tokens,
                'data' => $messageArray,
            );
            $headers = array(
                'Authorization: key=' . $api_key, //GOOGLE_API_KEY
                'Content-Type: application/json'
            );
// Open connection
            $ch = curl_init();
// Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
// Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                echo 'Android: Curl failed: ' . curl_error($ch);
            }
// Close connection
            curl_close($ch);
            return $result;
        }


    }
}

