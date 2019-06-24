<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluation;

class EvaluationController extends Controller
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
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'health_office_id' => 'required',
            'section_id' => 'required',
            'criteria_id' => 'required',
            'score' => 'required',
        ]);
        $data = [
            'health_office_id' => $request->input('health_office_id'),
            'section_id' => $request->input('section_id'),
            'criteria_id' => $request->input('criteria_id'),
            'score' => $request->input('score'),
        ];
        try {
            $evaluation = new Evaluation($data);
            $evaluation->save();
            return response()->json($evaluation, 201);
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
        $evaluation = Evaluation::findOrFail($id);
        return response()->json($evaluation, 200);
        
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
            'health_office_id' => 'required',
            'section_id' => 'required',
            'criteria_id' => 'required',
            'score' => 'required',
        ]);
        $data = [
            'health_office_id' => $request->input('health_office_id'),
            'section_id' => $request->input('section_id'),
            'criteria_id' => $request->input('criteria_id'),
            'score' => $request->input('score'),
        ];
        try {
            $evaluation = Evaluation::findOrFail($id);
            $evaluation->save($data);
            return response()->json($evaluation, 200);
        } catch (\Exception $e) {
            return response()->json(["msg" => $e->getMessage()], 400);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();
        return response()->json(['msg' => 'Record deleted'], $e->getCode());
    }
}