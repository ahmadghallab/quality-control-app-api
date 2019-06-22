<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HealthOffice;

class HealthOfficeController extends Controller
{   
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $healthoffices = HealthOffice::where('user_id', $request->user_id)->get();
        return response()->json($healthoffices, 200);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $data = [
            'name' => $request->input('name'),
            'user_id' => $request->user_id
        ];
        try {
            $healthoffice = new HealthOffice($data);
            $healthoffice->save();
            return response()->json($healthoffice, 201);
        } catch (\Exception $e) {
            return response()->json(["msg" => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $healthoffice = HealthOffice::findOrFail($id);
        return response()->json($healthoffice, 200);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $healthoffice = HealthOffice::findOrFail($id);
        $healthoffice->name = $request->input('name');
        $healthoffice->update();
        return response()->json($healthoffice, 200);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $healthoffice = HealthOffice::findOrFail($id);
        $healthoffice->delete();
        return response()->json(['msg' => 'Health office deleted'], 200);
    }
}