<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\Material;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // list appointmen
    public function index(){

        $appointment = Appointment::with('materials')->get();

        return response()->json([
            'message' => 'successfully',
            'response' => $appointment
        ], 200);
    }
    

    // create Appointment
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'date' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $material = new Material();
        $appointment = new Appointment();

        $appointment->date = $request->date;
        $appointment->reason = $request->reason;
        $appointment->status = 1;
        $appointment->user_id = Auth::id();

        $appointment->save();

        $materialId = $request->material_id;
        $appointment->materials()->attach([$materialId]);

        return response()->json([
            'message' => 'successfully',
            'response' => $appointment
        ], 201);
    }
    
    // edit appointment
    public function edit($id){

        $appointment = Appointment::find($id);

        return response()->json([
            'message' => 'successfully',
            'response' => $appointment
        ], 201);
    }

    // update Appointment
    public function update($id,Request $request){

        $validator = Validator::make($request->all(), [
            'date' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $appointment = Appointment::find($id)->update([
            'date' => $request->date,
            'reason' => $request->reason,
        ]);

        return response()->json([
            'message' => 'successfully',
            'response' => $appointment
        ], 201);
    }

    // delete Appointment
    public function delete($id){

        $appointment = Appointment::destroy($id);

        return response()->json([
            'message' => 'successfully',
            'response' => $appointment
        ], 200);
    }
}
