<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\ClientTestimonial;
use App\Models\ContactsPage;
use App\Models\ForWhoService;
use App\Models\HeroSection;
use App\Models\Project;
use App\Models\Service;
use App\Models\StepsProcess;
use App\Models\TeamMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{






    public function home(Request $request)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        $aboutus = AboutUs::with(['steps_process', 'client_testimonial', 'for_who_services'])->get();
        // $processedAboutus = $aboutus->map(function ($about) use ($locale, $defaultLanguage) {
        $heros = HeroSection::all();
        $data['hero_section'] = $heros->map(function ($hero) use ($locale) {

            return [
                'id' => $hero->id,
                'title' => $locale == 'en' ? $hero->en_title : $hero->nl_title,
                'sub_title' => $locale == 'en' ? $hero->en_sub_title : $hero->nl_sub_title,
                'image' => asset('storage/' . $hero->image_path)

            ];
        });
        $data['about_us'] = $aboutus->map(function ($about) use ($locale, $defaultLanguage) {
            return [
                'company_name' => $locale == 'en' ? $about->en_company_name : $about->nl_company_name,
                'introduction' => $locale == 'en' ? $about->en_introduction : $about->nl_introduction,
                'our_mission' => $locale == 'en' ? $about->en_our_mission : $about->nl_our_mission,
                'our_goals' => $locale == 'en' ? $about->en_our_goals : $about->nl_our_goals,
                'our_partners_associates' => $locale == 'en' ? $about->en_our_partners_associates : $about->nl_our_partners_associates,
                'client_testimonial' => $about->client_testimonial->map(function ($testimonial) use ($locale) {
                    return [
                        'client_name' => $testimonial->client_name,
                        'client_testimonial' => $locale == 'en' ? $testimonial->en_client_testimonial : $testimonial->nl_client_testimonial,
                        'image' => $testimonial->image_path
                    ];
                }),
            ];
        });



        $services = Service::with(['requirment', 'service_benefits', 'service_processs', 'client_testimonial', 'service_images'])->get();
        $data['services'] = $services->map(function ($service) use ($locale) {
            return [
                'id' => $service->id,
                'name' => $locale == 'en' ? $service->en_name : $service->nl_name,
                'description' => $locale == 'en' ? $service->en_description : $service->nl_description,
                'images' => $service->service_images->map(function ($related) use ($locale) {


                    return  asset('storage/' . $related->image_path);
                }),
            ];
        });

        $projects = Project::all();
        ///////////////////////
        $data['projects'] = $projects->map(function ($project) use ($locale) {

            return [
                'id' => $project->id,
                'title' => $locale == 'en' ? $project->en_title : $project->nl_title,
                'description' => $locale == 'en' ? $project->en_description : $project->nl_description,
                'images' => $project->project_images->map(function ($related) use ($locale) {

                    return
                        asset('storage/' . $related->image_path);
                }),

            ];
        });


        $contact = ContactsPage::first();
        $data['whats_next']['title'] = $locale == 'en' ? $contact->en_title : $contact->nl_title;
        $data['whats_next']['sub_title'] = $locale == 'en' ? $contact->en_sub_title : $contact->nl_sub_title;
        $data['whats_next']['whats_next_steps'] = $contact->contacts_whats_next->map(function ($subrelated) use ($locale, $contact) {
            return [
                'step_no' => $subrelated->step_no,
                'step' => $locale == 'en' ? $subrelated->en_step : $subrelated->nl_step,
            ];
        });

        return response()->json([
            'success' => 1,
            'result' => $data, //$processedAboutus,
            'message' => __('app.data_returnd_sucssesfully')
        ], 200);
    }

    public function show_home(Request $request)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        $language = App::getLocale();
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;
        $heros = HeroSection::all();
        $processed = $heros->map(function ($hero) use ($locale) {

            $data = [
                'id' => $hero->id,
                'title' => $locale == 'en' ? $hero->en_title : $hero->nl_title,
                'sub_title' => $locale == 'en' ? $hero->en_sub_title : $hero->nl_sub_title,
                'image_path' => $hero->image_path
            ];
            return $data;
        });

        $members = TeamMember::all();

        $services = Service::with(['requirment', 'service_benefits', 'service_processs', 'client_testimonial'])->get();
        $processedServices = $services->map(function ($service) use ($locale) {

            $data = [
                'id' => $service->id,
                'name' => $locale == 'en' ? $service->en_name : $service->nl_name,
                'description' => $locale == 'en' ? $service->en_description : $service->nl_description,
            ];
            return $data;
        });
        $aboutus = AboutUs::with(['steps_process', 'client_testimonial', 'for_who_services'])->get();
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



        return view('admin.home', compact('processed', 'members', 'processedServices', 'processedAboutus'));
     // return view('admin.Projects.index');
    }



    public function index(Request $request)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;
        //$data = [];
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
                $heros = HeroSection::all();
                $data['hero_section'] = $heros->map(function ($hero) use ($locale) {

                    return [
                        'id' => $hero->id,
                        'title' => $locale == 'en' ? $hero->en_title : $hero->nl_title,
                        'sub_title' => $locale == 'en' ? $hero->en_sub_title : $hero->nl_sub_title,
                        'image' => asset('storage/' . $hero->image_path)

                    ];
                });

                $data['about_us'] = [
                    'id' => $about->id,
                    'company_name' => $locale == 'en' ? $about->en_company_name : $about->nl_company_name,
                    'introduction' => $locale == 'en' ? $about->en_introduction : $about->nl_introduction,
                    'our_mission' => $locale == 'en' ? $about->en_our_mission : $about->nl_our_mission,
                    'our_goals' => $locale == 'en' ? $about->en_our_goals : $about->nl_our_goals,
                    //   'title_for_who' => $locale == 'en' ? $about->en_title_for_who : $about->nl_title_for_who,
                    //    'title_steps_process' => $locale == 'en' ? $about->en_title_steps_process : $about->nl_title_steps_process,
                    //   'meet_our_team' => $locale == 'en' ? $about->en_meet_our_team : $about->nl_meet_our_team,
                    'our_partners_associates' => $locale == 'en' ? $about->en_our_partners_associates : $about->nl_our_partners_associates,
                    'end' => $locale == 'en' ? $about->en_end : $about->nl_end,
                ];


                // Process Steps
                $data['steps_process']['title'] = $locale == 'en' ? $about->en_title_steps_process : $about->nl_title_steps_process;
                $data['steps_process']['steps'] = $about->steps_process->map(function ($step) use ($locale) {
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
                        'image' => $testimonial->image_path
                    ];
                });


                $data['for_who']['title'] = $locale == 'en' ? $about->en_title_for_who : $about->nl_title_for_who;
                $data['for_who']['benefits'] = $about->for_who_services->map(function ($service) use ($locale) {
                    return [
                        'name' => $locale == 'en' ? $service->en_name : $service->nl_name,
                        'description' => $locale == 'en' ? $service->en_description : $service->nl_description,
                    ];
                });



                $members = TeamMember::all();
                $data['meet_our_team']['title'] = 'en' ? $about->en_title_meet_our_team : $about->nl_title_meet_our_team;
                $data['meet_our_team']['sub_title'] = 'en' ? $about->en_sub_title_meet_our_team : $about->nl_sub_title_meet_our_team;
                $data['meet_our_team']['team_members'] = $members->map(function ($member) use ($locale) {
                    return [

                        'name' => $member->name,
                        'position' => $member->position,
                        'description' => $member->descciption,
                        'image_path' => asset('storage/' . $member->image_path)
                    ];
                });


                $contact = ContactsPage::first();
                $data['whats_next']['title'] = $locale == 'en' ? $contact->en_title : $contact->nl_title;
                $data['whats_next']['sub_title'] = $locale == 'en' ? $contact->en_sub_title : $contact->nl_sub_title;
                $data['whats_next']['whats_next_steps'] = $contact->contacts_whats_next->map(function ($subrelated) use ($locale, $contact) {
                    return [
                        'step_no' => $subrelated->step_no,
                        'step' => $locale == 'en' ? $subrelated->en_step : $subrelated->nl_step,
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
            //  'en_meet_our_team' => 'required',
            //  'nl_meet_our_team' => 'required',
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
                'en_title_for_who' => $request->en_title_for_who, //$validatedData['en_title_for_who'],
                'nl_title_for_who' => $request->nl_title_for_who,
                'en_title_steps_process' =>  $request->en_title_steps_process,
                'nl_title_steps_process' =>  $request->nl_title_steps_process,
                'en_title_meet_our_team' => $validatedData['en_title_meet_our_team'],
                'nl_title_meet_our_team' => $validatedData['nl_title_meet_our_team'],
                'en_sub_title_meet_our_team' => $validatedData['en_sub_title_meet_our_team'],
                'nl_sub_title_meet_our_team' => $validatedData['nl_sub_title_meet_our_team'],
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
            /* if (isset($validatedData['client_testimonial'])) {
                foreach ($validatedData['client_testimonial'] as $relatedData) {

                    $about_us->client_testimonial()->create($relatedData);
                }
            }*/
            if (isset($validatedData['client_testimonial'])) {
                foreach ($validatedData['client_testimonial'] as $index => $ffffData) {
                    $ffffImagePath = null;

                    // Check for FFFF image upload using the index
                    if ($request->hasFile("client_testimonial.$index.image_path")) {
                        $ffffImagePath = $request->file("client_testimonial.$index.image_path")->store('Client_images', 'public');
                    }

                    $about_us->client_testimonial()->create([
                        'client_name' => $ffffData['client_name'],
                        'en_client_testimonial' => $ffffData['en_client_testimonial'],
                        'nl_client_testimonial' => $ffffData['nl_client_testimonial'],
                        'image_path' => $ffffImagePath,
                    ]);
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
            /* return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);*/
            return redirect()->route('about-us.add')->with('error', $e);
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
            // 'en_meet_our_team' => 'required',
            // 'nl_meet_our_team' => 'required',
            'en_our_partners_associates' => 'required',
            'nl_our_partners_associates' => 'required',
            'en_end' => 'required',
            'nl_end' => 'required',

            "client_testimonials" => 'array',
            "steps_processs" => 'array',
            "for_who_services" => 'array',
        ]);
        if ($validation->fails()) {
            $about = AboutUs::findOrFail($id);
            return redirect()->route('aboutus.edit', $about->id)->with('error', $validation->errors());
            /* return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validation->errors(),
            ], 200);*/
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
                //  $aboutus->en_meet_our_team = $validatedData['en_meet_our_team'];
                //  $aboutus->nl_meet_our_team = $validatedData['nl_meet_our_team'];
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
                /* ClientTestimonial::where('about_us_id', $aboutus->id)->delete();
                if (isset($validatedData['client_testimonial'])) {
                    foreach ($validatedData['client_testimonial'] as $relatedData) {

                        $aboutus->client_testimonial()->create($relatedData);
                    }
                }*/
                //  ClientTestimonial::where('about_us_id', $aboutus->id)->delete();

                //////////////////////////********************** */
                if (isset($validatedData['client_testimoniall'])) {
                    foreach ($validatedData['client_testimonial'] as $index => $ffffData) {
                        $aboutus->client_testimonial()->create($ffffData);
                        if (isset($ffffData['id'])) {
                            ////////
                            /*  if ($request->hasFile('image_path')) {
                                $file = $request->image_path;
                                $filename = time() . '_' . $file->getClientOriginalName();
                                $filePath = $file->storeAs('Team_Members_images', $filename, 'public');

                                $member->name = $request->name;
                                $member->position = $request->position;
                                $member->description = $request->description;
                                $member->image_path = $filePath;
                                $member->save();
                            } else {

                                $member->name = $request->name;
                                $member->position = $request->position;
                                $member->description = $request->description;
                                $member->save();
                            }*/

                            /////////

                            $ffff = ClientTestimonial::findOrFail($ffffData['id']);
                            //   return [$ffff,"AAAAAAAAAAAAAAAAAAAAAAAAAAa"];

                            $ffff->client_name = $ffffData['client_name'];
                            $ffff->en_client_testimonial = $ffffData['en_client_testimonial'];
                            $ffff->nl_client_testimonial = $ffffData['nl_client_testimonial'];



                            if ($request->hasFile("client_testimonial.$index.image_path")) {
                                if ($ffff->image_path) {
                                    Storage::disk('public')->delete($ffff->image_path);
                                }
                                $ffffImagePath = $request->file("client_testimonial.$index.image_path")->store('ffff_images', 'public');
                                $ffff->image_path = $ffffImagePath;
                            }

                            $ffff->save();
                        } else {

                            $ffffImagePath = null;
                            if ($request->hasFile("client_testimonial.$index.image_path")) {

                                $ffffImagePath = $request->file("client_testimonial.$index.image_path")->store('ffff_images', 'public');
                                $k = $aboutus->client_testimonial()->create([
                                    'en_client_testimonial' => $ffffData['en_client_testimonial'],
                                    'nl_client_testimonial' => $ffffData['nl_client_testimonial'],
                                    'client_name' => $ffffData['client_name'],
                                    'image_path' => $ffffImagePath,
                                ]);
                                //  return $k;
                            }

                            // return $ffffImagePath;

                            /*   $aboutus->client_testimonial()->create([
                            //  'name' => $ffffData['name'],
                            'client_name' => $ffffData['client_name'],
                            'image_path' => $ffffImagePath,
                        ]);*/
                        }
                    }
                }
                /////////////////************************** */
                ////////////&&&&&&&&&&&&&&&&&&&&&
                if (isset($validatedData['client_testimonial'])) {
                    foreach ($validatedData['client_testimonial'] as $index => $ffffData) {
                        if (isset($ffffData['id'])) {
                            if (isset($ffffData['_delete']) && $ffffData['_delete'] == 1) {

                                $ffff = ClientTestimonial::findOrFail($ffffData['id']);
                                if ($ffff->image_path) {
                                    Storage::disk('public')->delete($ffff->image_path);
                                }
                                $ffff->delete();
                            } else {

                                $ffff = ClientTestimonial::findOrFail($ffffData['id']);
                                $ffff->en_client_testimonial = $ffffData['en_client_testimonial'];
                                $ffff->nl_client_testimonial = $ffffData['nl_client_testimonial'];


                                if ($request->hasFile("client_testimonial.$index.image_path")) {
                                    if ($ffff->image_path) {
                                        Storage::disk('public')->delete($ffff->image_path);
                                    }
                                    $ffffImagePath = $request->file("client_testimonial.$index.image_path")->store('Client_images', 'public');
                                    $ffff->image_path = $ffffImagePath;
                                }

                                $ffff->save();
                            }
                        } else {

                            $ffffImagePath = null;
                            if ($request->hasFile("client_testimonial.$index.image_path")) {
                                $ffffImagePath = $request->file("client_testimonial.$index.image_path")->store('Client_images', 'public');
                            }

                            $aboutus->client_testimonial()->create([
                                'client_name' => $ffffData['client_name'],
                                'en_client_testimonial' => $ffffData['en_client_testimonial'],
                                'nl_client_testimonial' => $ffffData['nl_client_testimonial'],
                                'image_path' => $ffffImagePath,
                            ]);
                        }
                    }
                }
                ///////////////////&&&&&&&&&&&&&&&&
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
            return redirect()->route('showall.about-us')->with('error', 'AboutUs Updated Faild!');
        }
    }


    ////////////////////////////////////////////////////////////////

    public function addaboutus()
    {
        return view('admin.AboutUs.addtest');
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
/*
 <div id="client_testimonials">
                                        @foreach ($aboutus->client_testimonial as $client_testimonial)
                                            <div class="client_testimoniall">
                                                <input type="hidden"
                                                    name="client_testimonial[{{ $client_testimonial->id }}][id]" value="{{ $client_testimonial->id }}">
                                                <label for="client_testimonial[0][client_name]">Client Name:</label>
                                                <input type="text" id="client_testimonial[0][client_name]"
                                                    name="client_testimonial[{{ $client_testimonial->id }}][client_name]"
                                                    value="{{ $client_testimonial->client_name }}"
                                                    class="form-control  "><br>

                                                <br>
                                                <label for="client_testimonial[0][en_client_testimonial]">Client
                                                    Testemonial
                                                    in English</label>
                                                <textarea id="client_testimonial[0][en_client_testimonial]"
                                                    name="client_testimonial[{{ $client_testimonial->id }}][en_client_testimonial]" class="form-control  ">{{ $client_testimonial->en_client_testimonial }}</textarea><br>

                                                <label for="client_testimonial[0][nl_client_testimonial]">Client
                                                    Testemonial
                                                    in Dutch
                                                </label>
                                                <textarea id="client_testimonial[0][nl_client_testimonial]"
                                                    name="client_testimonial[{{ $client_testimonial->id }}][nl_client_testimonial]" class="form-control  ">{{ $client_testimonial->nl_client_testimonial }}</textarea><br>
                                                <div class="form-group">
                                                    <label for="ffff_image_path_{{ $loop->index }}"> Image</label>
                                                    @if ($client_testimonial->image_path)
                                                        <div class="mb-2">
                                                            <img src="{{ Storage::url($client_testimonial->image_path) }}"
                                                                alt="FFFF Image" width="100">
                                                        </div>
                                                    @endif
                                                    <input type="file"
                                                        name="client_testimonial[{{ $client_testimonial->id }}][image_path]"
                                                        id="ffff_image_path_{{ $loop->index }}" class="form-control"
                                                        accept="image/*">
                                                </div>
                                                <button type="button" class="delete-client_testimoniall">Delete
                                                    Client Testimoniall </button>

                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
*/
