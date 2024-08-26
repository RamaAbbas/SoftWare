<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index() {}
    public function store(Request $request)
    {
        $validatedDat = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone_number' => 'required',
            'projects' => 'array',


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

            foreach ($validatedData['projects'] as $projectData) {
                $project = $client->projects()->create([
                    'en_title' => $projectData['en_title'],
                    'nl_title' => $projectData['nl_title'],
                    'en_description' => $projectData['en_description'],
                    'nl_description' => $projectData['nl_description'],
                    //   'begin_date' => $projectData['begin_date'],
                    //   'end_date' => $projectData['end_date'],
                    'en_result' => $projectData['en_result'],
                    'nl_result' => $projectData['nl_result'],
                ]);

                if (!empty($projectData['service_categories'])) {
                    foreach ($projectData['service_categories'] as $service_categories) {

                        $project->service_categories()->create(
                            [
                                'en_service_name' => $service_categories['en_service_name'],
                                'nl_service_name' => $service_categories['nl_service_name'],

                            ]
                        );
                    }
                }

                if (!empty($projectData['achievements'])) {
                    foreach ($projectData['achievements'] as $achievements) {

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

                if (!empty($projectData['challenges'])) {
                    foreach ($projectData['challenges'] as $challenges) {

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
                if (!empty($projectData['project_live_links'])) {
                    foreach ($projectData['project_live_links'] as $project_live_links) {
                        $project->project_live_links()->create(
                            [
                                'link' => $project_live_links['link'],

                            ]
                        );
                    }
                }
                if (!empty($projectData['project_technologies'])) {
                    foreach ($projectData['project_technologies'] as $project_technologies) {
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
