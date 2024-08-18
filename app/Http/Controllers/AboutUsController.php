<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{


    public function index(Request $request)
    {

        $language = $request->header('Lang');
        $defaultLanguage = 'en';



        if ($language) {
            $locale = substr($language, 0, 2);
        } else {
            $locale = $defaultLanguage;
        }

        $aboutus = AboutUs::all();
        //$aboutus = AboutUs::select() //
        //   ->get();

        try {
            if ($aboutus->count() > 0) {
                $processedServices = $aboutus->map(function ($aboutus) use ($locale, $defaultLanguage) {
                    $jsonData = json_decode($aboutus->for_who, true);
                    $jsonData2 = json_decode($aboutus->steps_process, true);

                    if (isset($jsonData[$locale])) {
                        if ($aboutus->for_who != null) {
                            $aboutus->for_who = $jsonData[$locale];
                        }
                        if ($aboutus->steps_process != null) {
                            $aboutus->steps_process = $jsonData2[$locale];
                        }
                        //return $aboutus->makeHidden('for_who');
                    } else {
                        $aboutus->for_who = $jsonData[$defaultLanguage] ?? 'Language not supported';
                        $aboutus->steps_process = $jsonData2[$defaultLanguage] ?? 'Language not supported';
                    }

                    return $aboutus;
                });

                return response()->json([
                    'success' => 1,
                    'result' => $processedServices,
                    'message' => __('app.data_returnd_sucssesfully')
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('app.there_is_no_data')
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'introduction' => 'required',
            'our_mission' => 'required',
            /*'*.for_who.en' => 'required',
            '*.for_who.nl' => 'required',*/
            'for_who' => 'required',
            /*  "*.steps_process.en" => 'required',
            "*.steps_process.nl" => 'required',
            "meet_our_team" => 'required|string',
            "our_partners_&_associates" => 'required',
            "client_testimonials" => 'required',*/
        ]);
        if ($validation->fails()) {

            return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validation->errors(),
            ], 200);
        }
        try {
            $service = AboutUs::create([
                'company_name' => $request->company_name,
                'introduction' => $request->introduction,
                'our_mission' => $request->our_mission,
                "for_who" => $request->for_who,

            ]);
            return response()->json([
                'sucsess' => 1,
                'result' => $service,
                'message' => "",
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }


    public function show($id, Request $request)
    {
        $language = $request->header('Lang');
        $defaultLanguage = 'en';

        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        try {
            $aboutus = AboutUs::findOrFail($id);

            if (!$aboutus) {
                return response()->json([
                    'sucsess' => 1,
                    'result' => null,
                    'message' => __('app.there_is_no_data'),
                ], 200);
            }

            $jsonDataB = json_decode($aboutus->for_who, true);
            $jsonDataC = json_decode($aboutus->steps_process, true);

            $translatedTextB = $jsonDataB[$locale] ?? $jsonDataB[$defaultLanguage] ?? 'Language not supported';
            $translatedTextC = $jsonDataC[$locale] ?? $jsonDataC[$defaultLanguage] ?? 'Language not supported';

            $aboutus->for_who = $translatedTextB;
            $aboutus->steps_process = $translatedTextC;

            $aboutus->makeHidden(['b', 'c']);

            return response()->json([
                'success' => 1,
                'result' => $aboutus,
                'message' => __('app.data_returnd_sucssesfully')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }
}
