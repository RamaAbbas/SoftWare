<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\ContactsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\App;

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
    public function show_all()
    {
        $contacts = Contact::with('contacts_messeges')->get();
        return view('admin.ContactUs.test', compact('contacts'));
    }
    public function show_contactpage()
    {
        $language = App::getLocale();
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;
        $contacts = ContactsPage::all();
        try {
            $processedcontactpage = $contacts->map(function ($contact) use ($locale) {
                $data = [
                    'title' => $locale == 'en' ? $contact->en_title : $contact->nl_title,
                    'sub_title' => $locale == 'en' ? $contact->en_sub_title : $contact->nl_sub_title,
                ];


                $data['contacts_whats_next'] =  $contact->contacts_whats_next->map(function ($subrelated) use ($locale) {
                    return [
                        'step' => $locale == 'en' ? $subrelated->en_step : $subrelated->nl_step,
                    ];
                });

                return $data;
            });
            return view('ContactPage.contactpage', compact('processedcontactpage'));
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email",
            "mobile_number" => "required",
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
                'service_id' => $data['service_id'],
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

    public function storecontactPage(Request $request)
    {
        $validatedDat = Validator::make($request->all(), [
            'en_title' => 'required',
            'nl_title' => 'required',
            'en_sub_title' => 'required',
            'nl_sub_title' => 'required',



        ]);
        if ($validatedDat->fails()) {

            return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validatedDat->errors(),
            ], 200);
        }
        try {

            $data = $request->all();


            $hero = ContactsPage::create([
                'en_title' => $data['en_title'],
                'nl_title' => $data['nl_title'],
                'en_sub_title' => $data['en_sub_title'],
                'nl_sub_title' => $data['nl_sub_title'],
            ]);
            if (isset($data['contacts_whats_next'])) {
                foreach ($data['contacts_whats_next'] as $relatedData) {

                    $hero->contacts_whats_next()->create($relatedData);
                }
            }



            return response()->json([
                'success' => 1,
                'result' => $hero,
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
}
