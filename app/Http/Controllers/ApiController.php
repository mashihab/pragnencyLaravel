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
   private function sendPushNotification($week,$fcm)
    {

        //   $tokens = array('token_1','token_2','token_3');
        /*    $tokens = array('eTP0tmo1Q7-PyL8xCOrNRE:APA91bEqljWxM870p6EZIYUO-EnSRW4cwEvY7Q0mEkQBiZ3m-BYQBKIaRaLM4Q_KSi-SDmvysQ109i_Z5X9cDvqRsJMRjTN3JPkOrXKuB5WJxcxuNr486zTNRz2RaHE8h_KY_B7OpRJ8', 'cfAgCtHXSdezJdXfHB02WQ:APA91bG8WtSkZiIM5i5kLMW0tXk0AStTXXgAQFosDPSxyZ4-gGse3SgjdxniiW7zWX9hiZsUg1c2zTFJqGdJSPcvCNXj-LD6ZyeUyQ5-pNxs8O84721TrLH2fO2ype2pEEwlVQvAckBe');*/


        $tokens = array($fcm);

        $info = DB::table('tips_and_trick')
            ->where("week",$week)
            ->get();

       // $title = "Title Here shihab";

        foreach ($info as $data) {
            print_r($data->name);
            $this->push_notification_android($tokens, $data->name, $data->details);
        }



    /*    if ($week== 2){
            $info = DB::table('tips_and_trick')
                ->selectRaw('name,week')
                ->where("week",$week)
                ->get();
            // print_r($info->week);
            $title = "Title Here shihab";
            $msg = "Week is 2";
        }else if ($week== 1){
            $info = DB::table('tips_and_trick')
                ->selectRaw('name,week')
                ->where("week",$week)
                ->get();
            // print_r($info->week);
            $title = "Title Here shihab";
            $msg = "Week is not 1";
        }else{
            $info = DB::table('tips_and_trick')
                ->selectRaw('name,week')
                ->where("week",$week)
                ->get();
            //print_r($info->week);
            $title = "Title Here shihab";
            $msg = "No Week";
        }*/

      // $this->push_notification_android($tokens, $title, $msg);

    }


  private function push_notification_android($tokens, $title, $msg)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $api_key = 'AAAA5EHSlsA:APA91bE7E-A-c9vrB841JbazYDeMBAUvXgNr6rrL983HY1Tb-o8KMAZ92FKPWw7nj53eKY0C-on1xI2_0SpLGmh6VvBRHde3e_pYDfRQ_KT3mk4YcV2Qb-m4Onh70I6AsL4-aVyhZvZ1';
        $messageArray = array();
        $messageArray["notification"] = array(
            'title' => $title,
            'message' => $msg,
        );
        $fields = array(
            /*  'to' => "/topics/shihab",  */   //if i want to send using topic then use this line
            'registration_ids' => $tokens,
            'data' => array(
                'title' => $title,
                'message' => $msg
            )
        );


        /*  $fields =array('to'=>$tokens,
              'notification'=>array('title'=>$title,'body'=>$msg));

          $payload =json_encode($fields);*/

        $headers = array(
            'Authorization: key=' . $api_key, //GOOGLE_API_KEY
            'Content-Type: application/json'
        );


        // dd(json_encode($fields));
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|JsonResponse
     */
    public function insertAuto(Request $request)
    {


            $user_pragnency = new UserPregnancy();
            $user_pragnency->name = "shihab";
            $user_pragnency->details = "dd";
            $user_pragnency->phone = "235345";
            $user_pragnency->save();




    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|JsonResponse
     */
    public function pragnencySignup(Request $request)
    {

        $name = $request->get('name');
        $details = $request->get('details');
        $phone = $request->get('phone');
        $period_date = $request->get('period_date');
        $token = $request->get('fcm_token');

        $mainuser = UserPregnancy::where('phone',$phone)->first();

        if ($mainuser) {

            $data = DB::table('user_pregnancy')
                ->selectRaw('id,name,details,phone,last_period_date,fcm_token')
                ->where('phone', $phone)
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

           /* return response()->json([
                "message" => "Member created"
            ], 200);*/

            $data = DB::table('user_pregnancy')
                ->selectRaw('id,name,details,phone,last_period_date,fcm_token')
                ->where('name', $name)
                ->get();


            return new JsonResponse($data);
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
    public function getBabySizeByWeek(Request $request)
    {

        /*
                if ($request->headers->get('Content-Type') == 'application/json' && $request->headers->get('X-API-SECRET') == '8821') {*/

        $data = DB::table('baby_size')
            ->selectRaw('id,name,length,length_unit,weight,weight_unit,week,url')
            ->where('week', $request->id)
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
    public function getAllUser(Request $request)
    {



        $users = DB::table('user_pregnancy')
            ->selectRaw('fcm_token,last_period_date')
            ->get();

        foreach ($users as $data) {

            $date2 = date_create("" . $data->last_period_date);
            $date1 = date_create(date('Y/m/d'));
            $diff = date_diff($date2, $date1);

            $days = $diff;

            $intday = (int) $days->format("%d");



            if ($intday % 7 == 0) {
              //  echo "data show".$intday. "<br>";
                $this->sendPushNotification($intday/7,"" . $data->fcm_token);
            } else {
             //   echo "no need to show".$intday. "<br>";
            }

        }



    }
}

