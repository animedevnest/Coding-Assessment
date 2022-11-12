<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetching all the users from user table
        $users = User::all();
        
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return crate blade
        return view('users.create');
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
        //email valition unique email
       $request->validate([
        'email' => 'required|email|unique:users,email',
        'name' => 'required|regex:/^[a-zA-Z]+$/u'
       ]);
        try{
            //store the user data
            $user = User::create(['email' => $request->email,
            'name' => $request->name,
            'password' => $request->name]);
        }
        catch(Exception $e){
            return $e;
        }
        return redirect('user');
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
        //fetching user with the provided id
        try{
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            if ($e instanceof ModelNotFoundException) {
                return back()->withError('Record not found');
            }
        }
        return view('users.edit',compact('user','id'));
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
        //email valition unique email
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'name' => 'required|regex:/^[a-zA-Z]+$/u'
           ]);
        //updating the user data related to the $id
        try{
            $user = User::where('id',$id)->update(['email' => $request->email,
            'name' => $request->name]);
        }
        catch(Exception $e){
            return $e;
        }
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //destroy|delete user with $id
        try{
            $user = User::findOrFail($request->id);
        }
        catch (ModelNotFoundException $e) {
            if ($e instanceof ModelNotFoundException) {
                return back()->withError('Record not found');
            }
        }
        $user->delete();
        return response()->json(['message'=>'User deleted successfuly'],200);
    }
}
