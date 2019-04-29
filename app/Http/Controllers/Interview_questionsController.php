<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Interview_questions;
use App\CBT_Question;
use App\CBT_Answer;
use Validator;


class Interview_questionsController extends Controller
{
    public function index()
    {
        $question=Interview_questions::all();
        return response()->json([
            'success' => True,
            'data' => $question
        ]);
    }

    public function show($id)
    {
        $question = Interview_questions::find($id);
        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'question with id ' . $id .' not found'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $question->toArray()
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $validator = Validator::make($request->all(), [
            'required' => 'required',
            'question' => 'required'
        ]);

        if ($validator->fails()){

            return response()->json(['error'=>$validator->errors(),'status'=>'False'], 401);

        }else{

            $question = new Interview_questions();
            $question->required = $request->required;
            $question->question = $request->question;

                if ($question->save())
                return response()->json([
                    'success' => true,
                    'data' =>$data
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'question could not be added'
                ], 500);
        }

    }

    public function update(Request $request,$id)
    {
        $question = Interview_questions::find($id);
        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question with id ' . $id . ' not found'
            ], 400);
        }
        $updated =$question->fill($request->all())->save();
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Question could not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $question = Interview_questions::find($id);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question with id ' . $id . ' not found'
            ], 400);
        }

        if ($question->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Question could not be deleted'
            ], 500);
        }
    }

    public function checkAnswer(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'answer_id' => 'required'
        ]);

        if ($validator->fails()){

            return response()->json(['error'=>$validator->errors(),'status'=>'False'], 401);

        }else{
            $answer = CBT_Answer::find($request->answer_id);
            echo $answer;die;
            if (! $answer->is_correct) {
              return 'Wrong answer';
            }
            return 'Correct!';
        }
    }

}
