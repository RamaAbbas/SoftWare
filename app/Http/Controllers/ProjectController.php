<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $validatedDat = Validator::make($request->all(), [
            'en_title' => 'required|string|max:255',
            'nl_title' => 'required|string|max:255',
            'en_description' => 'required',
            'nl_description' => 'required',
            'en_result' => 'required',
            'nl_result' => 'required',
         //   'begin_date' => 'required',
         //   'end_date' => 'required',


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
                //   'begin_date' => $validatedData['begin_date'],
                //   'end_date' => $validatedData['end_date'],
                'en_result' => $validatedData['en_result'],
                'nl_result' => $validatedData['nl_result'],
            ]);

            if (!empty($validatedData['service_categories'])) {
                foreach ($validatedData['service_categories'] as $service_categories) {

                    $project->service_categories()->create(
                        [
                            'en_service_name' => $service_categories['en_service_name'],
                            'nl_service_name' => $service_categories['nl_service_name'],

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

            /*  if (!empty($projectData['project_images'])) {
                    foreach ($projectData['project_images'] as $project_images) {
                        foreach ($project_images as $a) {

                            if ($a->hasFile('image_path')) {
                                $filename = time() . '_' . $a->image_path->getClientOriginalName();
                                $filePath = $a->image_path->storeAs('images', $filename, 'public');

                                $project->project_images()->create(
                                    [
                                        'image_path' => $filePath,
                                    ]
                                );
                            }
                        }
                    }
                }*/

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
    }

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

                $data = [
                    'id' => $project->id,
                    'title' => $locale == 'en' ? $project->en_title : $project->nl_title,
                    'description' => $locale == 'en' ? $project->en_description : $project->nl_description,
                    'begin_date' => $project->begin_date,
                    'end_date' => $project->end_date,
                    'result' => $locale == 'en' ? $project->en_result : $project->nl_result,
                ];
                //  $data['client'] = $project->withOnly('client:id,first_name');
                $data['client'] = $project->client()->get(); //->only(['first_name','last_name','email']);//->client()->get(); //pluck(['first_name']);

                $data['service_categories'] = $project->service_categories->map(function ($related) use ($locale) {
                    return [
                        'servive_name' => $locale == 'en' ? $related->en_service_name : $related->nl_service_name,
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
}
