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
    public function index(Request $request)
    {
        $data['configer'] = Configer::latest()->first();

        // Category list
        $data['categories'] = Product::select('category')
            ->distinct()
            ->orderBy('category')
            ->get();

        // Base query (NO select here)
        $query = Product::where('status', 'active')
            ->orderBy('product_name');

        $hasFilter = false;

        // Search filter
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
            $hasFilter = true;
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
            $hasFilter = true;
        }

        // Filtered products (full rows)
        $filteredProducts = $query->get();

        $data['products'] = $filteredProducts->groupBy('category');

        // allProducts logic
        if ($hasFilter) {
            $data['allProducts'] = $filteredProducts;
        } else {
            $data['allProducts'] = Product::where('status', 'active')
                ->latest()
                ->take(12)
                ->get();
        }

        return view("Pages.home", $data);
    }



    

}
