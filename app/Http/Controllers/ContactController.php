<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ContactController extends Controller
{


    public function index()
    {
        $contacts = Contact::with('contacts_messeges')->get();
        if ($contacts->isEmpty()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.there_is_no_data')
            ], 200);
        }
        try {

            return response()->json([
                'success' => 1,
                'result' => $contacts,
                'message' =>  __('app.data_returnd_sucssesfully'),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:contacts",
            "mobile_number" => "required|unique:contacts",
            'msg' => "required"

        ]);
        if ($validatedData->fails()) {

            return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validatedData->errors(),
            ], 500);
        }
        try {

            $data = $request->all();
            $contact = Contact::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'mobile_number' => $data['mobile_number'],
                'the_service_id' => $data['the_service_id'],
            ]);
           // if ($request->has('msg')) {
                $contact->contacts_messeges()->create([
                    "msg" => $request->msg,
                    'msg_send_at' => now(),

                ]);
         //   }
            return response()->json([
                'success' => 1,
                'result' => $contact,
                'message' => __('app.contact_stored_sucsessfully')
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function show($id)
    {
        try {
            $contact = Contact::with('contacts_messeges')->findOrFail($id);
            if (!$contact) {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('app.there_is_no_data')
                ], 200);
            }

            return response()->json([
                'success' => 1,
                'result' => $contact,
                'message' =>  __('app.data_returnd_sucssesfully'),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 500);
        }
    }
}
