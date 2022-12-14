<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetching all the companies from companies table
        $companies = Company::all();
        
        return view('company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //name validation only accepted alphabetic characters
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/u'
           ]);
        //store the company data
       
        try{
            $company = Company::create(['name' => $request->name]);
        }
        catch(Exception $e){
            return redirect()->back()->withError($e);
        }
        return redirect('company');
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
        //fetching company with the provided id
        try{
            $company = Company::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            if ($e instanceof ModelNotFoundException) {
                return back()->withError('Record not found');
            }
        }
        return view('company.edit',compact('company','id'));
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
        //name validation only accepted alphabetic characters
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/u'
           ]);
        ///updating the company data related to the $id
        try{
            $company = Company::where('id',$id)->update(['name' => $request->name]);
        }
        catch(Exception $e){
            return $e;
        }
        return redirect('company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         //destroy|delete company with $id
         try{
            $company = Company::findOrFail($request->id);
        }
        catch (ModelNotFoundException $e) {
            if ($e instanceof ModelNotFoundException) {
                return back()->withError('Record not found');
            }
        }
        $company->delete();
        return response()->json(['message'=>'Company deleted successfuly'],200);
    }

    public function comapnyUsers($id)
    {
         //fetach the company with the users
         $company = Company::where('id',$id)->with('users')->first();
         //get user ids from relationship and convert them to array
        $company_user = $company->users()->pluck('user_id')->toArray();
        // fetach all user
            $users = User::all();
         return view('company.company_users',compact('company','users','company_user'));
    }

    public function addUsers(Request $request)
    {
         //destroy|delete company with $id
         $company = Company::find($request->id);
         $company->users()->sync($request->user);

         return response()->json(['message'=>'User added in company successfuly'],200);
    }
}
