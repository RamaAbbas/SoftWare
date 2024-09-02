<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeroSectionController extends Controller
{
    public function store(Request $request)
    {
        $validatedDat = Validator::make($request->all(), [
          //  'en_title' => 'required',
          //  'nl_title' => 'required',
          //  'en_sub_title' => 'required',
          //  'nl_sub_title' => 'required',
         //   'image_path' => 'required'
         'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


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
            if ($request->hasFile('image_path')) {
                $file = $request->image_path;
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('HeroSection_images', $filename, 'public');
                /* $project->project_images()->create([
                    'image_path' => $filePath
                ]);*/
                $hero = HeroSection::create([
                    'en_title' => $data['en_title'],
                    'nl_title' => $data['nl_title'],
                    'en_sub_title' => $data['en_sub_title'],
                    'nl_sub_title' => $data['nl_sub_title'],
                    'image_path' => $filePath,
                ]);
            } else {
                $hero = HeroSection::create([
                    'en_title' => $data['en_title'],
                    'nl_title' => $data['nl_title'],
                    'en_sub_title' => $data['en_sub_title'],
                    'nl_sub_title' => $data['nl_sub_title'],

                ]);
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
