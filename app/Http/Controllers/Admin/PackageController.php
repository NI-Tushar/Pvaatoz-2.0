<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Store a newly created package for a specific product.
     */
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $validated = $request->validate([
            'package_name'    => 'required|string|max:150',
            'package_heading' => 'nullable|string|max:255',
            'features'        => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'is_highlight'    => 'nullable',
            'is_enabled'      => 'nullable',
            'sort_order'      => 'nullable|integer',
        ]);

        $featuresArray = $this->parseFeatures($request->input('features'));

        $package = Package::create([
            'product_id'      => $product->id,
            'package_name'    => $validated['package_name'],
            'package_heading' => $validated['package_heading'] ?? null,
            'features'        => $featuresArray,
            'price'           => $validated['price'],
            'is_highlight'    => $request->boolean('is_highlight'),
            'is_enabled'      => $request->has('is_enabled') ? $request->boolean('is_enabled') : true,
            'sort_order'      => $request->input('sort_order', 0),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Package created successfully.',
                'package' => $package,
            ]);
        }

        return redirect()->back()->with('success', 'Package created successfully for ' . $product->product_name . '.');
    }

    /**
     * Update the specified package.
     */
    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'package_name'    => 'required|string|max:150',
            'package_heading' => 'nullable|string|max:255',
            'features'        => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'is_highlight'    => 'nullable',
            'is_enabled'      => 'nullable',
            'sort_order'      => 'nullable|integer',
        ]);

        $featuresArray = $this->parseFeatures($request->input('features'));

        $package->update([
            'package_name'    => $validated['package_name'],
            'package_heading' => $validated['package_heading'] ?? null,
            'features'        => $featuresArray,
            'price'           => $validated['price'],
            'is_highlight'    => $request->boolean('is_highlight'),
            'is_enabled'      => $request->has('is_enabled') ? $request->boolean('is_enabled') : false,
            'sort_order'      => $request->input('sort_order', $package->sort_order ?? 0),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Package updated successfully.',
                'package' => $package,
            ]);
        }

        return redirect()->back()->with('success', 'Package "' . $package->package_name . '" updated successfully.');
    }

    /**
     * Toggle package enabled / disabled status.
     */
    public function toggle(Package $package)
    {
        $package->is_enabled = !$package->is_enabled;
        $package->save();

        if (request()->wantsJson()) {
            return response()->json([
                'success'    => true,
                'is_enabled' => $package->is_enabled,
                'message'    => 'Package ' . ($package->is_enabled ? 'enabled' : 'disabled') . ' successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Package status updated to ' . ($package->is_enabled ? 'Enabled' : 'Disabled') . '.');
    }

    /**
     * Remove the specified package from storage.
     */
    public function destroy(Package $package)
    {
        $packageName = $package->package_name;
        $package->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Package deleted successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Package "' . $packageName . '" deleted successfully.');
    }

    /**
     * Parse raw string features into clean array.
     */
    private function parseFeatures($features): array
    {
        if (empty($features)) {
            return [];
        }

        if (is_array($features)) {
            return array_values(array_filter(array_map('trim', $features)));
        }

        $lines = preg_split('/[\r\n]+/', (string) $features);
        $clean = [];
        foreach ($lines as $line) {
            $trimmed = trim($line);
            // remove leading bullets or dashes if present
            $trimmed = preg_replace('/^[-*•\x{2022}]\s*/u', '', $trimmed);
            if (!empty($trimmed)) {
                $clean[] = $trimmed;
            }
        }

        return array_values($clean);
    }
}
