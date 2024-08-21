<?php

namespace App\Http\Controllers;

use App\Models\BenefitsForWho;
use App\Models\HowItWork;
use App\Models\Requirment;
use App\Models\Service;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{

    public function index(Request $request)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        $services = Service::with(['requirment', 'service_benefits', 'service_processs'])->get();

        if ($services->isEmpty()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }

        try {
            $processedServices = $services->map(function ($service) use ($locale, $defaultLanguage) {

                if (is_string($service->description)) {
                    $description = json_decode($service->description, true);
                    $service->description = $description[$locale] ?? $description[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($service->call_to_action)) {
                    $call_to_action = json_decode($service->call_to_action, true);
                    $service->call_to_action = $call_to_action[$locale] ?? $call_to_action[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($service->client_testimonial)) {
                    $client_testimonial = json_decode($service->client_testimonial, true);
                    $service->client_testimonial = $client_testimonial[$locale] ?? $client_testimonial[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($service->name)) {
                    $name = json_decode($service->name, true);
                    $service->name = $name[$locale] ?? $name[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($service->title_of_requirements)) {
                    $title_of_requirements = json_decode($service->title_of_requirements, true);
                    $service->title_of_requirements = $title_of_requirements[$locale] ?? $title_of_requirements[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($service->title_of_how_it_works)) {
                    $title_of_how_it_works = json_decode($service->title_of_how_it_works, true);
                    $service->title_of_how_it_works = $title_of_how_it_works[$locale] ?? $title_of_how_it_works[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($service->title_of_service_benefit)) {
                    $title_of_service_benefit = json_decode($service->title_of_service_benefit, true);
                    $service->title_of_service_benefit = $title_of_service_benefit[$locale] ?? $title_of_service_benefit[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($service->for_who)) {
                    $for_who = json_decode($service->for_who, true);
                    $service->for_who = $for_who[$locale] ?? $for_who[$defaultLanguage] ?? __('app.lang_not_supported');
                }




                $service->service_benefits = $service->service_benefits->map(function ($related) use ($locale, $defaultLanguage) {
                    if (is_string($related->benefit_name)) {
                        $name = json_decode($related->benefit_name, true);
                        $related->benefit_name = $name[$locale] ?? $name[$defaultLanguage] ?? __('app.lang_not_supported');
                    }
                    if (is_string($related->benefit_description)) {
                        $description = json_decode($related->benefit_description, true);
                        $related->benefit_description = $description[$locale] ?? $description[$defaultLanguage] ?? __('app.lang_not_supported');
                    }
                    return $related;
                });


                $service->service_processs = $service->service_processs->map(function ($related) use ($locale, $defaultLanguage) {

                    if (is_string($related->name)) {
                        $stepName = json_decode($related->name, true);
                        $related->name = $stepName[$locale] ?? $stepName[$defaultLanguage] ?? __('app.lang_not_supported');
                    }
                    /* if (is_string($related->description)) {
                        $stepDescription = json_decode($related->description, true);
                        $related->description = $stepDescription[$locale] ?? $stepDescription[$defaultLanguage] ?? __('app.lang_not_supported');
                    }*/
                    if (is_string($related->description)) {
                        $desc = json_decode($related->description);
                        $description = json_decode($desc);
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
                        }, $description);
                        $related->description = $a;
                    }

                    return $related;
                });
                $service->requirment = $service->requirment->map(function ($related) use ($locale, $defaultLanguage) {
                    if (is_string($related->name)) {
                        $requirment = json_decode($related->name, true);
                        $related->name = $requirment[$locale] ?? $requirment[$defaultLanguage] ?? __('app.lang_not_supported');
                    }
                    if (is_string($related->descripton)) {
                        $requirment = json_decode($related->descripton, true);
                        $related->descripton = $requirment[$locale] ?? $requirment[$defaultLanguage] ?? __('app.lang_not_supported');
                    }

                    return $related;
                });


                return $service;
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


    ///////////////////////////////////////////////////////////////
    public function show_all()
    {
        $user = Auth::user()->id;
        error_log($user);
        $services = Service::all();
        return view('admin.Service.service', compact('services'));
    }

    public function store(Request $request)
    {
        /*$validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|json',
            'call_to_action' => 'required|json',
            'client_testimonial' => 'required|json',
            'cost' => 'required',
            'requirment' => 'array',
            'requirment.*.name' => 'required',
            'requirment.*.description' => 'required',
            'service_benefits' => 'array',
            'service_benefits.*.benefit_name' => 'required',
            'service_benefits.*.benefit_description' => 'required',
            'service_processs' => 'array',
            'service_processs.*.name' => 'required',
            'service_processs.*.description' => 'required',
            'service_processs.*.step_no' => 'required',
        ]);*/
        $validatedDat = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required|json',
            'call_to_action' => 'required',
            'client_testimonial' => 'required',
            'cost' => 'required',
            'requirment' => 'array',
            'title_of_requirements' => 'required',
            //'requirment.*.name' => 'required',
            //  'requirment.description' => 'required',
            'service_benefits' => 'array',
            // 'service_benefits.benefit_name' => 'required',
            // 'service_benefits.benefit_description' => 'required',
            //  'service_processs' => 'array',
            // 'service_processs.name' => 'required',
            // 'service_processs.description' => 'required',
            // 'service_processs.step_no' => 'required',
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
            // return $validatedData ;

            $service = Service::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'call_to_action' => $validatedData['call_to_action'],
                'client_testimonial' => $validatedData['client_testimonial'],
                'cost' => $validatedData['cost'],
                'title_of_requirements' => $validatedData['title_of_requirements']

            ]);

            if (isset($validatedData['requirment'])) {
                foreach ($validatedData['requirment'] as $relatedData) {

                    $service->requirment()->create($relatedData);
                }
            }

            if (isset($validatedData['service_benefits'])) {
                foreach ($validatedData['service_benefits'] as $relatedData) {
                    $service->service_benefits()->create($relatedData);
                }
            }

            if (isset($validatedData['service_processs'])) {
                foreach ($validatedData['service_processs'] as $relatedData) {
                    //return $relatedData;
                    $service->service_processs()->create($relatedData);
                }
            }

            DB::commit();

            return response()->json([
                'sucsess' => 1,
                'result' => $service,
                'message' => __('app.servive_stored_sucsessfully'),
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





    public function addservice()
    {
        return view('admin.Service.add');
    }



    public function show($id, Request $request)
    {
        $language = $request->header('Accept-Language');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        try {
            $service = Service::with(['requirment', 'service_benefits', 'service_processs'])->findOrFail($id);

            if (!$service) {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('app.there_is_no_data')
                ], 200);
            }


            if (is_string($service->description)) {
                $description = json_decode($service->description, true);
                $service->description = $description[$locale] ?? $description[$defaultLanguage] ?? __('app.lang_not_supported');
            }
            if (is_string($service->call_to_action)) {
                $description = json_decode($service->call_to_action, true);
                $service->call_to_action = $description[$locale] ?? $description[$defaultLanguage] ?? __('app.lang_not_supported');
            }
            if (is_string($service->client_testimonial)) {
                $description = json_decode($service->client_testimonial, true);
                $service->client_testimonial = $description[$locale] ?? $description[$defaultLanguage] ?? __('app.lang_not_supported');
            }
            if (is_string($service->name)) {
                $name = json_decode($service->name, true);
                $service->name = $name[$locale] ?? $name[$defaultLanguage] ?? __('app.lang_not_supported');
            }
            if (is_string($service->title_of_requirements)) {
                $title_of_requirements = json_decode($service->title_of_requirements, true);
                $service->title_of_requirements = $title_of_requirements[$locale] ?? $title_of_requirements[$defaultLanguage] ?? __('app.lang_not_supported');
            }




            $service->requirment = $service->requirment->map(function ($related) use ($locale, $defaultLanguage) {
                if (is_string($related->descripton)) {
                    $description = json_decode($related->descripton, true);
                    $related->descripton = $description[$locale] ?? $description[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($related->name)) {
                    $description = json_decode($related->name, true);
                    $related->name = $description[$locale] ?? $description[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                return $related;
            });


            $service->service_benefits = $service->service_benefits->map(function ($related) use ($locale, $defaultLanguage) {
                if (is_string($related->benefit_name)) {
                    $name = json_decode($related->benefit_name, true);
                    $related->translated_text_b = $name[$locale] ?? $name[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($related->benefit_description)) {
                    $description = json_decode($related->benefit_description, true);
                    $related->translated_text_c = $description[$locale] ?? $description[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                return $related;
            });


            $service->service_processs = $service->service_processs->map(function ($related) use ($locale, $defaultLanguage) {
                if (is_string($related->name)) {
                    $stepName = json_decode($related->name, true);
                    $related->translated_text_b = $stepName[$locale] ?? $stepName[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                if (is_string($related->description)) {
                    $stepDescription = json_decode($related->description_of_step, true);
                    $related->translated_text_c = $stepDescription[$locale] ?? $stepDescription[$defaultLanguage] ?? __('app.lang_not_supported');
                }
                return $related;
            });

            return response()->json([
                'success' => 1,
                'result' => $service,
                'message' => __('app.service_returned_sucsessfully')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function edit($id)
    {
        $service = Service::findOrFail($id);
        if ($service) {
            return view('admin.Service.edit', compact('service'));
        } else {

            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'requirments' => 'required',
            "coast" => 'required|decimal:2',
            "for_whom" => 'required|string',
        ]);
        if ($validation->fails()) {

            return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validation->errors(),
            ], 200);
        }
        try {
            $service = Service::findOrFail($id);
            if ($service) {
                $service->name = $request->name;
                $service->description = $request->description;
                $service->requirments = $request->requirments;
                $service->coast = $request->coast;
                $service->for_whom = $request->for_whom;
                $service->save();
                return response()->json([
                    'success' => 1,
                    'result' => $service,
                    'message' => __('app.service_updated_sucsessfully'),
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' =>  __('app.failed_to_update_service'),
                ], 200);
            }
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
        $service = Service::findOrFail($id);
        if ($service) {
            $service->delete();
            return response()->json([
                'success' => 1,
                'result' => null,
                'message' => __('app.service_deleted_sucsessfully')
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.faild_to_delete_service')
            ], 200);
        }
    }
}
