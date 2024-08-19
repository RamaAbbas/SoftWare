<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    /* public function index()
    {
        session(['a' => "ssss"]);
        // $services = Service::all();
        $services = Service::with(['requirment', 'for_who', 'how_it_work'])->get();
        try {
            if ($services) {
                return response()->json([
                    'success' => 1,
                    'result' => $services,
                    'message' => __('app.get_all_services')
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' =>  __('app.fail_get_all_services'),
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }*/
    public function index(Request $request)
    {
        $language = $request->header('Lang');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        $services = Service::with(['requirment', 'for_who', 'how_it_work'])->get();

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
                    $service->description = $description[$locale] ?? $description[$defaultLanguage] ?? __('Language not supported');
                }


                $service->requirment = $service->requirment->map(function ($requirment) use ($locale, $defaultLanguage) {
                    if (is_string($requirment->descripton_of_requirment)) {
                        $description = json_decode($requirment->descripton_of_requirment, true);
                        $requirment->descripton_of_requirment = $description[$locale] ?? $description[$defaultLanguage] ?? __('Language not supported');
                    }
                    return $requirment;
                });


                $service->for_who = $service->for_who->map(function ($related) use ($locale, $defaultLanguage) {
                    if (is_string($related->benefit_name)) {
                        $name = json_decode($related->benefit_name, true);
                        $related->benefit_name = $name[$locale] ?? $name[$defaultLanguage] ?? __('Language not supported');
                    }
                    if (is_string($related->benefit_description)) {
                        $description = json_decode($related->benefit_description, true);
                        $related->benefit_description = $description[$locale] ?? $description[$defaultLanguage] ?? __('Language not supported');
                    }
                    return $related;
                });


                $service->how_it_work = $service->how_it_work->map(function ($related) use ($locale, $defaultLanguage) {
                    if (is_string($related->name_of_step)) {
                        $stepName = json_decode($related->name_of_step, true);
                        $related->name_of_step = $stepName[$locale] ?? $stepName[$defaultLanguage] ?? __('Language not supported');
                    }
                    if (is_string($related->description_of_step)) {
                        $stepDescription = json_decode($related->description_of_step, true);
                        $related->description_of_step = $stepDescription[$locale] ?? $stepDescription[$defaultLanguage] ?? __('Language not supported');
                    }
                    return $related;
                });

                return $service;
            });

            return response()->json([
                'success' => 1,
                'result' => $processedServices,
                'message' => __("app.data_returned_successfully")
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
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'requirments' => 'required',
            "coast" => 'required|integer',
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
            $service = Service::create([
                'name' => $request->name,
                'description' => $request->description,
                'requirments' => $request->requirments,
                "coast" => $request->coast,
                "for_whom" => $request->for_whom,

            ]);
            return response()->json([
                'sucsess' => 1,
                'result' => $service,
                'message' => __('app.servive_stored_sucsessfully'),
            ], 200);
        } catch (Exception $e) {
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
        $language = $request->header('Lang');
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;

        try {
            $service = Service::with(['requirment', 'for_who', 'how_it_work'])->findOrFail($id);

            if (!$service) {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('app.there_is_no_data')
                ], 200);
            }


            if (is_string($service->description)) {
                $description = json_decode($service->description, true);
                $service->description = $description[$locale] ?? $description[$defaultLanguage] ?? __('Language not supported');
            }


            $service->requirment = $service->requirment->map(function ($related) use ($locale, $defaultLanguage) {
                if (is_string($related->descripton_of_requirment)) {
                    $description = json_decode($related->descripton_of_requirment, true);
                    $related->descripton_of_requirment = $description[$locale] ?? $description[$defaultLanguage] ?? __('Language not supported');
                }
                return $related;
            });


            $service->for_who = $service->for_who->map(function ($related) use ($locale, $defaultLanguage) {
                if (is_string($related->benefit_name)) {
                    $name = json_decode($related->benefit_name, true);
                    $related->translated_text_b = $name[$locale] ?? $name[$defaultLanguage] ?? __('Language not supported');
                }
                if (is_string($related->benefit_description)) {
                    $description = json_decode($related->benefit_description, true);
                    $related->translated_text_c = $description[$locale] ?? $description[$defaultLanguage] ?? __('Language not supported');
                }
                return $related;
            });


            $service->how_it_work = $service->how_it_work->map(function ($related) use ($locale, $defaultLanguage) {
                if (is_string($related->name_of_step)) {
                    $stepName = json_decode($related->name_of_step, true);
                    $related->translated_text_b = $stepName[$locale] ?? $stepName[$defaultLanguage] ?? __('Language not supported');
                }
                if (is_string($related->description_of_step)) {
                    $stepDescription = json_decode($related->description_of_step, true);
                    $related->translated_text_c = $stepDescription[$locale] ?? $stepDescription[$defaultLanguage] ?? __('Language not supported');
                }
                return $related;
            });

            return response()->json([
                'success' => 1,
                'result' => $service,
                'message' => __('app.service_returned_successfully')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /* public function show($id)
    {
        //  $service = Service::findOrFail($id);
        $service = Service::with(['requirment', 'for_who', 'how_it_work'])->findOrFail($id);
        if (!$service) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.failed_to_restore_service')
            ], 200);
        } else {
            return response()->json([
                'success' => 1,
                'result' => $service,
                'message' => __('app.service_returned_sucsessfully')
            ], 200);
        }
    }*/
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

    public function getcontent($id, $content)
    {
        $service = Service::findOrFail($id);
        if ($service) {
            if ($content == "description") {
                $description = $content;
                return view('admin.Service.service', compact('description'));
            }
        }
    }
}