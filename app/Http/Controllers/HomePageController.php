<?php

namespace App\Http\Controllers;

use App\Models\Frontend\home;
use App\Http\Requests\StorehomeRequest;
use App\Http\Requests\UpdatehomeRequest;
use App\Models\Product;
use App\Models\Configer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $data = [];
        $data['configer'] = Configer::latest()->first();
        $data['categories'] = Product::select('category')->get(); // geting category name
        $data['allProducts'] = Product::latest()->take(12)->get();
        $data['products'] = Product::where('status', 'active')
        ->select('id', 'product_name', 'category')
        ->orderBy('product_name')
        ->get()
        ->groupBy('category');
        return view("Pages.home", $data);
    }
    

}
