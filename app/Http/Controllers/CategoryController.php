<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function getList()
    {
        $cats = Category::all();
        $pcat = Category::all();
        return view('admin.category.list', compact('cats', 'pcat'));
    }

    public function create()
    {
        $checkName = Category::where('name', $_POST['name'])->first();
        $checkParent = Category::find($_POST['parent_id']);

        $errorName = "";
        $errorParent = "";

        if (empty($_POST['name'])) {
            $errorName = "<li class='error'>The Name field is required.</li>";
        } elseif (count($checkName) > 0) {
            $errorName = "<li class='error'>The Name field has a duplicate value.</li>";
        }

        if (count($checkParent) == 0 && $_POST['parent_id'] != 0)
            $errorParent = "<li class='error'>The selected Parent Category is invalid.</li>";

        if ($errorName == null && $errorParent == null) {
            Category::create([
                'name'      => $_POST['name'],
                'slug'      => str_slug($_POST['name']),
                'parent_id' => $_POST['parent_id'],
                'status'    => $_POST['status'],
            ]);

//            $cat = new Category();
//            $cat->name = $_POST['name'];
//            $cat->slug = str_slug($_POST['name']);
//            $cat->parent_id = $_POST['parent_id'];
//            $cat->status = $_POST['status'];
//            $cat->save();

            $data = "success";
        } else {
            $data = [
                'errorName' => $errorName,
                'errorParent' => $errorParent
            ];
        }

        return $data;
    }

    public function edit()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $cat_name = str_replace(' ', '', $name);
        $parent = $_POST['parent_id'];
        $status = (int)$_POST['status'];

        $cat = Category::find($id);
        $checkName = Category::where('name', $name)->where('name', '<>', $cat->name)->first();
        $checkParent = Category::find($parent);

        $errorName = "";
        $errorParent = "";

        if (empty($cat_name)) {
            $errorName = "<li class='error'>The Name field is required.</li>";
        } else {
            if (count($checkName) > 0)
                $errorName = "<li class='error'>The Name field has a duplicate value.</li>";
        }

        if (count($checkParent) == 0 && $parent != 0)
            $errorParent = "<li class='error'>The selected Parent Category is invalid.</li>";

        if ($errorName == null && $errorParent == null) {
//            Category::find($id)->update([
//                'name' => $name,
//                'slug' => str_slug($name),
//                'parent_id' => $parent,
//                'status' => $status
//            ]);

            $cat = Category::find($id);
            $cat->name = $name;
            $cat->slug = str_slug($name);
            $cat->parent_id = $parent;
            $cat->status = $status;
            $cat->save();

            $data = "success";
        } else {
            $data = [
                'errorName' => $errorName,
                'errorParent' => $errorParent
            ];
        }

//        return Response::json($data);
        return $data;
    }

    public function destroy()
    {
        $id = $_POST['id'];
        $count = Category::where('parent_id', $id)->count();

        if ($count == 0) {
            Category::destroy($id);
//            Category::find($id)->delete();
            $data = "success";
        } else {
            $data = "Can not delete this category, it is a parent category.";
        }

        return $data;
    }
}
