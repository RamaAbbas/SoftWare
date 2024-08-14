<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::all();
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
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'requirment' => 'required|string',
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
                'requirment' => $request->requirment,
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

    public function show($id)
    {
        $service = Service::findOrFail($id);
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
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'requirment' => 'required|string',
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
                $service->requirment = $request->requirment;
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
    public function a(){
        return view('layouts.app');
    }
    public function b(){
        return view('admin.login');
    }
}
