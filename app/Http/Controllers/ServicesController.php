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

        $services = Service::with(['requirment', 'service_benefits', 'service_processs', 'client_testimonial'])->get();

        if ($services->isEmpty()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }

        try {
            $processedServices = $services->map(function ($service) use ($locale, $defaultLanguage) {

                // $service->shortcut($locale,$service,$defaultLanguage);
                if ($locale == 'en') {
                    return [
                        'name' => $service->en_name ?? __('app.lang_not_supported'),
                        'description' => $service->en_description ?? __('app.lang_not_supported'),
                        'title_of_requirments' => $service->en_title_of_requirments ?? __('app.lang_not_supported'),
                        'title_of_how_it_works' => $service->en_title_of_how_it_works ?? __('app.lang_not_supported'),
                        'title_of_service_benefit' => $service->en_title_of_service_benefit ?? __('app.lang_not_supported'),
                        'title_call_to_action' => $service->en_title_call_to_action ?? __('app.lang_not_supported'),
                        'sub_title_call_to_action' => $service->en_sub_title_call_to_action ?? __('app.lang_not_supported'),

                        "Requirment" => "0",
                        $service->requirment = $service->requirment->map(function ($related) use ($locale, $defaultLanguage) {
                            $requirment = [
                                'name' => $related->en_name ?? __('app.lang_not_supported'),
                                'description' => $related->en_description ?? __('app.lang_not_supported'),

                            ];
                            return $requirment;
                        }),
                        "Benefits" => "1",
                        $service->service_benefits = $service->service_benefits->map(function ($related) use ($locale, $defaultLanguage) {
                            $service_benefits = [
                                'name' => $related->en_name ?? __('app.lang_not_supported'),
                                'description' => $related->en_description ?? __('app.lang_not_supported'),

                            ];
                            return $service_benefits;
                        }),
                        "Client Testimonial" => "2",
                        $service->client_testimonial = $service->client_testimonial->map(function ($related) use ($locale, $defaultLanguage) {
                            $client_testimonial = [
                                'client_name' => $related->client_name ?? __('app.lang_not_supported'),
                                'client_testimonial' => $related->en_client_testimonial ?? __('app.lang_not_supported'),

                            ];
                            return $client_testimonial;
                        }),
                        "Service Processs" => "3",
                        $service->service_processs = $service->service_processs->map(function ($related) use ($locale, $defaultLanguage) {
                            $service_processs = [
                                "Process Procedures" => "0",
                                'name' => $related->en_name ?? __('app.lang_not_supported'),
                                $related->process_procedures = $related->process_procedures->map(function ($subrelated) use ($locale, $defaultLanguage) {
                                    $process_procedures = [
                                        'name' => $subrelated->en_name ?? __('app.lang_not_supported'),
                                        'description' => $subrelated->en_description ?? __('app.lang_not_supported'),

                                    ];
                                    return $process_procedures;
                                }),

                            ];
                            return $service_processs;
                        }),
                    ];
                } else if ($locale = 'nl') {
                    return [
                        'name' => $service->nl_name ?? __('app.lang_not_supported'),
                        'description' => $service->nl_description ?? __('app.lang_not_supported'),
                        'title_of_requirments' => $service->nl_title_of_requirments ?? __('app.lang_not_supported'),
                        'title_of_how_it_works' => $service->nl_title_of_how_it_works ?? __('app.lang_not_supported'),
                        'title_of_service_benefit' => $service->nl_title_of_service_benefit ?? __('app.lang_not_supported'),
                        'title_call_to_action' => $service->nl_title_call_to_action ?? __('app.lang_not_supported'),
                        'sub_title_call_to_action' => $service->nl_sub_title_call_to_action ?? __('app.lang_not_supported'),

                        "Requirment" => "0",
                        $service->requirment = $service->requirment->map(function ($related) use ($locale, $defaultLanguage) {
                            $requirment = [
                                'name' => $related->nl_name ?? __('app.lang_not_supported'),
                                'description' => $related->nl_description ?? __('app.lang_not_supported'),

                            ];
                            return $requirment;
                        }),
                        "Benefits" => "1",
                        $service->service_benefits = $service->service_benefits->map(function ($related) use ($locale, $defaultLanguage) {
                            $service_benefits = [
                                'name' => $related->nl_name ?? __('app.lang_not_supported'),
                                'description' => $related->nl_description ?? __('app.lang_not_supported'),

                            ];
                            return $service_benefits;
                        }),
                        "Client Testimonial" => "2",
                        $service->client_testimonial = $service->client_testimonial->map(function ($related) use ($locale, $defaultLanguage) {
                            $client_testimonial = [
                                'client_name' => $related->client_name ?? __('app.lang_not_supported'),
                                'client_testimonial' => $related->nl_client_testimonial ?? __('app.lang_not_supported'),

                            ];
                            return $client_testimonial;
                        }),
                        "Service Processs" => "3",
                        $service->service_processs = $service->service_processs->map(function ($related) use ($locale, $defaultLanguage) {
                            $service_processs = [
                                "Process Procedures" => "0",
                                'name' => $related->nl_name ?? __('app.lang_not_supported'),
                                $related->process_procedures = $related->process_procedures->map(function ($subrelated) use ($locale, $defaultLanguage) {
                                    $process_procedures = [
                                        'name' => $subrelated->nl_name ?? __('app.lang_not_supported'),
                                        'description' => $subrelated->nl_description ?? __('app.lang_not_supported'),

                                    ];
                                    return $subrelated;
                                }),

                            ];
                            return $service_processs;
                        }),
                    ];
                }


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

        $validatedDat = Validator::make($request->all(), [
            'en_name' => 'required',
            'nl_name' => 'required',
            'en_description' => 'required',
            'nl_description' => 'required',
            'en_title_of_requirments' => 'required',
            'nl_title_of_requirments' => 'required',
            'en_title_of_how_it_works' => 'required',
            'nl_title_of_how_it_works' => 'required',
            'en_title_of_service_benefit' => 'required',
            'nl_title_of_service_benefit' => 'required',
            'en_title_call_to_action' => 'required',
            'nl_title_call_to_action' => 'required',
            'en_sub_title_call_to_action' => 'required',
            'nl_sub_title_call_to_action' => 'required',
            "cost" => 'required',
            'requirment' => 'array',
            'client_testimonial' => 'array',
            'service_benefits' => 'array',
            'service_processs' => 'array'




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
            $validatedData = $request->all(); //$validatedData['']

            $service = Service::create([
                'en_name' => $validatedData['en_name'],
                'nl_name' => $validatedData['nl_name'],
                'en_description' => $validatedData['en_description'],
                'nl_description' => $validatedData['nl_description'],
                'en_title_of_requirments' => $validatedData['en_title_of_requirments'],
                'nl_title_of_requirments' => $validatedData['nl_title_of_requirments'],
                'en_title_of_how_it_works' => $validatedData['en_title_of_how_it_works'],
                'nl_title_of_how_it_works' => $validatedData['nl_title_of_how_it_works'],
                'en_title_of_service_benefit' => $validatedData['en_title_of_service_benefit'],
                'nl_title_of_service_benefit' => $validatedData['nl_title_of_service_benefit'],
                'en_title_call_to_action' => $validatedData['en_title_call_to_action'],
                'nl_title_call_to_action' => $validatedData['nl_title_call_to_action'],
                'en_sub_title_call_to_action' => $validatedData['en_sub_title_call_to_action'],
                'nl_sub_title_call_to_action' => $validatedData['nl_sub_title_call_to_action'],
                'cost' => $validatedData['cost']

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
            if (isset($validatedData['client_testimonial'])) {
                foreach ($validatedData['client_testimonial'] as $relatedData) {
                    $service->client_testimonial()->create($relatedData);
                }
            }

            if (!empty($validatedData['service_processs'])) {
                foreach ($validatedData['service_processs'] as $service_processsdata) {

                    $service_processs = $service->service_processs()->create([
                        'en_name' => $service_processsdata['en_name'],
                        'nl_name' => $service_processsdata['nl_name'],
                    ]);

                    if (!empty($service_processsdata['process_procedures'])) {
                        foreach ($service_processsdata['process_procedures'] as $process_procedures) {

                            $service_processs->process_procedures()->create([
                                'en_name' => $process_procedures['en_name'],
                                'nl_name' => $process_procedures['nl_name'],
                                'en_description' => $process_procedures['en_description'],
                                'nl_description' => $process_procedures['nl_description'],
                            ]);
                        }
                    }
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
            $service = Service::with(['requirment', 'service_benefits', 'service_processs', 'client_testimonial'])->findOrFail($id);

            if (!$service) {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('app.there_is_no_data')
                ], 200);
            }
            //  $service->shortcut($locale, $service, $defaultLanguage);
            if ($locale == 'en') {
                return [
                    'name' => $service->en_name ?? __('app.lang_not_supported'),
                    'description' => $service->en_description ?? __('app.lang_not_supported'),
                    'title_of_requirments' => $service->en_title_of_requirments ?? __('app.lang_not_supported'),
                    'title_of_how_it_works' => $service->en_title_of_how_it_works ?? __('app.lang_not_supported'),
                    'title_of_service_benefit' => $service->en_title_of_service_benefit ?? __('app.lang_not_supported'),
                    'title_call_to_action' => $service->en_title_call_to_action ?? __('app.lang_not_supported'),
                    'sub_title_call_to_action' => $service->en_sub_title_call_to_action ?? __('app.lang_not_supported'),

                    "Requirment" => "0",
                    $service->requirment = $service->requirment->map(function ($related) use ($locale, $defaultLanguage) {
                        $requirment = [
                            'name' => $related->en_name ?? __('app.lang_not_supported'),
                            'description' => $related->en_description ?? __('app.lang_not_supported'),

                        ];
                        return $requirment;
                    }),
                    "Benefits" => "1",
                    $service->service_benefits = $service->service_benefits->map(function ($related) use ($locale, $defaultLanguage) {
                        $service_benefits = [
                            'name' => $related->en_name ?? __('app.lang_not_supported'),
                            'description' => $related->en_description ?? __('app.lang_not_supported'),

                        ];
                        return $service_benefits;
                    }),
                    "Client Testimonial" => "2",
                    $service->client_testimonial = $service->client_testimonial->map(function ($related) use ($locale, $defaultLanguage) {
                        $client_testimonial = [
                            'client_name' => $related->client_name ?? __('app.lang_not_supported'),
                            'client_testimonial' => $related->en_client_testimonial ?? __('app.lang_not_supported'),

                        ];
                        return $client_testimonial;
                    }),
                    "Service Processs" => "3",
                      $service->service_processs = $service->service_processs->map(function ($related) use ($locale, $defaultLanguage) {
                        $service_processs = [
                            "Process Procedures" => "0",
                            'name' => $related->en_name ?? __('app.lang_not_supported'),
                            $related->process_procedures = $related->process_procedures->map(function ($subrelated) use ($locale, $defaultLanguage) {
                                $process_procedures = [
                                    'name' => $subrelated->en_name ?? __('app.lang_not_supported'),
                                    'description' => $subrelated->en_description ?? __('app.lang_not_supported'),

                                ];
                                return $process_procedures;
                            }),

                        ];
                         return $service_processs;
                    }),

                ];
            } else if ($locale = 'nl') {
                return [
                    'name' => $service->nl_name ?? __('app.lang_not_supported'),
                    'description' => $service->nl_description ?? __('app.lang_not_supported'),
                    'title_of_requirments' => $service->nl_title_of_requirments ?? __('app.lang_not_supported'),
                    'title_of_how_it_works' => $service->nl_title_of_how_it_works ?? __('app.lang_not_supported'),
                    'title_of_service_benefit' => $service->nl_title_of_service_benefit ?? __('app.lang_not_supported'),
                    'title_call_to_action' => $service->nl_title_call_to_action ?? __('app.lang_not_supported'),
                    'sub_title_call_to_action' => $service->nl_sub_title_call_to_action ?? __('app.lang_not_supported'),

                    "Requirment" => "0",
                    $service->requirment = $service->requirment->map(function ($related) use ($locale, $defaultLanguage) {
                        $requirment = [
                            'name' => $related->nl_name ?? __('app.lang_not_supported'),
                            'description' => $related->nl_description ?? __('app.lang_not_supported'),

                        ];
                        return $requirment;
                    }),
                    "Benefits" => "1",
                    $service->service_benefits = $service->service_benefits->map(function ($related) use ($locale, $defaultLanguage) {
                        $service_benefits = [
                            'name' => $related->nl_name ?? __('app.lang_not_supported'),
                            'description' => $related->nl_description ?? __('app.lang_not_supported'),

                        ];
                        return $service_benefits;
                    }),
                    "Client Testimonial" => "2",
                    $service->client_testimonial = $service->client_testimonial->map(function ($related) use ($locale, $defaultLanguage) {
                        $client_testimonial = [
                            'client_name' => $related->client_name ?? __('app.lang_not_supported'),
                            'client_testimonial' => $related->nl_client_testimonial ?? __('app.lang_not_supported'),

                        ];
                        return $client_testimonial;
                    }),
                    "Service Processs" => "3",
                    $service->service_processs = $service->service_processs->map(function ($related) use ($locale, $defaultLanguage) {
                        $service_processs = [
                            "Process Procedures" => "0",
                            'name' => $related->nl_name ?? __('app.lang_not_supported'),
                            $related->process_procedures = $related->process_procedures->map(function ($subrelated) use ($locale, $defaultLanguage) {
                                $process_procedures = [
                                    'name' => $subrelated->nl_name ?? __('app.lang_not_supported'),
                                    'description' => $subrelated->nl_description ?? __('app.lang_not_supported'),

                                ];
                                return $process_procedures;
                            }),

                        ];
                         return $service_processs;
                    }),
                ];
            }





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
