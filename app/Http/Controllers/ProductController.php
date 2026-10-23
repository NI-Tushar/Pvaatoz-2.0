<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Action\File;
use App\Models\Package;
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

        // Base query with eager-loaded packages
        $query = Product::with('packages')->orderBy('product_name');

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
            'package_name'       => 'nullable|string|max:150',
            'package_heading'    => 'nullable|string|max:255',
            'package_price'      => 'nullable|numeric|min:0',
            'package_features'   => 'nullable|string',
        ]);

        // 2. Handle File Upload (Logo)
        $logoPath = null;
        if ($request->hasFile('product_logo')) {
            // Store file in 'products' folder inside public disk
            $logoPath = $request->file('product_logo')->store('products', 'public');
        }

        // 3. Create Data
        $product = Product::create([
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

        // 4. Optionally create initial package if provided
        if ($request->filled('package_name') && $request->filled('package_price')) {
            $features = [];
            if ($request->filled('package_features')) {
                $lines = preg_split('/[\r\n]+/', (string) $request->package_features);
                foreach ($lines as $line) {
                    $clean = trim(preg_replace('/^[-*•\x{2022}]\s*/u', '', trim($line)));
                    if (!empty($clean)) {
                        $features[] = $clean;
                    }
                }
            }

            Package::create([
                'product_id'      => $product->id,
                'package_name'    => $request->package_name,
                'package_heading' => $request->package_heading,
                'features'        => $features,
                'price'           => $request->package_price,
                'is_highlight'    => $request->boolean('package_is_highlight'),
                'is_enabled'      => $request->has('package_is_enabled') ? $request->boolean('package_is_enabled') : true,
                'sort_order'      => 0,
            ]);
        }

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

        $updateData = [
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
        ];

        // 2. Handle Logo Update (Only if new file uploaded)
        if ($request->hasFile('product_logo')) {
            // Delete old logo if exists
            if ($product->product_logo && Storage::disk('public')->exists($product->product_logo)) {
                Storage::disk('public')->delete($product->product_logo);
            }

            $updateData['product_logo'] = $request
                ->file('product_logo')
                ->store('products', 'public');
        }

        // 3. Update Product Data
        $product->update($updateData);

        // 4. Handle optional new package creation during product update
        if ($request->filled('new_package_name') && $request->filled('new_package_price')) {
            $features = [];
            if ($request->filled('new_package_features')) {
                $lines = preg_split('/[\r\n]+/', (string) $request->new_package_features);
                foreach ($lines as $line) {
                    $clean = trim(preg_replace('/^[-*•\x{2022}]\s*/u', '', trim($line)));
                    if (!empty($clean)) {
                        $features[] = $clean;
                    }
                }
            }
            Package::create([
                'product_id'      => $product->id,
                'package_name'    => $request->new_package_name,
                'package_heading' => $request->new_package_heading,
                'features'        => $features,
                'price'           => $request->new_package_price,
                'is_highlight'    => $request->boolean('new_package_is_highlight'),
                'is_enabled'      => $request->has('new_package_is_enabled') ? $request->boolean('new_package_is_enabled') : true,
                'sort_order'      => 0,
            ]);
        }

        // 5. Handle bulk updating existing packages if submitted with product
        if ($request->has('packages') && is_array($request->packages)) {
            foreach ($request->packages as $pkgId => $pkgData) {
                $package = Package::where('product_id', $product->id)->find($pkgId);
                if ($package) {
                    $pkgFeatures = [];
                    if (!empty($pkgData['features'])) {
                        $lines = is_array($pkgData['features']) ? $pkgData['features'] : preg_split('/[\r\n]+/', (string) $pkgData['features']);
                        foreach ($lines as $line) {
                            $clean = trim(preg_replace('/^[-*•\x{2022}]\s*/u', '', trim($line)));
                            if (!empty($clean)) {
                                $pkgFeatures[] = $clean;
                            }
                        }
                    }
                    $package->update([
                        'package_name'    => $pkgData['package_name'] ?? $package->package_name,
                        'package_heading' => $pkgData['package_heading'] ?? null,
                        'price'           => $pkgData['price'] ?? $package->price,
                        'features'        => $pkgFeatures,
                        'is_highlight'    => !empty($pkgData['is_highlight']),
                        'is_enabled'      => !empty($pkgData['is_enabled']),
                    ]);
                }
            }
        }

        // 6. Redirect back
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
