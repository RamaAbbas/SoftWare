<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Challenge;
use App\Models\Client;
use App\Models\ClientReview;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectLiveLinks;
use App\Models\ProjectService;
use App\Models\ProjectTechnology;
use App\Models\Service;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class ProjectController extends Controller
{


    public function index(Request $request)
    {
        $projects = Project::all();
        $groupedProjects = [];
        $result = [];
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;


        $process = $projects->map(function ($project) use ($locale) {

            $data = [
                'id' => $project->id,
                'title' => $locale == 'en' ? $project->en_title : $project->nl_title,
                'sub_title' => $locale == 'en' ? $project->en_sub_title : $project->nl_sub_title,
                'description' => $locale == 'en' ? $project->en_description : $project->nl_description,
                'duration' => $project->duration,
                'link' => $project->link,
                'main_image' => asset('storage/' . $project->main_image)

            ];
            $data['details'] = $project->project_details->map(function ($detail) use ($locale) {
                return  $locale == 'en' ? $detail->en_step : $detail->nl_step;
            });
            $data['services'] = $project->project_services->map(function ($service) use ($locale) {
                return  $locale == 'en' ? $service->en_name : $service->nl_name;
            });



            return $data;
        });



        return response()->json(
            [
                'success' => 1,
                'result' => $process,
                'message' => __('app.data_returnd_sucssesfully')
            ]
        );
    }

    public function show_all()
    {

        $language = App::getLocale();
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;
        $projects = Project::all();
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

        $validatedDat = Validator::make($request->all(), [
            'en_title' => 'required|string|max:255',
            'nl_title' => 'required|string|max:255',
            'en_sub_title' => 'nullable|string|max:255',
            'nl_sub_title' => 'nullable|string|max:255',
            'en_description' => 'nullable',
            'nl_description' => 'nullable',
            'link' => 'nullable',
            'duration' => 'nullable',
            'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_src' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);
        if ($validatedDat->fails()) {
            /*  return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $validatedDat->errors()
            ], 200);*/


            return redirect()->route('showall.projects')->with('error', $validatedDat->errors());
        }



        DB::beginTransaction();

        try {
            $validatedData = $request->all();

            if ($request->hasFile('main_image')) {
                $file = $request->main_image;
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('Project_images', $filename, 'public');

                $project = Project::create([
                    'en_title' => $request->en_title,
                    'nl_title' => $request->nl_title,
                    'en_sub_title' => $request->en_sub_title,
                    'nl_sub_title' => $request->nl_sub_title,
                    'en_description' => $request->en_description,
                    'nl_description' => $request->nl_description,
                    'link' => $request->link,
                    'duration' => $request->duration,
                    'main_image' => $filePath,
                ]);
            } else {
                $project = Project::create([
                    'en_title' => $request->en_title,
                    'nl_title' => $request->nl_title,
                    'en_sub_title' => $request->en_sub_title,
                    'nl_sub_title' => $request->nl_sub_title,
                    'en_description' => $request->en_description,
                    'nl_description' => $request->nl_description,
                    'link' => $request->link,
                    'duration' => $request->duration,
                ]);
            }

            if (!empty($validatedData['project_details'])) {
                foreach ($validatedData['project_details'] as $detail) {

                    $project->project_details()->create(
                        $detail
                    );
                }
            }
            /* if ($request->has('service_ids')) {
                foreach ($request->service_ids as $service_id) {
                  //  $service = Service::findOrFail($service_id);
                    $project->project_services()->create(
                        [
                            'en_name' =>$service_id ,
                           // 'nl_name' => $service->nl_name

                        ]
                    );
                }
            }*/
            $selectedServices = $request->input('service_ids');
            $enNames = $request->input('en_names');
            $nlNames = $request->input('nl_names');

            foreach ($selectedServices as $service) {
                //  $enName = $enNames[$service];
                //  $nlName = $enNames[$service];

                $project->project_services()->create(
                    [
                        'en_name' => $enNames[$service],
                        'nl_name' => $nlNames[$service]

                    ]
                );
            }


            if (!empty($validatedData['achievements'])) {
                foreach ($validatedData['achievements'] as $achievement) {
                    if ($achievement) {
                        $achievements = $project->achievements()->create(
                            $achievement
                        );

                        if (!empty($achievement['achievement_details'])) {
                            foreach ($achievement['achievement_details'] as $achievement_details) {

                                $achievements->achievement_details()->create($achievement_details);
                            }
                        }
                    }
                }
            }
            if (!empty($validatedData['challenges'])) {
                foreach ($validatedData['challenges'] as $challenges) {
                    if ($challenges) {
                        $challenge = $project->challenges()->create(
                            $challenges
                        );

                        if (!empty($challenges['challenges_details'])) {
                            foreach ($challenges['challenges_details'] as $challenge_details) {

                                $challenge->challenges_details()->create($challenge_details);
                            }
                        }
                    }
                }
            }
            if (!empty($validatedData['results'])) {
                foreach ($validatedData['results'] as $results) {
                    if ($results) {
                        $result = $project->results()->create(
                            $results
                        );

                        if (!empty($results['result_details'])) {
                            foreach ($results['result_details'] as $result_details) {

                                $result->result_details()->create($result_details);
                            }
                        }
                    }
                }
            }
            if ($request->client_id) {
                $client = Client::findOrFail($request->client_id);
                $project->client()->create([
                    'en_title' => $client->en_title,
                    'nl_title' => $client->nl_title,
                    'en_sub_title' => $client->en_sub_title,
                    'nl_sub_title' => $client->nl_sub_title,
                    'full_name' => $client->full_name,
                    'email' => $client->email,
                    'phone_number' => $client->phone_number,
                    'position' => $client->position

                ]);
            } else {
                //    return "ddd";
                $project->client()->create([
                    'en_title' => $request->c_en_title,
                    'nl_title' => $request->c_nl_title,
                    'en_sub_title' => $request->c_en_sub_title,
                    'nl_sub_title' => $request->c_nl_sub_title,
                    'full_name' => $request->full_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'position' => $request->position

                ]);
            }


            if ($request->hasFile('image_src')) {
                $file = $request->image_src;
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('Project_images', $filename, 'public');

                $project->client_review()->create([
                    'en_title' => $request->r_en_title,
                    'nl_title' => $request->r_nl_title,
                    'en_sub_title' => $request->r_en_sub_title,
                    'nl_sub_title' => $request->r_nl_sub_title,
                    'en_review' => $request->en_review,
                    'nl_review' => $request->nl_review,
                    'image_src' => $filePath,
                ]);
            } else {
                $project->client_review()->create([
                    'en_title' => $request->r_en_title,
                    'nl_title' => $request->r_nl_title,
                    'en_sub_title' => $request->r_en_sub_title,
                    'nl_sub_title' => $request->r_nl_sub_title,
                    'en_review' => $request->en_review,
                    'nl_review' => $request->nl_review,
                    // 'image_src' => $filePath,
                ]);
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
            /* return response()->json([
                'success' => 1,
                'result' => $project,
                'message' => ""
            ], 200);*/

            return redirect()->route('showall.projects')->with('sucsess', "Client With His project Stored Sucsessfully");


            //  return redirect()->route('clients.index')->with('success', 'Client created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            /* return response()->json([
                'success' => 0,
                'result' => "",
                'message' => $e
            ], 200);*/
            return redirect()->route('showall.projects')->with('error', $e);
        }
    }
    public function addproject()
    {
        /*  $clients = DB::table('clients')
        ->select('id','full_name') // You can select additional fields as needed
        ->distinct()
        ->get();*/

        /*  $clients = DB::table('clients')
            ->select('email', DB::raw('MIN(id) as id'))  // or use MAX(id) as needed
            ->groupBy('email')
            ->get();*/
        $clients = DB::table('project_clients as u1')
            ->select('u1.email', 'u1.full_name', 'u1.id')
            ->join(DB::raw('(SELECT email, MIN(id) as min_id FROM project_clients GROUP BY email) as u2'), function ($join) {
                $join->on('u1.id', '=', 'u2.min_id');
            })
            ->get();
        // return $clients;
        /* $clients = Client::select('email', 'full_name')
            ->groupBy('email')
            ->get();*/
        //Client::all();
        $services = Service::select('services.*')->distinct()->get();
        return view('admin.Projects.newform', compact('clients', 'services'));
    }




    public function show(Request $request, $id)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        $project = Project::findOrFail($id);

        if (!$project) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }

        try {



            $data = [
                'id' => $project->id,
                'title' => $locale == 'en' ? $project->en_title : $project->nl_title,
                'sub_title' => $locale == 'en' ? $project->en_sub_title : $project->nl_sub_title,
                'duration' => $project->duration,
                'link' => $project->link,
                'main_image' => asset('storage/' . $project->main_image),
                'description' => $locale == 'en' ? $project->en_description : $project->nl_description,
                // 'client'=>$project->client['full_name'],

            ];
            $data['details'] = $project->project_details->map(function ($detail) use ($locale) {
                if ($locale == 'en') {
                    return $detail->en_step;
                } else {
                    return $detail->nl_step;
                }
            });
            $data['services'] = $project->project_services->map(function ($service) use ($locale) {
                return  $locale == 'en' ? $service->en_name : $service->nl_name;
            });

            $data['images'] = $project->project_images->map(function ($image) use ($locale) {
                return  asset('storage/' . $image->image_path);
            });

            //  $project->en_description : $project->nl_description,
            $client = $project->client;
            if ($project->client['en_title'] && $locale == 'en') {
                $data['client']['title'] = $project->client['en_title'];
            } else {
                $data['client']['title'] = $project->client['nl_title'];
            }
            if ($project->client['en_sub_title'] && $locale == 'en') {
                $data['client']['sub_title'] = $project->client['en_sub_title'];
            } else {
                $data['client']['sub_title'] = $project->client['nl_sub_title'];
            }
            $data['client']['full_name'] = $project->client['full_name'];
            $data['client']['position'] = $project->client['position'];
            $data['client']['email'] = $project->client['email'];
            $data['client']['phone_number'] = $project->client['phone_number'];


            $achievement = $project->achievements->first();
            if ($achievement) {
                $data['achievements']['title'] = $locale == 'en' ? $achievement->en_title : $achievement->nl_title;
                $data['achievements']['sub_title'] = $locale == 'en' ? $achievement->en_sub_title : $achievement->nl_sub_title;
                $data['achievements']['description'] = $locale == 'en' ? $achievement->en_description : $achievement->nl_description;
                $data['achievements']['more_details'] = $achievement->achievement_details->map(function ($detail) use ($locale) {

                    if ($locale == 'en') {
                        return $detail->en_step;
                    } else {
                        return $detail->nl_step;
                    }
                });
            } else {
                $data['achievements'] = [];
            }







            $challenge = $project->challenges->first();
            if ($challenge) {
                $data['challenges']['title'] = $locale == 'en' ? $challenge->en_title : $challenge->nl_title;
                $data['challenges']['sub_title'] = $locale == 'en' ? $challenge->en_sub_title : $challenge->nl_sub_title;
                $data['challenges']['description'] = $locale == 'en' ? $challenge->en_description : $challenge->nl_description;
                $data['challenges']['more_details'] = $challenge->challenges_details->map(function ($detail) use ($locale) {
                    if ($locale == 'en') {
                        return $detail->en_step;
                    } else {
                        return $detail->nl_step;
                    }
                });
            } else {
                $data['challenges'] = [];
            }




            $result = $project->results->first();
            if ($result) {
                $data['results']['title'] = $locale == 'en' ? $result->en_title : $result->nl_title;
                $data['results']['sub_title'] = $locale == 'en' ? $result->en_sub_title : $result->nl_sub_title;
                $data['results']['description'] = $locale == 'en' ? $result->en_description : $result->nl_description;
                $data['results']['more_details'] = $result->result_details->map(function ($detail) use ($locale) {
                    if ($locale == 'en') {
                        return $detail->en_step;
                    } else {
                        return $detail->nl_step;
                    }
                });
            } else {
                $data['results'] = [];
            }


            $data['client_review']['title'] = $locale == 'en' ? $project->client_review['en_title'] : $project->client_review['nl_title'];
            $data['client_review']['sub_title'] = $locale == 'en' ?  $project->client_review['en_sub_title'] : $project->client_review['nl_sub_title'];
            $data['client_review']['client_image'] = asset('storage/' .  $project->client_review['image_src']);
            $data['client_review']['review'] = $locale == 'en' ?  $project->client_review['en_review'] : $project->client_review['nl_review'];






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
            $project = Project::findOrFail($id);

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
                'sub_title' => $locale == 'en' ? $project->en_sub_title : $project->nl_sub_title,
                'duration' => $project->duration,
                'link' => $project->link,
                'main_image' => $project->main_image,
                'description' => $locale == 'en' ? $project->en_description : $project->nl_description,
                // 'client'=>$project->client['full_name'],

            ];
            $data['details'] = $project->project_details->map(function ($detail) use ($locale) {
                if ($locale == 'en') {
                    return ['step' => $detail->en_step];
                } else {
                    return ['step' => $detail->nl_step];
                }
            });
            $data['services'] = $project->project_services->map(function ($service) use ($locale) {
                return  $locale == 'en' ? $service->en_name : $service->nl_name;
            });

            $data['images'] = $project->project_images->map(function ($image) use ($locale) {
                return [
                    'image_path' => $image->image_path
                ];
            });

            //  $project->en_description : $project->nl_description,
            $client = $project->client;
            if ($project->client['en_title'] && $locale == 'en') {
                $data['client']['title'] = $project->client['en_title'];
            } else {
                $data['client']['title'] = $project->client['nl_title'];
            }
            if ($project->client['en_sub_title'] && $locale == 'en') {
                $data['client']['sub_title'] = $project->client['en_sub_title'];
            } else {
                $data['client']['sub_title'] = $project->client['nl_sub_title'];
            }
            $data['client']['full_name'] = $project->client['full_name'];
            $data['client']['position'] = $project->client['position'];
            $data['client']['email'] = $project->client['email'];
            $data['client']['phone_number'] = $project->client['phone_number'];


            $achievement = $project->achievements->first();
            if ($achievement) {
                $data['achievements']['title'] = $locale == 'en' ? $achievement->en_title : $achievement->nl_title;
                $data['achievements']['sub_title'] = $locale == 'en' ? $achievement->en_sub_title : $achievement->nl_sub_title;
                $data['achievements']['description'] = $locale == 'en' ? $achievement->en_description : $achievement->nl_description;
                $data['achievements']['more_details'] = $achievement->achievement_details->map(function ($detail) use ($locale) {

                    if ($locale == 'en') {
                        return ['step' => $detail->en_step];
                    } else {
                        return ['step' => $detail->nl_step];
                    }
                });
            } else {
                $data['achievements'] = [];
            }







            $challenge = $project->challenges->first();
            if ($challenge) {
                $data['challenges']['title'] = $locale == 'en' ? $challenge->en_title : $challenge->nl_title;
                $data['challenges']['sub_title'] = $locale == 'en' ? $challenge->en_sub_title : $challenge->nl_sub_title;
                $data['challenges']['description'] = $locale == 'en' ? $challenge->en_description : $challenge->nl_description;
                $data['challenges']['more_details'] = $challenge->challenges_details->map(function ($detail) use ($locale) {
                    if ($locale == 'en') {
                        return ['step' => $detail->en_step];
                    } else {
                        return ['step' => $detail->nl_step];
                    }
                });
            } else {
                $data['challenges'] = [];
            }




            $result = $project->results->first();
            if ($result) {
                $data['results']['title'] = $locale == 'en' ? $result->en_title : $result->nl_title;
                $data['results']['sub_title'] = $locale == 'en' ? $result->en_sub_title : $result->nl_sub_title;
                $data['results']['description'] = $locale == 'en' ? $result->en_description : $result->nl_description;
                $data['results']['more_details'] = $result->result_details->map(function ($detail) use ($locale) {
                    if ($locale == 'en') {
                        return ['step' => $detail->en_step];
                    } else {
                        return ['step' => $detail->nl_step];
                    }
                });
            } else {
                $data['results'] = [];
            }


            $data['client_review']['title'] = $locale == 'en' ? $project->client_review['en_title'] : $project->client_review['nl_title'];
            $data['client_review']['sub_title'] = $locale == 'en' ?  $project->client_review['en_sub_title'] : $project->client_review['nl_sub_title'];
            $data['client_review']['client_image'] =   $project->client_review['image_src'];
            $data['client_review']['review'] = $locale == 'en' ?  $project->client_review['en_review'] : $project->client_review['nl_review'];




            return view('admin.Projects.viewproject', compact('data'));
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function store_image(Request $request, $project)
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


    public function edit($id)
    {
        $project = Project::with('project_services')->findOrFail($id);
        $client = $project->client()->get();
        $clientreview = $project->client_review->get();
        $selectedServiceCategories = $project->project_services->pluck('id')->toArray();
        $selectedServices = $project->project_services->pluck('en_name')->toArray();
        $services = Service::all();

        $projectServices = $project->project_services->pluck('en_name')->toArray();
        if ($project) {
            return view('admin.Projects.new_edit_form', compact('project', 'client', 'services', 'selectedServiceCategories', 'selectedServices', 'clientreview', 'projectServices'));
        } else {

            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {

        $validatedDat = Validator::make($request->all(), [
            'en_title' => 'required|string|max:255',
            'nl_title' => 'required|string|max:255',
            'en_sub_title' => 'nullable|string|max:255',
            'nl_sub_title' => 'nullable|string|max:255',
            'en_description' => 'nullable',
            'nl_description' => 'nullable',
            'link' => 'nullable',
            'duration' => 'nullable',
            'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_src' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);
        $pro = Project::findOrFail($id);
        if ($validatedDat->fails()) {
            return redirect()->route('project.edit', $pro->id)->with('error', $validatedDat->errors());
        }



        DB::beginTransaction();

        try {
            $validatedData = $request->all();
            $project = Project::findOrFail($id);
            /*
                  'en_title' => $request->en_title,
                    'nl_title' => $request->nl_title,
                    'en_sub_title' => $request->en_sub_title,
                    'nl_sub_title' => $request->nl_sub_title,
                    'en_description' => $request->en_description,
                    'nl_description' => $request->nl_description,
                    'link' => $request->link,
                    'duration' => $request->duration, */
            if ($project) {
                $project->en_title =  $request->en_title;
                $project->nl_title =  $request->nl_title;
                $project->en_sub_title =  $request->en_sub_title;
                $project->nl_sub_title = $request->nl_sub_title;
                $project->en_description =  $request->en_description;
                $project->nl_description = $request->nl_description;
                $project->link = $request->link;
                $project->duration = $request->duration;

                if ($request->hasFile('main_image')) {
                    $file = $request->main_image;
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('Project_images', $filename, 'public');
                    $project->main_image = $filePath;
                } else {
                    // $project->main_image=$project->main_image;
                }


                $project->save();



                $existingDetailIds4 = collect($request->input('project_details'))
                    ->filter(function ($detail) {
                        return isset($detail['id']);
                    })
                    ->pluck('id')
                    ->toArray();
                foreach ($request->input('project_details') as $detailData) {
                    if (isset($detailData['id'])) {
                        $existingDetail = $project->project_details()->find($detailData['id']);
                        if ($existingDetail) {
                            $existingDetail->update([
                                'en_step' => $detailData['en_step'],
                                'nl_step' => $detailData['nl_step'],
                            ]);
                        }
                    } else {
                        $newDetail = $project->project_details()->create([
                            'en_step' => $detailData['en_step'],
                            'nl_step' => $detailData['nl_step'],
                        ]);
                        $existingDetailIds4[] = $newDetail->id;
                    }
                }

                $project->project_details()->whereNotIn('id', $existingDetailIds4)->delete();


                ProjectService::where('project_id', $project->id)->delete();
                if ($request->has('service_ids')) {
                    foreach ($request->service_ids as $service_id) {
                        $service = Service::findOrFail($service_id);
                        $project->project_services()->create(
                            [
                                'en_name' => $service->en_name,
                                'nl_name' => $service->nl_name

                            ]
                        );
                    }
                }

                ////////////////////////////////////////////Ach
                $ach = $project->achievements()->first();
                $ach->update([
                    'en_title' => $request->input('achievements.0.en_title'),
                    'nl_title' => $request->input('achievements.0.nl_title'),
                    'en_sub_title' => $request->input('achievements.0.en_sub_title'),
                    'nl_sub_title' => $request->input('achievements.0.nl_sub_title'),
                    'en_description' => $request->input('achievements.0.en_description'),
                    'nl_description' => $request->input('achievements.0.nl_description'),

                ]);

                $existingDetails1 = collect($request->input('achievements.0.achievement_details'));
                $existingDetailIds3 = collect($request->input('achievements.0.achievement_details'))
                    ->filter(function ($detail) {
                        return isset($detail['id']);
                    })
                    ->pluck('id')
                    ->toArray();


                foreach ($existingDetails1 as $index => $detailData) {
                    if (isset($detailData['id'])) {

                        $resultDetail = $ach->achievement_details()->find($detailData['id']);
                        $resultDetail->update([
                            'en_step' => $detailData['en_step'],
                            'nl_step' => $detailData['nl_step'],
                        ]);
                    } else {


                        $newDetail = $ach->achievement_details()->create([
                            'en_step' => $detailData['en_step'],
                            'nl_step' => $detailData['nl_step'],
                        ]);
                        $existingDetailIds3[] = $newDetail->id;
                    }
                }
                $actDetailsToDelete = $ach->achievement_details()->whereNotIn('id', $existingDetailIds3)->get();
                foreach ($actDetailsToDelete as $detail) {
                    $detail->delete();
                }



                ////////////////////Cha
                $cha = $project->challenges()->first();
                $cha->update([
                    'en_title' => $request->input('challenges.0.en_title'),
                    'nl_title' => $request->input('challenges.0.nl_title'),
                    'en_sub_title' => $request->input('challenges.0.en_sub_title'),
                    'nl_sub_title' => $request->input('challenges.0.nl_sub_title'),
                    'en_description' => $request->input('challenges.0.en_description'),
                    'nl_description' => $request->input('challenges.0.nl_description'),
                ]);

                $existingDetails2 = collect($request->input('challenges.0.challenges_details'));
                // $existingIds2 = $existingDetails2->pluck('id')->filter();
                $existingDetailIds2 = collect($request->input('challenges.0.challenges_details'))
                    ->filter(function ($detail) {
                        // Only keep items that have an ID (existing details)
                        return isset($detail['id']);
                    })
                    ->pluck('id')
                    ->toArray();


                foreach ($existingDetails2 as $index => $detailData) {
                    if (isset($detailData['id'])) {

                        $resultDetail = $cha->challenges_details()->find($detailData['id']);
                        $resultDetail->update([
                            'en_step' => $detailData['en_step'],
                            'nl_step' => $detailData['nl_step'],
                        ]);
                    } else {

                        $newDetail =  $cha->challenges_details()->create([
                            'en_step' => $detailData['en_step'],
                            'nl_step' => $detailData['nl_step'],
                        ]);
                        $existingDetailIds2[] = $newDetail->id;
                    }
                }
                $resultDetailsToDelete2 = $cha->challenges_details()->whereNotIn('id', $existingDetailIds2)->get();
                foreach ($resultDetailsToDelete2 as $detail) {
                    $detail->delete();
                }

                //////////////////////////////////Res
                $result = $project->results()->first();
                $result->update([
                    'en_title' => $request->input('results.0.en_title'),
                    'nl_title' => $request->input('results.0.nl_title'),
                    'en_sub_title' => $request->input('results.0.en_sub_title'),
                    'nl_sub_title' => $request->input('results.0.nl_sub_title'),
                    'en_description' => $request->input('results.0.en_description'),
                    'nl_description' => $request->input('results.0.nl_description'),
                ]);

                $existingDetails = collect($request->input('results.0.result_details'));
                // $existingIds = $existingDetails->pluck('id')->filter();
                $existingDetailIds = collect($request->input('results.0.result_details'))
                    ->filter(function ($detail) {
                        // Only keep items that have an ID (existing details)
                        return isset($detail['id']);
                    })
                    ->pluck('id')
                    ->toArray();

                foreach ($existingDetails as $index => $detailData) {
                    if (isset($detailData['id'])) {

                        $resultDetail = $result->result_details()->find($detailData['id']);
                        $resultDetail->update([
                            'en_step' => $detailData['en_step'],
                            'nl_step' => $detailData['nl_step'],
                        ]);
                    } else {

                        $newDetail = $result->result_details()->create([
                            'en_step' => $detailData['en_step'],
                            'nl_step' => $detailData['nl_step'],
                        ]);
                        $existingDetailIds[] = $newDetail->id;
                    }
                }
                $resultDetailsToDelete = $result->result_details()->whereNotIn('id', $existingDetailIds)->get();
                foreach ($resultDetailsToDelete as $detail) {
                    $detail->delete();
                }
                ////////////////////
                $selectedEnNames = $request->input('services');
                $enNames = $request->input('en_names');
                $nlNames = $request->input('nl_names');


                $project->project_services()->delete();


                foreach ($selectedEnNames as $enName) {

                    $project->project_services()->create(
                        [
                            'en_name' => $enNames[$enName],
                            'nl_name' => $nlNames[$enName]

                        ]
                    );
                }









                //  ProjectImage::where('project_id', $project->id)->delete();
                if ($request->has('remove_images')) {
                    $removeImages = $request->input('remove_images');
                    foreach ($removeImages as $imageId) {
                        $image = ProjectImage::findOrFail($imageId);

                        Storage::delete('public/' . $image->path);

                        $image->delete();
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

                $pi = $project->client_review->get();
                $i = $project->client_review['image_src'];
                ClientReview::where('project_id', $project->id)->delete();

                if ($request->hasFile('image_src')) {
                    $file = $request->image_src;
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('Project_images', $filename, 'public');

                    $project->client_review()->create([
                        'en_title' => $request->r_en_title,
                        'nl_title' => $request->r_nl_title,
                        'en_sub_title' => $request->r_en_sub_title,
                        'nl_sub_title' => $request->r_nl_sub_title,
                        'en_review' => $request->en_review,
                        'nl_review' => $request->nl_review,
                        'image_src' => $filePath,
                    ]);
                } else {
                    $project->client_review()->create([
                        'en_title' => $request->r_en_title,
                        'nl_title' => $request->r_nl_title,
                        'en_sub_title' => $request->r_en_sub_title,
                        'nl_sub_title' => $request->r_nl_sub_title,
                        'en_review' => $request->en_review,
                        'nl_review' => $request->nl_review,
                        'image_src' => $i,
                    ]);
                }



                DB::commit();
                return redirect()->route('showall.projects')->with('success', 'Project Updated successfully!');
            }
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('showall.projects')->with('error', 'Project Updated faild!');
        }
    }

    public function destroy($id)
    {
        $aboutus = Project::findOrFail($id);
        if ($aboutus) {
            $aboutus->delete();
            return redirect()->route('showall.projects')->with('success', "Project Deleted Sucsessfully");
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
}
