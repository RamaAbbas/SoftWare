<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Services::all();
        try {
            if ($services) {
                return response()->json([
                    'success' => 1,
                    'result' => $services,
                    'message' => __('app.s')
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' =>  "",
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
            'description' => 'required|string',
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
            $service = Services::create([
                'name' =>$request->name,
                'description' =>$request->description,
                'requirment' => $request->requirment,
                "coast" => $request->coast,
                "for_whom" =>$request->for_whom ,

            ]);
            return response()->json([
                'sucsess' => 1,
                'result' => $service,
                'message' =>"Service Stored Sucsessfully",
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
        $service = Services::findOrFail($id);
        if (!$service) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => "Service Not found"
            ], 200);
        } else {
            return response()->json([
                'success' => 1,
                'result' => $service,
                'message' => ''
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
            $service = Services::findOrFail($id);
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
                    'message' => "Service Updated Sucsessfully",
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => "",
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
        $service = Services::findOrFail($id);
        if ($service) {
            $service->delete();
            return response()->json([
                'success' => 1,
                'result' => null,
                'message' => "Service Deleted Sucsessfully"
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => "Service Not found"
            ], 200);
        }
    }
}
