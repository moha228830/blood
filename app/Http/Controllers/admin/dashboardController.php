<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\donationReq;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records =  DB::table("donation_reqs")->select(

            DB::raw("COUNT(*) as count "),
            DB::raw("YEAR(created_at) as year "),
            DB::raw("MONTH(created_at) as month ")

            )->groupBy("month")->get();


            $records_client =  DB::table("clients")->select(

                DB::raw("COUNT(*) as count "),
                DB::raw("YEAR(created_at) as year "),
                DB::raw("MONTH(created_at) as month ")

                )->groupBy("month")->get();


           $blood_req =  DB::table("donation_reqs") ->leftJoin('blood_types', 'blood_types.id', '=', 'donation_reqs.blood_type_id')->select(

                DB::raw("COUNT(*) as count "),
                DB::raw("blood_type_id as blood"),
                DB::raw("blood_type as name"),

                )->groupBy("blood")->get();
               // dd($blood_req);

                $blood_client =  DB::table("clients") ->leftJoin('blood_types', 'blood_types.id', '=', 'clients.blood_type_id')->select(

                    DB::raw("COUNT(*) as count "),
                    DB::raw("blood_type_id as blood"),
                    DB::raw("blood_type as name"),



                    )->groupBy("blood")->get();



                $govern_client =  DB::table("clients") ->
                leftJoin('cities', 'cities.id', '=', 'clients.city_id')->
                leftJoin('governs', 'governs.id', '=', 'cities.govern_id')->select(

                    DB::raw("COUNT(*) as count "),
                    DB::raw("governs.name as govern"),




                    )->groupBy("govern")->get();


                    $govern_req =  DB::table("donation_reqs") ->
                    leftJoin('cities', 'cities.id', '=', 'donation_reqs.city_id')->
                    leftJoin('governs', 'governs.id', '=', 'cities.govern_id')->select(

                        DB::raw("COUNT(*) as count "),
                        DB::raw("governs.name as govern"),




                        )->groupBy("govern")->get();

           // dd($governs_req);
           //return get_response(1, 'تم    ', $records);
      // flash('Welcome Aboard!');

      // Alert::success('Success Title', 'Success Message');
      $data=["records"=>  $records  ,
               "records_client"=>  $records_client  ,
             "blood_req"=>  $blood_req ,
             "blood_client"=>  $blood_client ,
             "govern_req"=>  $govern_req ,
             "govern_client"=>  $govern_client ,

           ];

        return view("dashboard.welcome", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

}
