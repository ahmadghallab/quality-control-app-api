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
    public function index()
    {
        $healthoffices = HealthOffice::all();
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
        $healthofficeIsExist = HealthOffice::where('name', $data['name'])->where('user_id', $data['user_id'])->count();
        
        if ($healthofficeIsExist) {
            return response()->json(["msg" => "This health office already exist"], 400);
        }
        $healthoffice = new HealthOffice($data);
        if ($healthoffice->save()) {
            return response()->json($healthoffice, 201);
        }
        return response()->json(["msg" => "Something went wrong"], 400);
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