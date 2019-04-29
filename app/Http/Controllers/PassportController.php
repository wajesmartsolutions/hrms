<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Validator;

class PassportController extends Controller  //Handles Reg & Auth
{
    //
     /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()){

            return response()->json(['error'=>$validator->errors(),'status'=>'False'], 401);
        }
        $input = $request->all();

             $credentials = [
                'email'    =>  $input['email'],
                'password' =>  $input['password'],
                'first_name'=> $input['firstname'],
                'last_name'=>  $input['lastname'],
                'company_id'=> $input['company_id'],
                'permissions'=>$input['permissions']
            ];

            $callback= True;
            Sentinel::register($credentials,$callback);
            return response()->json(['Status'=>'True','message'=>'Record created']);
    }
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $userrecord= Sentinel::authenticate($credentials);
        if (empty($userrecord)){

            return response()->json(['error' => 'UnAuthorised','status'=>'False'], 401);
        }
            return response()->json(['data'=> $userrecord,'status'=>'True'],200);
    }

    public function updateUser()
    {
        $input = $request->all();

    }


    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);

    }
}
