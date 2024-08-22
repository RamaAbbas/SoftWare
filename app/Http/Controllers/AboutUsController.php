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
                // $about->shortcut($locale,$about,$defaultLanguage);
                if ($locale == 'en') {
                    return [
                        'company_name' => $about->en_company_name ?? __('app.lang_not_supported'),
                        'introduction' => $about->en_introduction ?? __('app.lang_not_supported'),
                        'our_mission' => $about->en_our_mission ?? __('app.lang_not_supported'),
                        'our_goals' => $about->en_our_goals ?? __('app.lang_not_supported'),
                        'title_for_who' => $about->en_title_for_who ?? __('app.lang_not_supported'),
                        'title_steps_process' => $about->en_title_steps_process ?? __('app.lang_not_supported'),
                        'meet_our_team' => $about->en_meet_our_team ?? __('app.lang_not_supported'),
                        'our_partners_associates' => $about->en_our_partners_associates ?? __('app.lang_not_supported'),
                        'end' => $about->en_end ?? __('app.lang_not_supported'),
                        "Steps Process" => "0",
                        $about->steps_process = $about->steps_process->map(function ($related) use ($locale, $defaultLanguage, $about) {
                            $steps_process = [
                                'step_no' => $related->step_no,
                                'process_name' => $related->en_name ?? __('app.lang_not_supported'),
                                'process_description' => $related->en_description ?? __('app.lang_not_supported'),

                            ];
                            return $steps_process;
                        }),
                        "Client Testemonial" => "1",
                        $about->client_testimonial = $about->client_testimonial->map(function ($related) use ($locale, $defaultLanguage, $about) {
                            $client_testimonial = [
                                "Title of Section" => "Here is Client Testemonial",
                                'client_testimonial' => $related->en_client_testimonial ?? __('app.lang_not_supported'),
                                'client_name' => $related->client_name ?? __('app.lang_not_supported'),

                            ];
                            return $client_testimonial;
                        }),
                        "Services For Who_" => "2",
                        $about->for_who_services = $about->for_who_services->map(function ($related) use ($locale, $defaultLanguage, $about) {
                            $client_testimonial = [
                                'name_of_service_for_who' => $related->en_name ?? __('app.lang_not_supported'),
                                'description_of_service_for_who' => $related->en_description ?? __('app.lang_not_supported'),

                            ];
                            return $client_testimonial;
                        })
                    ];
                } else {
                    return [
                        'company_name' => $about->nl_company_name ?? __('app.lang_not_supported'),
                        'introduction' => $about->nl_introduction ?? __('app.lang_not_supported'),
                        'our_mission' => $about->nl_our_mission ?? __('app.lang_not_supported'),
                        'our_goals' => $about->nl_our_goals ?? __('app.lang_not_supported'),
                        'title_for_who' => $about->nl_title_for_who ?? __('app.lang_not_supported'),
                        'title_steps_process' => $about->nl_title_steps_process ?? __('app.lang_not_supported'),
                        'meet_our_team' => $about->nl_meet_our_team ?? __('app.lang_not_supported'),
                        'our_partners_associates' => $about->nl_our_partners_associates ?? __('app.lang_not_supported'),
                        'end' => $about->nl_end ?? __('app.lang_not_supported'),
                        $about->steps_process = $about->steps_process->map(function ($related) use ($locale, $defaultLanguage, $about) {
                            $steps_process = [
                                'process_name' => $related->nl_name ?? __('app.lang_not_supported'),
                                'process_description' => $related->nl_description ?? __('app.lang_not_supported'),

                            ];
                            return $steps_process;
                        }),
                        $about->client_testimonial = $about->client_testimonial->map(function ($related) use ($locale, $defaultLanguage, $about) {
                            $client_testimonial = [
                                "Title of Section" => "Here is Client Testemonial",
                                'client_testimonial' => $related->nl_client_testimonial ?? __('app.lang_not_supported'),
                                'client_name' => $related->client_name ?? __('app.lang_not_supported'),

                            ];
                            return $client_testimonial;
                        }),
                        $about->for_who_services = $about->for_who_services->map(function ($related) use ($locale, $defaultLanguage, $about) {
                            $for_who_services = [
                                'name_of_service_for_who' => $related->nl_name ?? __('app.lang_not_supported'),
                                'description_of_service_for_who' => $related->nl_description ?? __('app.lang_not_supported'),

                            ];
                            return $for_who_services;
                        })
                    ];
                }
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

            // $aboutus->shortcut($locale, $aboutus, $defaultLanguage);
            if ($locale == 'en') {
                return [
                    'company_name' => $aboutus->en_company_name ?? __('app.lang_not_supported'),
                    'introduction' => $aboutus->en_introduction ?? __('app.lang_not_supported'),
                    'our_mission' => $aboutus->en_our_mission ?? __('app.lang_not_supported'),
                    'our_goals' => $aboutus->en_our_goals ?? __('app.lang_not_supported'),
                    'title_for_who' => $aboutus->en_title_for_who ?? __('app.lang_not_supported'),
                    'title_steps_process' => $aboutus->en_title_steps_process ?? __('app.lang_not_supported'),
                    'meet_our_team' => $aboutus->en_meet_our_team ?? __('app.lang_not_supported'),
                    'our_partners_associates' => $aboutus->en_our_partners_associates ?? __('app.lang_not_supported'),
                    'end' => $aboutus->en_end ?? __('app.lang_not_supported'),
                    "Steps Process" => "0",
                    $aboutus->steps_process = $aboutus->steps_process->map(function ($related) use ($locale, $defaultLanguage, $aboutus) {
                        $steps_process = [
                           // 'step_no' => $related->step_no,
                            'process_name' => $related->en_name ?? __('app.lang_not_supported'),
                            'process_description' => $related->en_description ?? __('app.lang_not_supported'),

                        ];
                        return $steps_process;
                    }),
                    "Client Testemonial" => "1",
                    $aboutus->client_testimonial = $aboutus->client_testimonial->map(function ($related) use ($locale, $defaultLanguage, $aboutus) {
                        $client_testimonial = [
                            "Title of Section" => "Here is Client Testemonial",
                            'client_testimonial' => $related->en_client_testimonial ?? __('app.lang_not_supported'),
                            'client_name' => $related->client_name ?? __('app.lang_not_supported'),

                        ];
                        return $client_testimonial;
                    }),
                    "Services For Who_" => "2",
                    $aboutus->for_who_services = $aboutus->for_who_services->map(function ($related) use ($locale, $defaultLanguage, $aboutus) {
                        $client_testimonial = [
                            'name_of_service_for_who' => $related->en_name ?? __('app.lang_not_supported'),
                            'description_of_service_for_who' => $related->en_description ?? __('app.lang_not_supported'),

                        ];
                        return $client_testimonial;
                    })
                ];
            } else if($locale=='nl'){
                return [
                    'company_name' => $aboutus->nl_company_name ?? __('app.lang_not_supported'),
                    'introduction' => $aboutus->nl_introduction ?? __('app.lang_not_supported'),
                    'our_mission' => $aboutus->nl_our_mission ?? __('app.lang_not_supported'),
                    'our_goals' => $aboutus->nl_our_goals ?? __('app.lang_not_supported'),
                    'title_for_who' => $aboutus->nl_title_for_who ?? __('app.lang_not_supported'),
                    'title_steps_process' => $aboutus->nl_title_steps_process ?? __('app.lang_not_supported'),
                    'meet_our_team' => $aboutus->nl_meet_our_team ?? __('app.lang_not_supported'),
                    'our_partners_associates' => $aboutus->nl_our_partners_associates ?? __('app.lang_not_supported'),
                    'end' => $aboutus->nl_end ?? __('app.lang_not_supported'),
                    $aboutus->steps_process = $aboutus->steps_process->map(function ($related) use ($locale, $defaultLanguage, $aboutus) {
                        $steps_process = [
                            'process_name' => $related->nl_name ?? __('app.lang_not_supported'),
                            'process_description' => $related->nl_description ?? __('app.lang_not_supported'),

                        ];
                        return $steps_process;
                    }),
                    $aboutus->client_testimonial = $aboutus->client_testimonial->map(function ($related) use ($locale, $defaultLanguage, $aboutus) {
                        $client_testimonial = [
                            "Title of Section" => "Here is Client Testemonial",
                            'client_testimonial' => $related->nl_client_testimonial ?? __('app.lang_not_supported'),
                            'client_name' => $related->client_name ?? __('app.lang_not_supported'),

                        ];
                        return $client_testimonial;
                    }),
                    $aboutus->for_who_services = $aboutus->for_who_services->map(function ($related) use ($locale, $defaultLanguage, $aboutus) {
                        $for_who_services = [
                            'name_of_service_for_who' => $related->nl_name ?? __('app.lang_not_supported'),
                            'description_of_service_for_who' => $related->nl_description ?? __('app.lang_not_supported'),

                        ];
                        return $for_who_services;
                    })
                ];
            }

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
