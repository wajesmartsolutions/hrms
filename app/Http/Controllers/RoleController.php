<?php

namespace App\Http\Controllers;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;
use Validator;
use App\Roles;
use App\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = \App\Roles::all();
        return response()->json(['Status'=>'True','data'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignUserRole(Request $request)
    {
        $input = $request->all();
        dd($input);die;
        $id = $input['id'];
        $user = Sentinel::findById($id);
        if($user === null){
            return "data not found";
        }
          $role = Sentinel::findRoleById($id);
        return $role['slug'];die;

        $role->users()->attach($user);

    }

    public function assignUserPermission(Request $request)
    {
        $input = $request->all();



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
        $input = $request->json()->all();
        $validator = Validator::make($request->json()->all(),[
            'name' => 'required|unique:roles|max:255',
        ]);
        if ($validator->fails()){
            return response()->json(['error'=>$validator->errors(),'status'=>'False'], 401);
        }else{
            $role = Sentinel::getRoleRepository()->createModel()->create([
                'name' => $input['name'],
                'slug' => $input['slug'],
                'permisions' =>[
                    "joblisting.create"=>true,
		            "joblisting.edit"=>true,
		            "interview.grant"=>true
                ]
            ]);

            return response()->json(['Status'=>'True','message'=>'Record created']);
        }
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
    public function destroy($id)
    {
        //
    }
}
