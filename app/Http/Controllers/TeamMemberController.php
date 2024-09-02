<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamMemberController extends Controller
{
    public function store(Request $request)
    {
        $validatedDat = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);
        if ($validatedDat->fails()) {
            return redirect()->route('member.add')->with('error', $validatedDat->errors());

            /* return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validatedDat->errors(),
            ], 200);*/
        }
        try {

            $data = $request->all();
            if ($request->hasFile('image_path')) {
                $file = $request->image_path;
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('Team_Members_images', $filename, 'public');

                $hero = TeamMember::create([
                    'name' => $data['name'],
                    'position' => $data['position'],
                    'description' => $data['description'],

                    'image_path' => $filePath,
                ]);
            } else {
                $hero = TeamMember::create([
                    'name' => $data['name'],
                    'position' => $data['position'],
                    'description' => $data['description'],

                ]);
            }


            return redirect()->route('showall.members')->with('success', "Member Stored Sucsessfully");
            /*  return response()->json([
                'success' => 1,
                'result' => $hero,
                'message' => __('app.contact_stored_sucsessfully')
            ], 200);*/
        } catch (Exception $e) {
            /* return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e->getMessage()
            ], 500);*/
            return redirect()->route('member.add')->with('error', $e);
        }
    }
    public function show_all()
    {
        $members = TeamMember::all();
        return view('admin.teamMember.index', compact('members'));
    }
    public function addmember()
    {
        return view('admin.teamMember.add');
    }
    public function edit($id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.teamMember.edit', compact('member'));
    }
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validation->fails()) {
            $member = TeamMember::findOrFail($id);
            return redirect()->route('member.edit', $member->id)->with('error', $validation->errors());
        }
        try {
            $data = $request->all();
            $member = TeamMember::findOrFail($id);
            if ($member) {
                if ($request->hasFile('image_path')) {
                    $file = $request->image_path;
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('Team_Members_images', $filename, 'public');

                    $member->name = $request->name;
                    $member->position = $request->position;
                    $member->description = $request->description;
                    $member->image_path = $filePath;
                    $member->save();
                } else {

                    $member->name = $request->name;
                    $member->position = $request->position;
                    $member->description = $request->description;
                    $member->save();
                }
            }
            return redirect()->route('showall.members')->with('success', "Member Updated Sucsessfully");

        } catch (Exception $e) {
            return redirect()->route('member.edit')->with('error', $e);
        }
    }
    public function destroy($id)
    {
        $aboutus = TeamMember::findOrFail($id);
        if ($aboutus) {
            $aboutus->delete();
            return redirect()->route('showall.members')->with('success', "Member Deleted Sucsessfully");
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
