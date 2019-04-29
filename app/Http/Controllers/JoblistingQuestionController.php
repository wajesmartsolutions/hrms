<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interview_questions;
use App\Joblisting;

class JoblistingQuestionController extends Controller
{
    //
    public function create(Request $request)
    {
        $data = $request->json()->all();
        print_r($data['question']); die;
    }
}
