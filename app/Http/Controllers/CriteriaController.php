<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criteria;

class CriteriaController extends Controller
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
        $criteria = Criteria::all();
        return response()->json($criteria, 200);
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
            'section_id' => $request->input('section_id')
        ];
        try {
            $criteria = new Criteria($data);
            $criteria->save();
            return response()->json($criteria, 201);
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
        $criteria = Criteria::findOrFail($id);
        return response()->json($criteria, 200);
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
        $criteria = Criteria::findOrFail($id);
        $criteria->name = $request->input('name');
        $criteria->update();
        return response()->json($criteria, 200);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();
        return response()->json(['msg' => 'Record deleted'], 200);
    }
}