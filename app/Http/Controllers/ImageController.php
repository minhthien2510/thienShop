<?php

namespace App\Http\Controllers;

use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function getList()
    {
        $imgs = DB::table('images')->orderBy('pro_id')->get();
        $pros = Product::all();
        return view('admin.product.imglist', compact('pros', 'imgs'));
    }

    public function create()
    {
        //    Image::insert([
        //        'name' => $_POST['name'],
        //        'pro_id' => $_POST['pro_id']
        //    ]);

        $img = new Image();
        $img->name = $_POST['name'];
        $img->pro_id = $_POST['pro_id'];
        $img->save();

        return "success";
    }

    public function update()
    {
        Image::where([['pro_id', $_POST['pro_id']], ['cover_image', 1]])->update(['cover_image' => 0]);
        Image::where('id', $_POST['id'])->update(['cover_image' => 1]);

        return 'success';
    }

    public function destroy()
    {
        $img = Image::find($_POST['id']);
        if ($img->cover_image == 1)
            return 'error';

        Image::destroy($_POST['id']);

        return "success";
    }
}
