<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    //
    public function index()

    {
        $company = Company::all();
        return response()->json([
            'success' => true,
            'data' => $company
        ]);
    }
 
    public function show($id)
    {
        $company = auth()->user()->products()->find($id);
 
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $company->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'state' => 'required',
            'companyname' => 'required',
            'city'=>'required',
            'state'=>'required'
        ]);
        $company = new Company();
        $company->companyname = $request->companyname;
        $company->address = $request->address;
        $company->city = $request->city;
        $company->state = $request->state;
 
        if (auth()->user()->company()->save($company))
            return response()->json([
                'success' => true,
                'data' => $company->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Product could not be added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $company = auth()->user()->company()->find($id);
 
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }
 
        $updated = $company->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Product could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $company = auth()->user()->products()->find($id);
 
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($company->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product could not be deleted'
            ], 500);
        }
    }
}
