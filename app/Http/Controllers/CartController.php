<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Get current authenticated user ID if logged in (supports web and admin guards).
     */
    protected function getAuthUser()
    {
        if (Auth::guard('web')->check()) {
            return ['id' => Auth::guard('web')->id(), 'type' => 'user'];
        }
        if (Auth::guard('admin')->check()) {
            return ['id' => Auth::guard('admin')->id(), 'type' => 'admin'];
        }
        return null;
    }

    /**
     * Get cart items. If logged in, from database; otherwise returns auth status.
     */
    public function getCart(Request $request)
    {
        $auth = $this->getAuthUser();

        if ($auth) {
            $items = Cart::with('product')
                ->where('user_id', $auth['id'])
                ->where('user_type', $auth['type'])
                ->get()
                ->filter(function ($cartItem) {
                    return $cartItem->product !== null && $cartItem->product->status === 'active';
                })
                ->map(function ($cartItem) {
                    return [
                        'id' => $cartItem->id,
                        'product_id' => $cartItem->product_id,
                        'product_name' => $cartItem->product->product_name,
                        'category' => $cartItem->product->category,
                        'tag' => $cartItem->product->tag,
                        'product_logo' => $cartItem->product->product_logo ? asset('storage/' . $cartItem->product->product_logo) : asset('no_image.jpg'),
                        'bg_color_1' => $cartItem->product->bg_color_1 ?? '#064e3b',
                        'bg_color_2' => $cartItem->product->bg_color_2 ?? '#022c22',
                        'product_color' => $cartItem->product->product_color ?? '#10b981',
                        'quantity' => (int) $cartItem->quantity,
                        'unit_price' => (float) ($cartItem->unit_price ?: 0.85),
                        'subtotal' => $cartItem->subtotal,
                        'discount_rate' => $cartItem->discount_rate,
                        'total_price' => $cartItem->total_price,
                    ];
                })
                ->values();

            return response()->json([
                'logged_in' => true,
                'items' => $items,
                'count' => $items->sum('quantity'),
                'unique_count' => $items->count(),
            ]);
        }

        return response()->json([
            'logged_in' => false,
            'items' => [],
            'count' => 0,
            'unique_count' => 0,
        ]);
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'unit_price' => 'nullable|numeric|min:0',
        ]);

        $product = Product::where('status', 'active')->findOrFail($validated['product_id']);
        $quantity = (int) ($validated['quantity'] ?? 10);
        $unitPrice = (float) ($validated['unit_price'] ?? 0.85);

        $auth = $this->getAuthUser();

        if ($auth) {
            $cartItem = Cart::where('user_id', $auth['id'])
                ->where('user_type', $auth['type'])
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->unit_price = $unitPrice;
                $cartItem->save();
            } else {
                $cartItem = Cart::create([
                    'user_id' => $auth['id'],
                    'user_type' => $auth['type'],
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Product added to your cart.',
                'logged_in' => true,
                'item' => [
                    'product_id' => $product->id,
                    'product_name' => $product->product_name,
                    'quantity' => $cartItem->quantity,
                ],
            ]);
        }

        // Guest user response
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart.',
            'logged_in' => false,
            'product' => [
                'id' => $product->id,
                'product_name' => $product->product_name,
                'category' => $product->category,
                'tag' => $product->tag,
                'product_logo' => $product->product_logo ? asset('storage/' . $product->product_logo) : asset('no_image.jpg'),
                'bg_color_1' => $product->bg_color_1 ?? '#064e3b',
                'bg_color_2' => $product->bg_color_2 ?? '#022c22',
                'product_color' => $product->product_color ?? '#10b981',
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
            ],
        ]);
    }

    /**
     * Update item quantity in cart.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $auth = $this->getAuthUser();

        if ($auth) {
            $cartItem = Cart::where('user_id', $auth['id'])
                ->where('user_type', $auth['type'])
                ->where('product_id', $validated['product_id'])
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $validated['quantity'];
                $cartItem->save();
            }

            return response()->json([
                'success' => true,
                'logged_in' => true,
            ]);
        }

        return response()->json([
            'success' => true,
            'logged_in' => false,
        ]);
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
        ]);

        $auth = $this->getAuthUser();

        if ($auth) {
            Cart::where('user_id', $auth['id'])
                ->where('user_type', $auth['type'])
                ->where('product_id', $validated['product_id'])
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart.',
                'logged_in' => true,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart.',
            'logged_in' => false,
        ]);
    }

    /**
     * Clear all items in cart.
     */
    public function clear(Request $request)
    {
        $auth = $this->getAuthUser();

        if ($auth) {
            Cart::where('user_id', $auth['id'])
                ->where('user_type', $auth['type'])
                ->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared.',
        ]);
    }

    /**
     * Sync local storage cart items into DB when user logs in.
     */
    public function sync(Request $request)
    {
        $auth = $this->getAuthUser();

        if (!$auth) {
            return response()->json(['logged_in' => false]);
        }

        $items = $request->input('items', []);

        if (is_array($items)) {
            foreach ($items as $item) {
                if (empty($item['product_id'])) continue;
                $productId = (int) $item['product_id'];
                $qty = isset($item['quantity']) ? (int) $item['quantity'] : 10;
                $price = isset($item['unit_price']) ? (float) $item['unit_price'] : 0.85;

                $cartItem = Cart::where('user_id', $auth['id'])
                    ->where('user_type', $auth['type'])
                    ->where('product_id', $productId)
                    ->first();

                if ($cartItem) {
                    $cartItem->quantity = max($cartItem->quantity, $qty);
                    $cartItem->save();
                } else {
                    Cart::create([
                        'user_id' => $auth['id'],
                        'user_type' => $auth['type'],
                        'product_id' => $productId,
                        'quantity' => $qty,
                        'unit_price' => $price,
                    ]);
                }
            }
        }

        return $this->getCart($request);
    }
}
