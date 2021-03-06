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

    public function getAllVisit($id)
    {

        $child = DB::table('visitsite')
            ->where('salesperson_id', $id)
            ->join('site', 'visitsite.site_id', '=', 'site.id')
            ->join('users', 'visitsite.salesperson_id', '=', 'users.id')
            ->join('product', 'visitsite.product_id', '=', 'product.id')
            ->get();

        return json_encode($child);
    }
    public function getUser($email)
    {

        $child = DB::table('users')
            ->where('email', $email)
            ->first();

        return json_encode($child);
    }


    public function saveVisit(Request $request)
    {

        $data = array();
        $data['site_id'] = $request->site_id;
        $data['salesperson_id'] = $request->salesperson_id;
        $data['product_id'] = $request->product_id;
        $data['location'] = $request->location;
        $data['target'] = $request->target;
        $data['targetmeet'] = $request->targetmeet;
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['created_at'] = $time;
        $data['updated_at'] = $time;

        $insert = DB::table('savevisit')->insert($data);

        if ($insert) {
            $status['status'] = "Add Successfully!!";
            return json_encode($status);
        } else {
            $status['status'] = "Somthing Went Wrong!!";
            return json_encode($status);
        }
    }

    public function getAllSaleVisit($id)
    {

        $child = DB::table('savevisit')
            ->where('salesperson_id', $id)
            ->join('site', 'savevisit.site_id', '=', 'site.id')
            ->join('users', 'savevisit.salesperson_id', '=', 'users.id')
            ->join('product', 'savevisit.product_id', '=', 'product.id')
            ->get();

        return json_encode($child);
    }

    public function deleteSaleVisit($id)
    {

        $child = DB::table('visitsite')
            ->where('id', $id)
            ->delete();

        return json_encode($child);
    }

    public function getSiteName($id)
    {

        $child = DB::table('site')
            ->where('id', $id)
            ->first();

        return json_encode($child);
    }

    public function getProductName($id)
    {

        $child = DB::table('product')
            ->where('id', $id)
            ->first();

        return json_encode($child);
    }

    public function deleteSale($id)
    {

        $child = DB::table('savevisit')
            ->where('id', $id)
            ->delete();

        return json_encode($child);
    }
}