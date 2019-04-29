<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CBT_Question;
use Validator;
use DB;


class CbtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $questions = CBT_Question::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
 //  body', 'option_A', 'option_B', 'option_C','option_D','requried','correct_answer'
        $question = new CBT_Question;
        $question->question = $data['question'];
        $question->optionA = $data['optionA'];
        $question->optionB = $data['optionB'];
        $question->optionC = $data['optionC'];
        $question->optionD = $data['optionD'];
        $question->required = $data['required'];
        $question->correct_answer = $data['correct_answer'];
        $success  = $question->save();
        if($success)
            return response()->json([
                "status"=>"true",
                "message"=>"Question created successfully",
                "data" => $question
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,CBT_Question $question)
    {

        $done = $question::where('id',$id)->delete();
        if($done)
        return response()->json([
            "status"=>"true",
            "data" => CBT_Question::all(),
    ], 200);
        else {
            return response()->json([
                "status"=>"false",
                "message"=>"failed to delete"
            ]);
        }

        //get Thrashed
       $thrashed =  DB::table('cbt_questions')
       ->whereNotNull('deleted_at')
       ->get();
       return $thrashed;

       //restore thrashed data
       $restored = CBT_Question::withTrashed()->find(5)->restore();
       if($restored)
       echo "Fields have been restored successfully";
       return CBT_Question::all(); die;
    }
}
