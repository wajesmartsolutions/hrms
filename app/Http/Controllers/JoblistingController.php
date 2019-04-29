<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Interview_questions;
use App\Joblisting;

class JoblistingController extends Controller
{
    //
    public function create(Request $request)
    {
        $data = $request->json()->all();
        $joblisting = new Joblisting();
        $joblisting->requiredskill = $data['requiredskill'];
        $joblisting->role = $data['role'];
        $joblisting->maj_qualification = $data['maj_qualification'];
        $joblisting->extra_skill = $data['extra_skill'];
        $joblisting->last_applydate = $data['last_applydate'];
        $joblisting->jobdescription = $data['jobdescription'];
        $joblisting->job_location= $data['job_location'];
        $joblisting->entrydate = $data['entrydate'];
        $joblisting->jobstatus = $data['jobstatus'];
        $joblisting->jobcategory = $data['jobcategory'];
        $joblisting->save();
        $question = Interview_questions::find($data['question']);
        $joblisting->questions()->attach($question);
        return response()->json([
            'status' => 'True',
            'message'=>'Record is created'

        ]);
    }
    public function retrieve(Request $request)
    {
        $jobrole = $request->jobrole;
        $joblocation= $request->joblocation;
        if (isset($joblocation) and isset($jobrole)) {
            $record=Joblisting::where('role', '=', $jobrole)
                    ->where('job_location','=',$joblocation)
                    ->where('status','=','1')
                    ->with('questions')
                    ->get();
        }elseif(isset($jobrole)){
            $record=Joblisting::where('role', '=', $jobrole)
                    ->where('status','=','1')
                    ->with('questions')
                    ->get();
        }elseif(isset($joblocation)){
            $record=Joblisting::where('job_location', '=', $joblocation)
                    ->where('status','=','1')
                    ->with('questions')
                    ->get();
        }else{
            $record = Joblisting::with('questions')->get();
        }
    
        return response()->json([
            'status' => 'True',
            'data'=>$record

        ]);
    }

    public function index()
    {     
        $question=Joblisting::all();
        return response()->json([
            'success' => 'True',
            'data' => $question
        ]);
    }
 
    public function show($id)
    {
        $joblisting = Joblisting::find($id);
        if (!$joblisting) {

            return response()->json([
                'success' => 'False',
                'message' => 'question with id ' . $id .' not found'
            ], 400);
        }
        return response()->json([
            'success' => 'True',
            'data' => $joblisting->toArray()
        ], 200);
    }
 
 
    public function update(Request $request,$id)
    {
        $joblisting = Joblisting::find($id); 
        if (!$joblisting) {
            return response()->json([
                'success' => false,
                'message' => 'Joblisting with id ' . $id . ' not found'
            ], 400);
        }
        $updated =$joblisting->fill($request->all())->save();
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'joblisting could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $joblisting = Joblisting::find($id); 
        if (!$joblisting) {
            return response()->json([
                'success' => false,
                'message' => 'Joblisting with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($joblisting->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'JOblisting could not be deleted'
            ], 500);
        }
    }
   
}
