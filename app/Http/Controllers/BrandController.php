<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brand.index');
    }

    public function getList()
    {
        $brands = DB::table('brands')->get();

        return view('admin.brand.list', compact('brands'));
    }

    public function create()
    {
        $countName = DB::table('brands')->where('name', $_POST['name'])->count();
        $errorName = "";

        if (empty($_POST['name'])) {
            $errorName = "<li class='error'>The Name field is required.</li>";
        } elseif ($countName > 0) {
            $errorName = "<li class='error'>The Name field has a duplicate value.</li>";
        }

        if ($errorName == null) {
            Brand::insert([
                'name'      => $_POST['name'],
                'slug'      => str_slug($_POST['name']),
                'status'    => $_POST['status']
            ]);

//            $brand = new Brand([
//                'name'      => $_POST['name'],
//                'slug'      => str_slug($_POST['name']),
//                'status'    => $_POST['status']
//            ]);
//            $brand->save();

            $data = "success";
        } else {
            $data = ['errorName' => $errorName];
        }

        return $data;
    }

    public function edit()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $checkName = str_replace(' ', '', $name);
        $status = $_POST['status'];

        $brand = Brand::find($id);
        $countName = Brand::where([['name', '=', $name], ['name', '<>', $brand->name]])->count();

        $errorName = "";

        if (empty($checkName)) {
            $errorName = "<li class='error'>The Name field is required.</li>";
        } else {
            if ($countName > 0)
                $errorName = "<li class='error'>The Name field has a duplicate value.</li>";
        }

        if ($errorName == null) {
//            Brand::find($id)->update([
//                'name' => $name,
//                'slug' => str_slug($name),
//                'status' => $status
//            ]);

            $cat = Brand::find($id);
            $cat->name = $name;
            $cat->slug = str_slug($name);
            $cat->status = $status;
            $cat->save();

            $data = "success";
        } else {
            $data = ['errorName' => $errorName];
        }

        return $data;
    }

    public function destroy()
    {
        $checkBrand = DB::table('products')->where('brand_id', $_POST['id'])->count();

        if ($checkBrand == 0) {
            Brand::destroy($_POST['id']);
            $data = "success";
        } else {
            $data = "Can not delete this brand.";
        }

        return $data;
    }
}
