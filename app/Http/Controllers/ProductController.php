<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Action\File;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $allProducts = Product::select('id', 'product_name')
            ->orderBy('product_name')
            ->get();

        // Base query
        $query = Product::orderBy('product_name');

        // Filter by product dropdown
        if ($request->filled('product_id')) {
            $query->where('id', $request->product_id);
        }

        // Search by product name
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        return view('Backend.Pages.Product.index', compact('products', 'allProducts'));
    }


    public function search(Request $request){
        dd($request->all());
    }
        
    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'category'           => 'nullable|string|max:100',
            'tag'                => 'nullable|string|max:100',
            'popularity'         => 'nullable|in:hot,popular,normal',
            'product_logo'       => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // 2MB max
            'bg_color_1'         => 'nullable|string', // First gradient color
            'bg_color_2'         => 'nullable|string', // Second gradient color
            'product_color'      => 'nullable|string', 
            'product_name'       => 'nullable|string|max:100',
            'feature_list'       => 'nullable|string',
            'product_desc'       => 'nullable|string',
            'status'             => 'nullable|in:active,disabled',
        ]);

        // 2. Handle File Upload (Logo)
        $logoPath = null;
        if ($request->hasFile('product_logo')) {
            // Store file in 'products' folder inside public disk
            $logoPath = $request->file('product_logo')->store('products', 'public');
        }

        // 4. Create Data
        // Assuming your model is named 'Product'
        Product::create([
            'category'       => $request->category,
            'tag'            => $request->tag,
            'popularity'     => $request->popularity,
            'product_logo'   => $logoPath,
            'bg_color_1'     => $request->bg_color_1,
            'bg_color_2'     => $request->bg_color_2,
            'product_color'  => $request->product_color,
            'product_name'   => $request->product_name,
            'feature_list'   => $request->feature_list,
            'product_desc'   => $request->product_desc,
            'status'         => $request->status,
        ]);

        // 5. Redirect with success message
        return redirect()->back()->with('success', 'Product created successfully.');
    }

    public function update(Request $request, Product $product)
    {
        // 1. Validation
        $request->validate([
            'category'       => 'nullable|string|max:100',
            'tag'            => 'nullable|string|max:100',
            'popularity'     => 'nullable|in:hot,popular,normal',
            'product_logo'   => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'bg_color_1'     => 'nullable|string',
            'bg_color_2'     => 'nullable|string',
            'product_color'  => 'nullable|string',
            'product_name'   => 'nullable|string|max:100',
            'feature_list'   => 'nullable|string',
            'product_desc'   => 'nullable|string',
            'status'         => 'nullable|in:active,disabled',
        ]);

        // 2. Handle Logo Update (Only if new file uploaded)
        if ($request->hasFile('product_logo')) {

            // Delete old logo if exists
            if ($product->product_logo && \Storage::disk('public')->exists($product->product_logo)) {
                \Storage::disk('public')->delete($product->product_logo);
            }

            $product->product_logo = $request
                ->file('product_logo')
                ->store('products', 'public');
        }

        // 3. Update Product Data
        $product->update([
            'category'       => $request->category,
            'tag'            => $request->tag,
            'popularity'     => $request->popularity,
            'bg_color_1'     => $request->bg_color_1,
            'bg_color_2'     => $request->bg_color_2,
            'product_color'  => $request->product_color,
            'product_name'   => $request->product_name,
            'feature_list'   => $request->feature_list,
            'product_desc'   => $request->product_desc,
            'status'         => $request->status,
        ]);

        // 4. Redirect back
        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    public function destroy($product_id)
    {
        // Find product
        $product = Product::findOrFail($product_id);

        // Delete product image if exists
        if ($product->product_logo && Storage::disk('public')->exists($product->product_logo)) {
            Storage::disk('public')->delete($product->product_logo);
        }

        // Delete product record
        $product->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
