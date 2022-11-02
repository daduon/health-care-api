<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\Material;
use App\Models\Appointment;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // list materials
    public function index(){

        $materail = Material::with('appointments')->get();

        return response()->json([
            'message' => 'successfully',
            'response' => $materail
        ], 200);
    }

    // accept or reject
    public function appointmentStatus($id,Request $request){

        $status = new Appointment();

        $data = $status->find($id)->update([
            'status' => $request->status
        ]);
        
        return response()->json([
            'message' => 'successfully',
            'response' => $data
        ], 201);
    }

    // create materials
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'image' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $materail = Material::create([
                'title' => $request->title,
                'image' => base64_encode(file_get_contents($request->file('image'))),
                'description' => $request->description,
                'user_id' => Auth::id()
        ]);

        return response()->json([
            'message' => 'successfully',
            'response' => $materail
        ], 201);
    }

    // edit materials
    public function edit($id){

        $materail = Material::find($id);

        return response()->json([
            'message' => 'successfully',
            'response' => $materail
        ], 200);
    }

    // update materials
    public function update($id,Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'image' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $materail = Material::find($id)->update([
            'title' => $request->title,
            'image' => base64_encode(file_get_contents($request->file('image'))),
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'successfully',
            'response' => $materail
        ], 200);
    }

    // delete materials
    public function delete($id){

        $materail = Material::destroy($id);

        return response()->json([
            'message' => 'successfully',
            'response' => $materail
        ], 201);
    }
}
