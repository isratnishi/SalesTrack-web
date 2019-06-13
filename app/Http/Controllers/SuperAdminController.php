<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DateTimezone;

class SuperAdminController extends BaseController
{
    public function index()
    {
        $dashboard_content = view('pages.dashboard_content');

        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function addProduct()
    {
        $dashboard_content = view('pages.add_product');
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function save_product(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->name;

        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['created_at'] = $time;
        $data['updated_at'] = $time;

        DB::table('product')->insert($data);
        Session::put('message', 'Product Added Successfully!!');
        return Redirect::to('/addProduct');
    }

    public function products(Request $request)
    {
        $products = DB::table('product')
            ->get();
        $dashboard_content = view('pages.add_product')->with('all_product_info', $products);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function delete_product($id)
    {
        DB::table('product')
            ->where('id', $id)
            ->delete();
        return Redirect::to('/addProduct');
    }

    public function edit_product($id)
    {

        $products = DB::table('product')
            ->where('id', $id)
            ->get();
        $dashboard_content = view('pages.add_product')
            ->with('all_product_info', $products);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function update_product(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->name;
        $id = $request->id;

        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['updated_at'] = $time;

        DB::table('product')
            ->where('id', $id)
            ->update($data);

        return Redirect::to('/addProduct');
    }

    public function addRegion()
    {
        /*$admin_id = Session::get('id');
         if ($admin_id == NULL) {
             return Redirect::to('/admin-panel')->send();
         }*/

        $dashboard_content = view('pages.add_region');
        /* ->with('all_category_info', $category)
         ->with('all_company_info', $company);*/
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function save_region(Request $request)
    {
        $data = array();
        $data['region_name'] = $request->name;

        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['created_at'] = $time;
        $data['updated_at'] = $time;

        DB::table('region')->insert($data);
        Session::put('message', 'Region Added Successfully!!');
        return Redirect::to('/addRegion');
    }

    public function region(Request $request)
    {
        $region = DB::table('region')
            ->get();
        $dashboard_content = view('pages.add_region')->with('all_region_info', $region);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function delete_region($id)
    {
        DB::table('region')
            ->where('id', $id)
            ->delete();
        return Redirect::to('/addRegion');
    }

    public function edit_region($id)
    {
        $products = DB::table('region')
            ->where('id', $id)
            ->get();
        $dashboard_content = view('pages.add_region')
            ->with('all_region_info', $products);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function update_region(Request $request)
    {
        $data = array();
        $data['region_name'] = $request->name;
        $id = $request->id;

        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['updated_at'] = $time;

        DB::table('region')
            ->where('id', $id)
            ->update($data);

        return Redirect::to('/addRegion');
    }


    public function addSite()
    {
        $region = DB::table('region')->get();
        $site = DB::table('site')
            ->join('region', 'site.region_id', '=', 'region.id')
            ->get();

        $dashboard_content = view('pages.add_site')
            ->with('all_region_info', $region)
            ->with('all_site_info', $site);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function saveSite(Request $request)
    {
        $data = array();
        $data['site_name'] = $request->name;
        $data['region_id'] = $request->Region;
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['created_at'] = $time;
        $data['updated_at'] = $time;

        DB::table('site')->insert($data);

        Session::put('message', 'Site Added Successfully!!');
        return Redirect::to('/addSite');
    }

    public function deleteSite($id)
    {
        DB::table('site')
            ->where('id', $id)
            ->delete();
        return Redirect::to('/addSite');
    }

    public function editSite($id)
    {
        $site = DB::table('site')
            ->where('id', $id)
            ->get();
        $dashboard_content = view('pages.edit_site')
            ->with('all_site_info', $site);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function updateSite(Request $request)
    {
        $data = array();
        $data['site_name'] = $request->name;
        $id = $request->id;

        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['updated_at'] = $time;

        DB::table('site')
            ->where('id', $id)
            ->update($data);

        return Redirect::to('/addSite');
    }


    public function addVisitSite()
    {
        $site = DB::table('site')->get();
        $salespersonid = DB::table('users')->get();
        $productid = DB::table('product')->get();
        $visitsite = DB::table('visitsite')
            ->join('site', 'visitsite.site_id', '=', 'site.id')
            ->join('users', 'visitsite.salesperson_id', '=', 'users.id')
            ->join('product', 'visitsite.product_id', '=', 'product.id')
            ->get();

        $dashboard_content = view('pages.visit_site')
            ->with('all_site_info', $site)
            ->with('all_salesperson_info', $salespersonid)
            ->with('all_product_info', $productid)
            ->with('all_visitsite_info', $visitsite);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }


    public function saveVisitSite(Request $request)
    {
        $data = array();
        $data['site_id'] = $request->site_name;
        $data['salesperson_id'] = $request->salesperson;
        $data['product_id'] = $request->product;
        $data['location'] = $request->location;
        $data['target'] = $request->target;
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['created_at'] = $time;
        $data['updated_at'] = $time;

        DB::table('visitsite')->insert($data);

        Session::put('message', 'Site Added Successfully!!');
        return Redirect::to('/addVisitSite');
    }

    public function addUser()
    {
        $user = DB::table('users')->get();

        $dashboard_content = view('pages.add_user')
            ->with('all_user_info', $user);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }


    public function saveUser(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['created_at'] = $time;
        $data['updated_at'] = $time;

        DB::table('users')->insert($data);

        Session::put('message', 'Added Successfully!!');
        return Redirect::to('/addUser');
    }


    public function allVisit()
    {
        $site = DB::table('site')->get();
        $salespersonid = DB::table('users')->get();
        $productid = DB::table('product')->get();
        $visitsite = DB::table('savevisit')
            ->join('site', 'savevisit.site_id', '=', 'site.id')
            ->join('users', 'savevisit.salesperson_id', '=', 'users.id')
            ->join('product', 'savevisit.product_id', '=', 'product.id')
            ->get();

        $dashboard_content = view('pages.visit_details')
            ->with('all_site_info', $site)
            ->with('all_salesperson_info', $salespersonid)
            ->with('all_product_info', $productid)
            ->with('all_visitsite_info', $visitsite);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function heirarchy()
    {
        $addcategory = DB::table('caterogy')->get();
        //$parent=DB::table('caterogy')->where('to_be_used_by_user_id', '!=' , 2)->get();
        $dashboard_content = view('pages.heirarchy')
            ->with('all_category_info', $addcategory)
            ->with('all_category_info1', $addcategory);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }

    public function tree()
    {
        $addcategory = DB::table('caterogy')->get();
        //$parent=DB::table('caterogy')->where('to_be_used_by_user_id', '!=' , 2)->get();
        $dashboard_content = view('pages.tree')
            ->with('all_category_info', $addcategory)
            ->with('all_category_info1', $addcategory);
        return view('admin_master')->with('admin_content', $dashboard_content);
    }


    /**
     *
     */
    public function addCategory()
    {
        $genTreeData = $this->generateTree(1, 'Root');
        $json = '{"name": "Root","size": "","children": [' . $genTreeData . ']}';
        return $json;
    }

    public function saveCategory(Request $request)
    {
        $data = array();
        $data['addcategory_name'] = $request->name;
        $data['parent_id'] = $request->parent;
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['created_at'] = $time;
        $data['updated_at'] = $time;

        DB::table('caterogy')->insert($data);

        Session::put('message', 'add category Successfully!!');
        return Redirect::to('/heirarchy');
    }

    public function editCategory(Request $request)
    {
        $data = array();
        $data['id'] = $request->name;
        $data['parent_id'] = $request->parent;
        $id = $request->name;
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $time = $dt->format("Y-m-d h:i:s");
        $data['created_at'] = $time;
        $data['updated_at'] = $time;

        DB::table('caterogy')
            ->where('id', $id)
            ->update($data);
        Session::put('message', 'Edit category Successfully!!');
        return Redirect::to('/heirarchy');
    }


    public function manageCategory()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title', 'id')->all();


        return view('categoryTreeview', compact('categories', 'allCategories'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory1(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        Category::create($input);
        return back()->with('success', 'New Category added successfully.');
    }


    private function generateTree($parrentID, $parrentName)
    {
        $data = null;


        $tmChilds = DB::table('caterogy')->where('parent_id', $parrentID)->get();

        foreach ($tmChilds as $child) {
            $temp2 = $this->generateTree($child->id, $child->addcategory_name);
            if ($data != null) $data .= ',';
            //echo $child->addcategory_name . "<br>";
            $data .= '{"name": "' . $child->addcategory_name . '","size": "' . $parrentID . '","children": [' . $temp2 . ']}';
        }

        //'{"name": "Level 2: A","parent": "Top Level","children": []}';

        return $data;
    }

}