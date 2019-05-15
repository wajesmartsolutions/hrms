<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicantsController extends Controller
{
 	public function upload(Request $request) {
 		return view('upload');
 		$data = $request->file('image');
 		dd($data);
 		//echo $data;
 		//$imageName = substr($data,20);
 	}   
}
