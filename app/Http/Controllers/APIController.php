<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimezone;
use League\Flysystem\Exception;

class APIController extends Controller
{
    public function login(Request $request)
    {
        $admin_email_address = $request->email;
        $admin_password = $request->password;

        $result = DB::table('users')
            ->where('email', $admin_email_address)
            ->where('password', $admin_password)
            ->first();

//        if (Hash::check($admin_password, $result->password)) {
//            return response()->json(compact('token'));
//        } else {
//            return response()->json(['error_code' => 'could_not_create_token'], 500);
//        }

        if ($result) {
            return json_encode($result);
        } else {
            return json_encode("Invalid Credential");
        }
    }

}