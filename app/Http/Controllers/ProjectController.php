<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        $projects = Project::with(['client', 'service_categories', 'project_images', 'project_live_links', 'project_technologies', 'achievements', 'challenges'])->get();

        if ($projects->isEmpty()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }

        try {
            $processedServices = $projects->map(function ($project) use ($locale) {
                $begin = Carbon::parse($project->begin_date);
                $end = Carbon::parse($project->end_date);
                $diffInDays = $begin->diffInDays($end);





                $data = [
                    'id' => $project->id,
                    'title' => $locale == 'en' ? $project->en_title : $project->nl_title,
                    'description' => $locale == 'en' ? $project->en_description : $project->nl_description,
                  //  'image'=>'asset('."'"."storage/".$img."'".')',
                    // 'time' => $diffInDays,
                    // 'end_date' => $project->end_date,
                    // 'result' => $locale == 'en' ? $project->en_result : $project->nl_result,
                ];
                $image=$project->project_images()->first();
                $img=$image['image_path'];
            /*    if($image){
                    $data['images']=[
                        'image'=>'asset('."'"."storage/".$img."'".')',
                    ];
                }*/
                if($image){
                    $data['image']=
                       asset('storage/'.$img);

                }
               /* $data['project_images'] = $project->project_images->map(function ($related) use ($locale) {
                    return [
                        'image_path' =>'asset('."'"."storage/".$related->image_path."'".')'

                    ];
                });*/

                return $data;
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
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function show_all()
    {

        $language = App::getLocale();
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;
        $projects = Project::with(['client', 'service_categories', 'project_images', 'project_live_links', 'project_technologies', 'achievements', 'challenges'])->get();
        $processedproject = $projects->map(function ($project) use ($locale) {

            $data = [
                'id' => $project->id,
                'title' => $locale == 'en' ? $project->en_title : $project->nl_title,
                'description' => $locale == 'en' ? $project->en_description : $project->nl_description,
            ];
            $client = $project->client()->get();
            $data['client']['first_name'] = $client[0]['first_name'];
            $data['client']['last_name'] = $client[0]['last_name'];
            $data['client']['email'] = $client[0]['email'];
            $data['client']['phone_number'] = $client[0]['phone_number'];
            return $data;
        });
        return view('admin.Projects.index', compact('processedproject'));
    }

    public function store(Request $request)
    {
        if ($request->client_id) {
            $validatedDat = Validator::make($request->all(), [
                'en_title' => 'required|string|max:255',
                'nl_title' => 'required|string|max:255',
                'en_description' => 'required',
                'nl_description' => 'required',
                'en_result' => 'required',
                'nl_result' => 'required',
                'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'client_id' => 'required',
                'begin_date' => 'required|date',
                'service_ids.*' => 'required',
                'end_date' => 'required|date|after_or_equal:begin_date',


            ]);
            if ($validatedDat->fails()) {

                return response()->json([
                    'sucsess' => 0,
                    'result' => null,
                    'message' => $validatedDat->errors(),
                ], 200);
            }



            DB::beginTransaction();

            try {
                $validatedData = $request->all();

                $project = Project::create([
                    'client_id' => $validatedData['client_id'],
                    'en_title' => $validatedData['en_title'],
                    'nl_title' => $validatedData['nl_title'],
                    'en_description' => $validatedData['en_description'],
                    'nl_description' => $validatedData['nl_description'],
                    //  'begin_date' =>Carbon::createFromFormat('d-m-Y',$validatedData['begin_date']),
                    'begin_date' => Carbon::parse($validatedData['begin_date']),
                    'end_date' => Carbon::parse($validatedData['end_date']),
                    'en_result' => $validatedData['en_result'],
                    'nl_result' => $validatedData['nl_result'],
                ]);

                /*  if (!empty($validatedData['service_categories'])) {
                    foreach ($validatedData['service_categories'] as $service_categories) {

                        $project->service_categories()->create(
                            [
                                // 'en_service_name' => $service_categories['en_service_name'],
                                // 'nl_service_name' => $service_categories['nl_service_name'],
                                'service_id' => $service_categories['service_id']

                            ]
                        );
                    }
                }*/
                if ($request->has('service_ids')) {
                    foreach ($request->service_ids as $service_id) {
                        $service = Service::findOrFail($service_id);
                        $project->service_categories()->create(
                            [
                                'service_id' => $service->id

                            ]
                        );
                    }
                }

                if (!empty($validatedData['achievements'])) {
                    foreach ($validatedData['achievements'] as $achievements) {

                        $project->achievements()->create(
                            [
                                'en_achievement_name' => $achievements['en_achievement_name'],
                                'nl_achievement_name' => $achievements['nl_achievement_name'],
                                //   'en_how_we_achieved_it' => $achievements['en_how_we_achieved_it'],
                                //   'nl_how_we_achieved_it' => $achievements['nl_how_we_achieved_it'],

                            ]
                        );
                    }
                }

                if (!empty($validatedData['challenges'])) {
                    foreach ($validatedData['challenges'] as $challenges) {

                        $project->challenges()->create(
                            [
                                'en_challenge_name' => $challenges['en_challenge_name'],
                                'nl_challenge_name' => $challenges['nl_challenge_name'],
                                'en_challenge_description' => $challenges['en_challenge_description'],
                                'nl_challenge_description' => $challenges['nl_challenge_description'],

                            ]
                        );
                    }
                }
                if (!empty($validatedData['project_live_links'])) {
                    foreach ($validatedData['project_live_links'] as $project_live_links) {
                        $project->project_live_links()->create(
                            [
                                'link' => $project_live_links['link'],

                            ]
                        );
                    }
                }
                if (!empty($validatedData['project_technologies'])) {
                    foreach ($validatedData['project_technologies'] as $project_technologies) {
                        $project->project_technologies()->create(
                            [
                                'tools' => $project_technologies['tools'],
                            ]
                        );
                    }
                }
                if ($request->hasFile('image_path')) {
                    foreach ($request->file('image_path') as $file) {
                        if (!$file->isValid()) {
                            return "A";
                        }
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $filePath = $file->storeAs('project_images', $filename, 'public');
                        $project->project_images()->create([
                            'image_path' => $filePath
                        ]);
                    }
                }



                DB::commit();
                return response()->json([
                    'sucsess' => 1,
                    'result' => $project,
                    'message' => "Client With His project Stored Sucsessfully",
                ], 200);


                //  return redirect()->route('clients.index')->with('success', 'Client created successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => $e
                ], 200);
            }
        } else {
            // return "B";
            // if($request->input('client_id') === null) {
            $validatedDat = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:clients,email',
                'phone_number' => 'required',
                'projects' => 'array',
                'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'begin_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:begin_date',


            ]);
            if ($validatedDat->fails()) {

                return response()->json([
                    'sucsess' => 0,
                    'result' => null,
                    'message' => $validatedDat->errors(),
                ], 200);
            }



            DB::beginTransaction();

            try {
                $validatedData = $request->all();

                $client = Client::create([
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'email' => $validatedData['email'],
                    'phone_number' => $validatedData['phone_number'],
                ]);

                //    foreach ($validatedData['projects'] as $projectData) {
                $project = $client->projects()->create([
                    'client_id' => $client->id,
                    'en_title' => $validatedData['en_title'],
                    'nl_title' => $validatedData['nl_title'],
                    'en_description' => $validatedData['en_description'],
                    'nl_description' => $validatedData['nl_description'],
                    'begin_date' => Carbon::parse($validatedData['begin_date']),
                    'end_date' => Carbon::parse($validatedData['end_date']),
                    'en_result' => $validatedData['en_result'],
                    'nl_result' => $validatedData['nl_result'],
                ]);

                if (!empty($validatedData['service_categories'])) {
                    foreach ($validatedData['service_categories'] as $service_categories) {

                        $project->service_categories()->create(
                            [
                                'service_id' => $service_categories['service_id']

                            ]
                        );
                    }
                }

                if (!empty($validatedData['achievements'])) {
                    foreach ($validatedData['achievements'] as $achievements) {

                        $project->achievements()->create(
                            [
                                'en_achievement_name' => $achievements['en_achievement_name'],
                                'nl_achievement_name' => $achievements['nl_achievement_name'],
                                //   'en_how_we_achieved_it' => $achievements['en_how_we_achieved_it'],
                                //   'nl_how_we_achieved_it' => $achievements['nl_how_we_achieved_it'],

                            ]
                        );
                    }
                }

                if (!empty($validatedData['challenges'])) {
                    foreach ($validatedData['challenges'] as $challenges) {

                        $project->challenges()->create(
                            [
                                'en_challenge_name' => $challenges['en_challenge_name'],
                                'nl_challenge_name' => $challenges['nl_challenge_name'],
                                'en_challenge_description' => $challenges['en_challenge_description'],
                                'nl_challenge_description' => $challenges['nl_challenge_description'],

                            ]
                        );
                    }
                }
                if (!empty($validatedData['project_live_links'])) {
                    foreach ($validatedData['project_live_links'] as $project_live_links) {
                        $project->project_live_links()->create(
                            [
                                'link' => $project_live_links['link'],

                            ]
                        );
                    }
                }
                if (!empty($validatedData['project_technologies'])) {
                    foreach ($validatedData['project_technologies'] as $project_technologies) {
                        $project->project_technologies()->create(
                            [
                                'tools' => $project_technologies['tools'],
                            ]
                        );
                    }
                }
                if ($request->hasFile('image_path')) {
                    foreach ($request->file('image_path') as $file) {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $filePath = $file->storeAs('project_images', $filename, 'public');
                        $project->project_images()->create([
                            'image_path' => $filePath
                        ]);
                    }
                }


                DB::commit();
                return response()->json([
                    'sucsess' => 1,
                    'result' => $client,
                    'message' => "Client With His project Stored Sucsessfully",

                ], 200);

                //  return redirect()->route('clients.index')->with('success', 'Client created successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => $e
                ], 200);
            }
        }
    }
    public function addproject()
    {
        $clients = Client::all();
        $services = Service::all();
        return view('admin.Projects.test1', compact('clients', 'services'));
    }




    public function show(Request $request, $id)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        $project = Project::with(['client', 'service_categories', 'project_images', 'project_live_links', 'project_technologies', 'achievements', 'challenges'])->findOrFail($id);

        if (!$project) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }

        try {
            $begin = Carbon::parse($project->begin_date);
            $end = Carbon::parse($project->end_date);
            $diffInDays = $begin->diffInDays($end);
            //  $diffInMonth = $begin->diffInMonths($end);
            $diffForHumans = $begin->diffForHumans($end, ['syntax' => Carbon::DIFF_ABSOLUTE, 'parts' => 3]);


            $data = [
                'id' => $project->id,
                'title' => $locale == 'en' ? $project->en_title : $project->nl_title,
                'description' => $locale == 'en' ? $project->en_description : $project->nl_description,
                'time_in_days' => $diffInDays,
                'time' => $diffForHumans,
                'result' => $locale == 'en' ? $project->en_result : $project->nl_result,
            ];

            $client = $project->client()->get();
            $data['client']['first_name'] = $client[0]['first_name'];
            $data['client']['last_name'] = $client[0]['last_name'];
            $data['client']['email'] = $client[0]['email'];
            $data['client']['phone_number'] = $client[0]['phone_number'];
            $data['service_categories'] = $project->service_categories->map(function ($related) use ($locale) {
                $service=Service::findOrFail($related->service_id);
                return [
                    'servive_name' => $locale == 'en' ? $service->en_name : $service->nl_name,
                ];
            });

            $data['achievements'] = $project->achievements->map(function ($related) use ($locale) {
                return [
                    'achievement_name' => $locale == 'en' ? $related->en_achievement_name : $related->nl_achievement_name,
                    // 'description' => $locale == 'en' ? $related->en_description : $related->nl_description,
                ];
            });

            $data['project_technologies'] = $project->project_technologies->map(function ($related) use ($locale) {
                return [
                    'tools' => $related->tools,
                ];
            });
            $data['project_images'] = $project->project_images->map(function ($related) use ($locale) {
             //   $image=$project->project_images()->first();
              /*  $img=$image['image_path'];

                if($image){
                    $data['image']=
                       asset('storage/'.$img);

                }*/
                return [
                    'image_path' => asset('storage/'.$related->image_path)
                ];
            });

            $data['challenges'] = $project->challenges->map(function ($related) use ($locale) {
                return [
                    'challenge_name' => $locale == 'en' ? $related->en_challenge_name : $related->nl_challenge_name,
                    'challenge_description' => $locale == 'en' ? $related->en_challenge_description : $related->nl_challenge_description,
                ];
            });
            $data['project_live_links'] = $project->project_live_links->map(function ($related) use ($locale) {
                return [
                    'link' => $related->link,
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
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function view($id)
    {
        //  $local =App::getLocale();
        $language = App::getLocale();
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        try {
            $project = Project::with(['client', 'service_categories', 'project_images', 'project_live_links', 'project_technologies', 'achievements', 'challenges'])->findOrFail($id);

            if (!$project) {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('app.there_is_no_data')
                ], 200);
            }

            $data = [
                'id' => $project->id,
                'title' => $locale == 'en' ? $project->en_title : $project->nl_title,
                'description' => $locale == 'en' ? $project->en_description : $project->nl_description,
                'begin_date' => $project->begin_date,
                'end_date' => $project->end_date,
                'result' => $locale == 'en' ? $project->en_result : $project->nl_result,
            ];


            $data['project_images'] = $project->project_images->map(function ($related) use ($locale) {
                return [
                    'image_path' => $related->image_path,
                ];
            });


            $data['achievements'] = $project->achievements->map(function ($related) use ($locale) {
                return [
                    'achievement_name' => $locale == 'en' ? $related->en_achievement_name : $related->nl_achievement_name,
                    // 'description' => $locale == 'en' ? $related->en_description : $related->nl_description,
                ];
            });

            $data['project_technologies'] = $project->project_technologies->map(function ($related) use ($locale) {
                return [
                    'tools' => $related->tools,
                ];
            });

            $data['challenges'] = $project->challenges->map(function ($related) use ($locale) {
                return [
                    'challenge_name' => $locale == 'en' ? $related->en_challenge_name : $related->nl_challenge_name,
                    'challenge_description' => $locale == 'en' ? $related->en_challenge_description : $related->nl_challenge_description,
                ];
            });
            $data['project_live_links'] = $project->project_live_links->map(function ($related) use ($locale) {
                return [
                    'link' => $related->link,
                ];
            });

            return view('admin.Projects.viewproject', compact('data'));
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function store_image( Request $request,$project)
    {
        $latestProjectId = Project::latest()->first()->id;
        $validatedDat = Validator::make($request->all(), [
            'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validatedDat->fails()) {

            return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validatedDat->errors(),
            ], 200);
        }
        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('project_images', $filename, 'public');
               $project->project_images()->create([
                    'image_path' => $filePath,
          //          'project_id'=> $latestProjectId+1
                ]);
            }
        }
    }
}
