<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\ForWhoService;
use App\Models\StepsProcess;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
            $processedAboutus = $aboutus->map(function ($about) use ($locale, $defaultLanguage) {
                $data = [
                    'id' => $about->id,
                    'company_name' => $locale == 'en' ? $about->en_company_name : $about->nl_company_name,
                    'introduction' => $locale == 'en' ? $about->en_introduction : $about->nl_introduction,
                    'our_mission' => $locale == 'en' ? $about->en_our_mission : $about->nl_our_mission,
                    'our_goals' => $locale == 'en' ? $about->en_our_goals : $about->nl_our_goals,
                    'title_for_who' => $locale == 'en' ? $about->en_title_for_who : $about->nl_title_for_who,
                    'title_steps_process' => $locale == 'en' ? $about->en_title_steps_process : $about->nl_title_steps_process,
                    'meet_our_team' => $locale == 'en' ? $about->en_meet_our_team : $about->nl_meet_our_team,
                    'our_partners_associates' => $locale == 'en' ? $about->en_our_partners_associates : $about->nl_our_partners_associates,
                    'end' => $locale == 'en' ? $about->en_end : $about->nl_end,
                ];

                // Process Steps
                $data['steps_process'] = $about->steps_process->map(function ($step) use ($locale) {
                    return [
                        'step_no' => $step->step_no,
                        'process_name' => $locale == 'en' ? $step->en_name : $step->nl_name,
                        'process_description' => $locale == 'en' ? $step->en_description : $step->nl_description,
                    ];
                });

                // Process Client Testimonials
                $data['client_testimonial'] = $about->client_testimonial->map(function ($testimonial) use ($locale) {
                    return [
                        'client_name' => $testimonial->client_name,
                        'client_testimonial' => $locale == 'en' ? $testimonial->en_client_testimonial : $testimonial->nl_client_testimonial,
                    ];
                });

                // Process For Who Services
                $data['for_who_services'] = $about->for_who_services->map(function ($service) use ($locale) {
                    return [
                        'name_of_service_for_who' => $locale == 'en' ? $service->en_name : $service->nl_name,
                        'description_of_service_for_who' => $locale == 'en' ? $service->en_description : $service->nl_description,
                    ];
                });

                return $data;
            });

            return response()->json([
                'success' => 1,
                'result' => $processedAboutus,
                'message' => __('app.data_returnd_sucssesfully')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 200);
        }
    }
    ////////////////////////////////////////////////////////////////
    public function show_all()
    {
        $language = App::getLocale();
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;
        $aboutus = AboutUs::with(['steps_process', 'client_testimonial', 'for_who_services'])->get();
        try {
            $processedAboutus = $aboutus->map(function ($about) use ($locale, $defaultLanguage) {
                $data = [
                    'id' => $about->id,
                    'company_name' => $locale == 'en' ? $about->en_company_name : $about->nl_company_name,
                    'introduction' => $locale == 'en' ? $about->en_introduction : $about->nl_introduction,
                    'our_mission' => $locale == 'en' ? $about->en_our_mission : $about->nl_our_mission,
                    'our_goals' => $locale == 'en' ? $about->en_our_goals : $about->nl_our_goals,
                    'title_for_who' => $locale == 'en' ? $about->en_title_for_who : $about->nl_title_for_who,
                    'title_steps_process' => $locale == 'en' ? $about->en_title_steps_process : $about->nl_title_steps_process,
                    'meet_our_team' => $locale == 'en' ? $about->en_meet_our_team : $about->nl_meet_our_team,
                    'our_partners_associates' => $locale == 'en' ? $about->en_our_partners_associates : $about->nl_our_partners_associates,
                    'end' => $locale == 'en' ? $about->en_end : $about->nl_end,
                ];

                // Process Steps
                $data['steps_process'] = $about->steps_process->map(function ($step) use ($locale) {
                    return [
                        'process_name' => $locale == 'en' ? $step->en_name : $step->nl_name,
                        'process_description' => $locale == 'en' ? $step->en_description : $step->nl_description,
                    ];
                });

                // Process Client Testimonials
                $data['client_testimonial'] = $about->client_testimonial->map(function ($testimonial) use ($locale) {
                    return [
                        'client_name' => $testimonial->client_name,
                        'client_testimonial' => $locale == 'en' ? $testimonial->en_client_testimonial : $testimonial->nl_client_testimonial,
                    ];
                });

                // Process For Who Services
                $data['for_who_services'] = $about->for_who_services->map(function ($service) use ($locale) {
                    return [
                        'name_of_service_for_who' => $locale == 'en' ? $service->en_name : $service->nl_name,
                        'description_of_service_for_who' => $locale == 'en' ? $service->en_description : $service->nl_description,
                    ];
                });

                return $data;
            });
            return view('admin.AboutUs.aboutus', compact('processedAboutus'));
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    ////////////////////////////////////////////////////////////////

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
            // 'en_title_for_who' => 'required',
            // 'nl_title_for_who' => 'required',
            // 'en_title_steps_process' => 'required',
            // 'nl_title_steps_process' => 'required',
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

            return redirect()->back()->with('error', $validation->errors());
            /*response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validation->errors(),
            ], 200);*/
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
            if (isset($validatedData['client_testimonial'])) {
                foreach ($validatedData['client_testimonial'] as $relatedData) {

                    $about_us->client_testimonial()->create($relatedData);
                }
            }
            if (isset($validatedData['for_who_services'])) {
                foreach ($validatedData['for_who_services'] as $relatedData) {

                    $about_us->for_who_services()->create($relatedData);
                }
            }
            DB::commit();
            return redirect()->route('about-us.add')->with('success', 'About Us created successfully!');
            /*  return response()->json([
                'sucsess' => 1,
                'result' => $about_us,
                'message' => "",
            ], 200);*/
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }

    public function edit($id)
    {
        $aboutus = AboutUs::with(['steps_process', 'client_testimonial', 'for_who_services'])->findOrFail($id);
        if ($aboutus) {
            return view('admin.AboutUs.edit', compact('aboutus'));
        } else {

            return redirect()->back();
        }
    }



    public function update(Request $request, $id)
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
            $aboutus = AboutUs::findOrFail($id);
            if ($aboutus) {

                $aboutus->en_company_name = $validatedData['en_company_name'];
                $aboutus->nl_company_name = $validatedData['nl_company_name'];
                $aboutus->en_introduction = $validatedData['en_introduction'];
                $aboutus->nl_introduction = $validatedData['nl_introduction'];
                $aboutus->en_our_mission = $validatedData['en_our_mission'];
                $aboutus->nl_our_mission = $validatedData['nl_our_mission'];
                $aboutus->en_our_goals = $validatedData['en_our_goals'];
                $aboutus->nl_our_goals = $validatedData['nl_our_goals'];
                $aboutus->en_title_for_who = $validatedData['en_title_for_who'];
                $aboutus->nl_title_for_who = $validatedData['nl_title_for_who'];
                $aboutus->en_title_steps_process = $validatedData['en_title_steps_process'];
                $aboutus->nl_title_steps_process = $validatedData['nl_title_steps_process'];
                $aboutus->en_meet_our_team = $validatedData['en_meet_our_team'];
                $aboutus->nl_meet_our_team = $validatedData['nl_meet_our_team'];
                $aboutus->en_our_partners_associates = $validatedData['en_our_partners_associates'];
                $aboutus->nl_our_partners_associates = $validatedData['nl_our_partners_associates'];
                $aboutus->en_end = $validatedData['en_end'];
                $aboutus->nl_end = $validatedData['nl_end'];
                $aboutus->save();


                StepsProcess::where('about_us_id', $aboutus->id)->delete();

                if (isset($validatedData['steps_processs'])) {
                    foreach ($validatedData['steps_processs'] as $relatedData) {

                        $aboutus->steps_process()->create($relatedData);
                    }
                }
                if (isset($validatedData['client_testimonial'])) {
                    foreach ($validatedData['client_testimonial'] as $relatedData) {

                        $aboutus->client_testimonial()->create($relatedData);
                    }
                }
                ForWhoService::where('about_us_id', $aboutus->id)->delete();
                if (isset($validatedData['for_who_services'])) {
                    foreach ($validatedData['for_who_services'] as $relatedData) {

                        $aboutus->for_who_services()->create($relatedData);
                    }
                }
            }
            DB::commit();

            return redirect()->route('showall.about-us')->with('success', 'AboutUs Updated successfully!');
            /* return response()->json([
                'sucsess' => 1,
                'result' => $aboutus,
                'message' => "Abput us updated Sucsessfully",
            ], 200);*/
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }


    ////////////////////////////////////////////////////////////////

    public function addaboutus()
    {
        return view('admin.AboutUs.add');
    }

    ////////////////////////////////////////////////////////////////



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

            $data = [
                'company_name' => $locale == 'en' ? $aboutus->en_company_name : $aboutus->nl_company_name,
                'introduction' => $locale == 'en' ? $aboutus->en_introduction : $aboutus->nl_introduction,
                'our_mission' => $locale == 'en' ? $aboutus->en_our_mission : $aboutus->nl_our_mission,
                'our_goals' => $locale == 'en' ? $aboutus->en_our_goals : $aboutus->nl_our_goals,
                'title_for_who' => $locale == 'en' ? $aboutus->en_title_for_who : $aboutus->nl_title_for_who,
                'title_steps_process' => $locale == 'en' ? $aboutus->en_title_steps_process : $aboutus->nl_title_steps_process,
                'meet_our_team' => $locale == 'en' ? $aboutus->en_meet_our_team : $aboutus->nl_meet_our_team,
                'our_partners_associates' => $locale == 'en' ? $aboutus->en_our_partners_associates : $aboutus->nl_our_partners_associates,
                'end' => $locale == 'en' ? $aboutus->en_end : $aboutus->nl_end,
            ];

            // Process Steps
            $data['steps_process'] = $aboutus->steps_process->map(function ($step) use ($locale) {
                return [
                    'step_no' => $step->step_no,
                    'process_name' => $locale == 'en' ? $step->en_name : $step->nl_name,
                    'process_description' => $locale == 'en' ? $step->en_description : $step->nl_description,
                ];
            });

            // Process Client Testimonials
            $data['client_testimonial'] = $aboutus->client_testimonial->map(function ($testimonial) use ($locale) {
                return [
                    'client_name' => $testimonial->client_name,
                    'client_testimonial' => $locale == 'en' ? $testimonial->en_client_testimonial : $testimonial->nl_client_testimonial,
                ];
            });

            // Process For Who Services
            $data['for_who_services'] = $aboutus->for_who_services->map(function ($service) use ($locale) {
                return [
                    'name_of_service_for_who' => $locale == 'en' ? $service->en_name : $service->nl_name,
                    'description_of_service_for_who' => $locale == 'en' ? $service->en_description : $service->nl_description,
                ];
            });


            return response()->json([
                'success' => 1,
                'result' => $data,
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

    public function destroy($id)
    {
        $aboutus = AboutUs::findOrFail($id);
        if ($aboutus) {
            $aboutus->delete();
            return redirect()->route('showall.about-us')->with('success', "Aboutus Deleted Sucsessfully");
            /* return response()->json([
                'success' => 1,
                'result' => null,
                'message' => __('app.service_deleted_sucsessfully')
            ], 200);*/
        } else {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.faild_to_delete_service')
            ], 200);
        }
    }
    ////////////////////////////////////////////////////////////////
}
