<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Interview_answers;
use App\Interview_questions;
use App\Joblisting;
use App\Applicants;

class ApplyjobsController extends Controller
{
    //
    public  function appliedjobposting(Request $request)
    {
        $data = $request->json()->all();
        print_r($data); die;
        $fullname= $data['firstname'].$data['lastname'];
        $uploadimg = $this->generateImage($data['cv'],$fullname);
        $applicant = new Applicants;
        $applicant->firstname = $data['firstname'];
        $applicant->lastname = $data['lastname'];
        $applicant->phonenumber = $data['phone'];
        $applicant->emailaddress = $data['emailaddress'];
        $applicant->joblisting_id = $data['joblistingid'];
        $applicant->documents = $uploadimg;
        $applicant->save();
        $this->SavedInterview($data,$applicant);
        return response()->json([
            'status' => 'True',
            'message'=>'Record is created'

        ]);
    }

    public  function generateImage($img,$fullname)
    {
        $folderPath= realpath($_SERVER['DOCUMENT_ROOT']).'/images/';
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . $fullname . '.png';
        file_put_contents($file, $image_base64);

        return $file;
    }

    public function SavedInterview($data,$applicant){
        $answers= $data['answers'];
        foreach ($answers as $key => $value) {
           \App\Interview_answers::create(['answer'=> $value,'question_id'=>$key,'applicant_id'=>$applicant->id]);
        }
    }

    public  function listappliedjobposting(Request $request)
    {
        $id= $request->id;
        $applicationstatus= $request->applicationstatus;
        if (isset($id) && isset($applicationstatus) ){
            $applicant = \App\Applicants::where('joblisting_id','=',$id)
                                    ->where('jobstatus','=',$applicationstatus)
                                    ->get()->toarray();
            $applicantquestions=$this->getApplicantQuestions($applicant,$applicationstatus);
            $joblisting= [];
            $resultset =[];
            foreach ($applicantquestions as $applicantquestion) {
                $joblisting[$applicantquestion['joblisting_id']]=$applicantquestion;
                $joblistingdetails= $this->joblistingDetails($applicantquestion['joblisting_id']);
                $joblisting[$applicantquestion['joblisting_id']]  = array_merge($joblisting[$applicantquestion['joblisting_id']],array_slice($joblistingdetails,0));
                array_push($resultset,$joblisting[$applicantquestion['joblisting_id']]);
                continue;
            }
            return response()->json(['status' => 'True','data'=>$resultset]);
        }elseif(isset($id)){
            $applicant = \App\Applicants::where('joblisting_id','=',$id)
                                    ->get()->toarray();
            $applicantquestions=$this->getApplicantQuestions($applicant,$applicationstatus);
            $joblisting= [];
            $resultset =[];
            foreach ($applicantquestions as $applicantquestion) {
                    $joblisting[$applicantquestion['joblisting_id']]=$applicantquestion;
                    $joblistingdetails= $this->joblistingDetails($applicantquestion['joblisting_id']);
                    $joblisting[$applicantquestion['joblisting_id']]  = array_merge($joblisting[$applicantquestion['joblisting_id']],array_slice($joblistingdetails,0));
                    array_push($resultset,$joblisting[$applicantquestion['joblisting_id']]);
                    continue;
            }
            return response()->json(['status' => 'True','data'=>$resultset]);
        }
        else {
            $joblisting = Joblisting::with('applicants')->get()->toarray();
            return response()->json(['status' => 'True','data'=>$joblisting]);
        }

    }

    public function getApplicantQuestions($listapplicate,$applicationstatus){
        $applicatequestion= [];
        $resultset =[];
        foreach ($listapplicate as $listapplicates) {
            $applicatequestion[$listapplicates['id']]=$listapplicates;
            $questionsanswers= $this->listQuestionsAnswers($listapplicates['id']);
            $applicatequestion[$listapplicates['id']]  = array_merge($applicatequestion[$listapplicates['id']],array_slice($questionsanswers,0));
            array_push($resultset,$applicatequestion[$listapplicates['id']]);
            continue;
        }
        return $resultset;
    }

    public function listQuestionsAnswers($id){
        $question=[];
        $resultset=[];
        $interviewquestions=\App\Interview_answers::where('applicant_id','=', $id)
        ->get()->toarray();
        foreach ($interviewquestions as $interviewquestion){
            $question[$interviewquestion['question_id']] = $interviewquestion;
            $questiondetails = $this->questionDetails($interviewquestion['question_id']);
            $question[$interviewquestion['question_id']]  = array_merge($question[$interviewquestion['question_id']],array_slice($questiondetails,0));
            array_push($resultset, $question[$interviewquestion['question_id']]);
            continue;
        }
         $finalresult=['interview_questions_answers'=>$resultset] ;
         return $finalresult;
    }

    public function questionDetails($id){
        $questiondetails =\App\Interview_questions::where('id', '=', $id)->get()->toarray();
        foreach ($questiondetails as $questiondetail){
        }
        return $questiondetail;
    }

    public function joblistingDetails($id){
        $joblistingdetails =\App\Joblisting::where('id', '=', $id)->get()->toarray();
        foreach( $joblistingdetails as $joblistingdetail){
        }
        return $joblistingdetail;
    }


}
