<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{


    public function index(Request $request)
    {

        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;


        $aboutus = AboutUs::with(['steps_process', 'client_testimonial', 'for_who_services'])->get();

        if ($aboutus->isEmpty()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }

        try {

            $processedِAboutus = $aboutus->map(function ($about) use ($locale, $defaultLanguage) {
               $about->shortcut($locale,$about,$defaultLanguage);
                return $about;
            });

            return response()->json([
                'success' => 1,
                'result' => $processedِAboutus,
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
            'en_company_name' => 'required',
            'nl_company_name' => 'required',
            'en_introduction' => 'required',
            'nl_introduction' => 'required',
            'en_our_mission' => 'required',
            'nl_our_mission' => 'required',
            'en_our_goals' => 'required',
            'nl_our_goals' => 'required',
            'en_title_for_who' => 'required',
            'nl_title_for_who' => 'required',
            'en_title_steps_process' => 'required',
            'nl_title_steps_process' => 'required',
            'en_meet_our_team' => 'required',
            'nl_meet_our_team' => 'required',
            'en_our_partners_associates' => 'required',
            'nl_our_partners_associates' => 'required',
            'en_end' => 'required',
            'nl_end' => 'required',

            "client_testimonials" => 'array',
            "steps_processs" => 'array',
            "for_who_services" => 'array',
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
            $validatedData = $request->all();
            $about_us = AboutUs::create([
                'en_company_name' => $validatedData['en_company_name'],
                'nl_company_name' => $validatedData['nl_company_name'],
                'en_introduction' => $validatedData['en_introduction'],
                'nl_introduction' => $validatedData['nl_introduction'],
                'en_our_mission' => $validatedData['en_our_mission'],
                'nl_our_mission' => $validatedData['nl_our_mission'],
                'en_our_goals' => $validatedData['en_our_goals'],
                'nl_our_goals' => $validatedData['nl_our_goals'],
                'en_title_for_who' => $validatedData['en_title_for_who'],
                'nl_title_for_who' => $validatedData['nl_title_for_who'],
                'en_title_steps_process' => $validatedData['en_title_steps_process'],
                'nl_title_steps_process' => $validatedData['nl_title_steps_process'],
                'en_meet_our_team' => $validatedData['en_meet_our_team'],
                'nl_meet_our_team' => $validatedData['nl_meet_our_team'],
                'en_our_partners_associates' => $validatedData['en_our_partners_associates'],
                'nl_our_partners_associates' => $validatedData['nl_our_partners_associates'],
                'en_end' => $validatedData['en_end'],
                'nl_end' => $validatedData['nl_end'],


            ]);
            if (isset($validatedData['steps_processs'])) {
                foreach ($validatedData['steps_processs'] as $relatedData) {

                    $about_us->steps_process()->create($relatedData);
                }
            }
            if (isset($validatedData['client_testimonials'])) {
                foreach ($validatedData['client_testimonials'] as $relatedData) {

                    $about_us->client_testimonial()->create($relatedData);
                }
            }
            if (isset($validatedData['for_who_services'])) {
                foreach ($validatedData['for_who_services'] as $relatedData) {

                    $about_us->for_who_services()->create($relatedData);
                }
            }
            DB::commit();
            return response()->json([
                'sucsess' => 1,
                'result' => $about_us,
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
        $language = $request->header('Accept-Language');
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

           $aboutus->shortcut($locale,$aboutus,$defaultLanguage);

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
