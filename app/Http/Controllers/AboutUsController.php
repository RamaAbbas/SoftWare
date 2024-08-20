<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{


    /* public function index(Request $request)
    {

        $language = $request->header('Lang');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;


        $aboutus = AboutUs::all();
        //$aboutus = AboutUs::select() //
        //   ->get();
        if ($aboutus->isEmpty()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }

        try {

            $processedServices = $aboutus->map(function ($aboutus) use ($locale, $defaultLanguage) {
                if (is_string($aboutus->for_who)) {
                    $jsonData = json_decode($aboutus->for_who, true);
                }
                if (is_string($aboutus->steps_process)) {
                    $jsonData2 = json_decode($aboutus->steps_process, true);
                }

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
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }*/
    public function index(Request $request)
    {

        $language = $request->header('Lang');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;


        $aboutus = AboutUs::all();
        //$aboutus = AboutUs::select() //
        //   ->get();
        if ($aboutus->isEmpty()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }

        try {

            $processedServices = $aboutus->map(function ($about) use ($locale, $defaultLanguage) {

                if (is_string($about->company_name)) {
                    $company_name = json_decode($about->company_name, true);
                    $about->company_name = $company_name[$locale] ?? $company_name[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->introduction)) {
                    $introduction = json_decode($about->introduction, true);
                    $about->introduction = $introduction[$locale] ?? $introduction[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->our_mission)) {
                    $our_mission = json_decode($about->our_mission, true);
                    $about->our_mission = $our_mission[$locale] ?? $our_mission[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->for_who)) {
                    $for_who = json_decode($about->for_who, true);
                    $about->for_who = $for_who[$locale] ?? $for_who[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->steps_process)) {
                    $steps_process = json_decode($about->steps_process, true);
                    $about->steps_process = $steps_process[$locale] ?? $steps_process[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->meet_our_team)) {
                    $meet_our_team = json_decode($about->meet_our_team, true);
                    $about->meet_our_team = $meet_our_team[$locale] ?? $meet_our_team[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->our_partners_associates)) {
                    $our_partners_associates = json_decode($about->our_partners_associates, true);
                    $about->our_partners_associates = $our_partners_associates[$locale] ?? $our_partners_associates[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->client_testimonials)) {
                    $client_testimonials = json_decode($about->client_testimonials, true);
                    $about->client_testimonials = $client_testimonials[$locale] ?? $client_testimonials[$defaultLanguage] ?? __('app.lang_not_supported');
                }


                return $about;
            });

            return response()->json([
                'success' => 1,
                'result' => $processedServices,
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


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'company_name' => 'required',
            'introduction' => 'required',
            'our_mission' => 'required',
            //  '*.for_who.en' => 'required',
            //  '*.for_who.nl' => 'required',
            'for_who' => 'required',
            "steps_process" => 'required',
            //  "*.steps_process.en" => 'required',
            //  "*.steps_process.nl" => 'required',
            "meet_our_team" => 'required|string',
            "our_partners_associates" => 'required',
            "client_testimonials" => 'required',
        ]);
        if ($validation->fails()) {

            return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validation->errors(),
            ], 200);
        }
        DB::beginTransaction();
        try {
            $service = AboutUs::create([
                'company_name' => $request->company_name,
                'introduction' => $request->introduction,
                'our_mission' => $request->our_mission,
                "for_who" => $request->for_who,
                "steps_process" => $request->steps_process,
                "meet_our_team" => $request->meet_our_team,
                "our_partners_associates" => $request->our_partners_associates,
                "client_testimonials" => $request->client_testimonials,


            ]);
            DB::commit();
            return response()->json([
                'sucsess' => 1,
                'result' => $service,
                'message' => "",
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
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
