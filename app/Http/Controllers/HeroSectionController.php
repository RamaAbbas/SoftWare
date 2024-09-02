<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

            /*  return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validatedDat->errors(),
            ], 200);*/
            return redirect()->route('hero_section.add')->with('error', $validatedDat->errors());
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



            /*   return response()->json([
                'success' => 1,
                'result' => $hero,
                'message' => __('app.contact_stored_sucsessfully')
            ], 200);*/
            return redirect()->route('showall.herosection')->with('success', "Section Stored Sucsessfully");
        } catch (Exception $e) {
            return redirect()->route('hero_section.add')->with('error', $e);
            /*   return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);*/
        }
    }

    public function addherosection()
    {

        return view('admin.HeroSection.add');
    }

    public function edit($id)
    {
        $hero = HeroSection::findOrFail($id);
        return view('admin.HeroSection.edit', compact('hero'));
    }

    public function show_all()
    {
        $language = App::getLocale();
        $defaultLanguage = 'en';
        $locale = $language ? substr($language, 0, 2) : $defaultLanguage;
        $heros = HeroSection::all();
        $processed = $heros->map(function ($hero) use ($locale) {

            $data = [
                'id' => $hero->id,
                'title' => $locale == 'en' ? $hero->en_title : $hero->nl_title,
                'sub_title' => $locale == 'en' ? $hero->en_sub_title : $hero->nl_sub_title,
                'image_path' => $hero->image_path
            ];
            return $data;
        });
        return view('admin.HeroSection.index', compact('processed'));
    }
    public function destroy($id)
    {
        $hero = HeroSection::findOrFail($id);
        if ($hero) {
            $hero->delete();
            return redirect()->route('showall.herosection')->with('success', "Section Deleted Sucsessfully");
            /* return response()->json([
                'success' => 1,
                'result' => null,
                'message' => __('app.service_deleted_sucsessfully')
            ], 200);*/
        } else {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('app.faild_to_delete_service')
            ], 200);
        }
    }
}
