<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Session::get('id');
        if ($id != NULL) {
            return Redirect::to('/dashboard')->send();
        }
        return view('login');

    }

    public function loginCheck(Request $request)
    {
        $admin_email_address = $request->email;
        $admin_password = $request->password;

        $result = DB::table('users')
            ->where('email', $admin_email_address)
            ->where('password', $admin_password)
            ->first();


        if ($result) {
            // return view('admin.admin_master');
            $designation = Designation::find($result->designationId);
            Session::put('name', $result->name);
            Session::put('id', $result->id);
            Session::put('designationId', $result->designationId);
            Session::put('designationName', $designation->name);
            Session::put('imageUrl', $result->imageUrl);
            Session::put('contactNumber', $result->contactNumber);
            Session::put('signature', $result->signature);
            return Redirect::to('/dashboard');

        } else {
            Session::put('exception', 'UserID or Password is invalid');
            return Redirect::to('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
