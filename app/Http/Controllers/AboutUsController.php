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


        $aboutus = AboutUs::with(['steps_process', 'client_testimonial'])->get();
        //return $aboutus;
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

                /*  if (is_string($about->company_name)) {
                    $comp = json_decode($about->company_name);
                    $company = json_decode($comp);

                    //  $about->company_name = $company;
                    $a = array_map(function ($item) use ($locale, $defaultLanguage) {
                        $string = json_encode($item);
                        $s = json_decode($string);

                        // $a=json_encode($s->a);

                        //   return  $about->company_name = $s[$locale] ?? $s[$defaultLanguage] ?? __('app.lang_not_supported');
                        //json_encode($s);
                        if ($locale == 'nl') {
                            return [
                                "a" => $s->a->nl,
                                "b" => $s->b->nl
                            ];
                        } else {
                            return [
                                "a" => $s->a->en,
                                "b" => $s->b->en
                            ];
                        }
                    }, $company);
                    $about->company_name = $a;
                }*/
                if (is_string($about->introduction)) {
                    $introduction = json_decode($about->introduction, true);
                    $about->introduction = $introduction[$locale] ?? $introduction[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->our_mission)) {
                    $our_mission = json_decode($about->our_mission, true);
                    $about->our_mission = $our_mission[$locale] ?? $our_mission[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->for_who)) {
                    $who = json_decode($about->for_who);
                    $for_who = json_decode($who);
                    $a = array_map(function ($item) use ($locale, $defaultLanguage) {
                        $string = json_encode($item);
                        $s = json_decode($string);

                        if ($locale == 'nl') {
                            return [
                                "name" => $s->name->nl ?? $s->name->$defaultLanguage ?? __('app.lang_not_supported'),
                                "description" => $s->description->nl ?? $s->description->$defaultLanguage ?? __('app.lang_not_supported')
                            ];
                        } else {
                            return [
                                "name" => $s->name->en ?? $s->name->$defaultLanguage ?? __('app.lang_not_supported'),
                                "description" => $s->description->en  ?? $s->description->$defaultLanguage ?? __('app.lang_not_supported')
                            ];
                        }
                    }, $for_who);
                    $about->for_who = $a;
                }

                if (is_string($about->meet_our_team)) {
                    $meet_our_team = json_decode($about->meet_our_team, true);
                    $about->meet_our_team = $meet_our_team[$locale] ?? $meet_our_team[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->our_partners_associates)) {
                    $our_partners_associates = json_decode($about->our_partners_associates, true);
                    $about->our_partners_associates = $our_partners_associates[$locale] ?? $our_partners_associates[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($about->title_for_who)) {
                    $title_for_who = json_decode($about->title_for_who, true);
                    $about->title_for_who = $title_for_who[$locale] ?? $title_for_who[$defaultLanguage] ?? __('app.lang_not_supported');
                }

                $about->steps_process = $about->steps_process->map(function ($related) use ($locale, $defaultLanguage) {
                    if (is_string($related->name)) {
                        $name = json_decode($related->name, true);
                        $related->name = $name[$locale] ?? $name[$defaultLanguage] ?? __('app.lang_not_supported');
                    }
                    if (is_string($related->description)) {
                        $description = json_decode($related->description, true);
                        $related->description = $description[$locale] ?? $description[$defaultLanguage] ?? __('app.lang_not_supported');
                    }
                    return $related;
                });
                $about->client_testimonial = $about->client_testimonial->map(function ($related) use ($locale, $defaultLanguage) {
                    if (is_string($related->client)) {
                        $client = json_decode($related->client, true);
                        $related->client = $client[$locale] ?? $client[$defaultLanguage] ?? __('app.lang_not_supported');
                    }
                    if (is_string($related->testimonial)) {
                        $testimonial = json_decode($related->testimonial, true);
                        $related->testimonial = $testimonial[$locale] ?? $testimonial[$defaultLanguage] ?? __('app.lang_not_supported');
                    }
                    return $related;
                });


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
                'company_name' => json_encode($request->company_name),
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
