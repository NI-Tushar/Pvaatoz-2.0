<?php

namespace App\Http\Controllers;

use App\Models\Frontend\home;
use App\Http\Requests\StorehomeRequest;
use App\Http\Requests\UpdatehomeRequest;
use App\Models\Product;
use App\Models\Configer;
use App\Models\Contact;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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

        // Base query with active packages eager-loaded
        $query = Product::with('activePackages')
            ->where('status', 'active')
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
            $data['allProducts'] = Product::with('activePackages')
                ->where('status', 'active')
                ->latest()
                ->take(12)
                ->get();
        }

        // Hero dashboard visual products (products enabled from admin panel for hero showcase)
        $data['heroProducts'] = Product::where('status', 'active')
            ->where('show_in_hero', true)
            ->orderBy('id', 'asc')
            ->get();

        return view("Pages.home", $data);
    }

    /**
     * Display the specified product detail page.
     */
    public function productDetail($id)
    {
        $product = Product::with('activePackages')->where('status', 'active')->findOrFail($id);

        // Fetch related products in the same category, or fallback to any active products
        $relatedProducts = Product::where('status', 'active')
            ->where('id', '!=', $product->id)
            ->where('category', $product->category)
            ->take(4)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::where('status', 'active')
                ->where('id', '!=', $product->id)
                ->take(4)
                ->get();
        }

        return view('Pages.product_detail', compact('product', 'relatedProducts'));
    }

    /**
     * Display the all products catalog page with backend search, category filter, and pagination (20 per page).
     */
    public function products(Request $request)
    {
        $configer = Configer::latest()->first();

        // Get all active categories with counts
        $categories = Product::where('status', 'active')
            ->select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        $totalActiveCount = Product::where('status', 'active')->count();

        // Base query with activePackages eager-loaded
        $query = Product::with('activePackages')->where('status', 'active');

        // Backend Search filter (searches product_name, category, tag, description)
        if ($request->filled('search')) {
            $searchTerm = trim($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('product_name', 'like', "%{$searchTerm}%")
                  ->orWhere('category', 'like', "%{$searchTerm}%")
                  ->orWhere('tag', 'like', "%{$searchTerm}%")
                  ->orWhere('product_desc', 'like', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'name_asc' => $query->orderBy('product_name', 'asc'),
            'name_desc' => $query->orderBy('product_name', 'desc'),
            'oldest' => $query->oldest(),
            default => $query->latest(),
        };

        // Paginate exactly 20 products per page with query string preservation
        $products = $query->paginate(20)->withQueryString();

        return view('Pages.products', compact('products', 'categories', 'configer', 'totalActiveCount'));
    }

    /**
     * Display the About Us page.
     */
    public function about()
    {
        $configer = Configer::latest()->first();
        $totalProducts = Product::where('status', 'active')->count();
        $categories = Product::where('status', 'active')
            ->select('category')
            ->distinct()
            ->get();

        return view('Pages.about', compact('configer', 'totalProducts', 'categories'));
    }

    /**
     * Display the Contact Us page.
     */
    public function contact()
    {
        $configer = Configer::latest()->first();
        $categories = Product::where('status', 'active')
            ->select('category')
            ->distinct()
            ->get();

        return view('Pages.contact', compact('configer', 'categories'));
    }

    /**
     * Handle contact form submission.
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:40',
            'service' => 'nullable|string|max:100',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:3000',
        ]);

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'service' => $validated['service'] ?? 'General Inquiry',
            'subject' => $validated['subject'] ?? 'Website Inquiry',
            'message' => $validated['message'],
        ]);

        return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully. Our support team will get back to you shortly.');
    }

    /**
     * Display the checkout page.
     */
    public function checkout(Request $request, $id = null)
    {
        $configer = Configer::latest()->first();
        $authId = auth()->id() ?? auth()->guard('admin')->id();
        $authType = auth()->check() ? 'user' : (auth()->guard('admin')->check() ? 'admin' : null);

        // Fetch DB cart items if user is logged in
        $dbCartItems = collect();
        if ($authId) {
            $dbCartItems = \App\Models\Cart::with('product')
                ->where('user_id', $authId)
                ->where('user_type', $authType)
                ->get()
                ->filter(function ($item) {
                    return $item->product && $item->product->status === 'active';
                })
                ->values();
        }

        // If an ID is passed, find that product; otherwise use query param or first active product
        if ($id) {
            $product = Product::where('status', 'active')->findOrFail($id);
        } else {
            $productId = $request->query('product_id');
            if ($productId) {
                $product = Product::where('status', 'active')->find($productId);
            }
            if (!isset($product) || !$product) {
                if ($dbCartItems->isNotEmpty()) {
                    $product = $dbCartItems->first()->product;
                } else {
                    $product = Product::where('status', 'active')->first();
                }
            }
        }

        if (!$product) {
            return redirect()->route('home')->with('error', 'No products available for checkout.');
        }

        // Get all active products for the selector dropdown
        $allProducts = Product::where('status', 'active')
            ->select('id', 'product_name', 'category', 'product_logo', 'bg_color_1', 'bg_color_2', 'product_color', 'tag')
            ->orderBy('product_name')
            ->get();

        // Get enabled payment methods configured from admin panel
        $paymentMethods = \App\Models\PaymentMethod::where('is_enabled', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Get active packages for this product
        $productPackages = $product->activePackages;

        // Selected package for this product
        $selectedPackage = null;
        if ($request->has('package_id')) {
            $selectedPackage = \App\Models\Package::where('product_id', $product->id)
                ->where('is_enabled', true)
                ->find($request->query('package_id'));
        }
        if (!$selectedPackage && $productPackages->isNotEmpty()) {
            $selectedPackage = $productPackages->firstWhere('is_highlight', true) ?? $productPackages->first();
        }

        return view('Pages.checkout', compact('product', 'configer', 'allProducts', 'productPackages', 'dbCartItems', 'paymentMethods', 'selectedPackage'));
    }

    /**
     * User Account Dashboard: Profile, Orders & Live Cart Overview
     */
    public function account()
    {
        $user = auth()->user() ?? auth()->guard('admin')->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $configer = Configer::latest()->first();
        $isAdmin = auth()->guard('admin')->check();
        $authType = $isAdmin ? 'admin' : 'user';

        // 1. Fetch Orders from real orders table, with fallback to legacy contact messages
        $dbOrders = \App\Models\Order::with('items')
            ->where(function ($q) use ($user, $isAdmin) {
                if ($isAdmin) {
                    $q->where('customer_email', $user->email);
                } else {
                    $q->where('user_id', $user->id)
                      ->orWhere('customer_email', $user->email);
                }
            })
            ->latest()
            ->get();

        if ($dbOrders->isNotEmpty()) {
            $orders = $dbOrders->map(function ($ord) {
                $firstItemName = $ord->items->first()?->product_name ?? 'Accounts Package';
                $moreCount = $ord->items->count() > 1 ? ' +' . ($ord->items->count() - 1) . ' more' : '';
                $ord->service = 'Order #' . $ord->order_number . ': ' . $firstItemName . $moreCount;
                $ord->items_summary = $ord->items->map(function ($it) {
                    return $it->product_name . ' (' . $it->quantity . ' accounts)';
                })->join(', ');
                return $ord;
            });
        } else {
            // Fallback for legacy inquiries
            $rawOrders = Contact::where('email', $user->email)
                ->where('service', 'like', 'Cart Order%')
                ->latest()
                ->get();

            $orders = $rawOrders->map(function ($order) {
                preg_match('/\(\$([0-9.]+)\)/', $order->subject, $priceMatch);
                $order->total_price = isset($priceMatch[1]) ? (float) $priceMatch[1] : 0.00;

                preg_match('/([0-9]+)\s+accounts/i', $order->subject, $qtyMatch);
                $order->total_quantity = isset($qtyMatch[1]) ? (int) $qtyMatch[1] : 1;

                preg_match('/Payment Method:\s*(.+)/i', $order->message, $pmMatch);
                $order->payment_method = isset($pmMatch[1]) ? trim($pmMatch[1]) : 'Online / Crypto';

                preg_match('/Items Ordered:\s*(.*?)\n(?:Total Quantity|$)/s', $order->message, $itemsMatch);
                $order->items_summary = isset($itemsMatch[1]) ? trim($itemsMatch[1]) : $order->service;

                return $order;
            });
        }

        // 2. Fetch User's Active Database Cart
        $cartItems = Cart::with('product')
            ->where('user_id', $user->id)
            ->where('user_type', $authType)
            ->get()
            ->filter(function ($item) {
                return $item->product !== null && $item->product->status === 'active';
            });

        $cartTotal = $cartItems->sum(function ($item) {
            return $item->total_price;
        });
        $cartCount = $cartItems->sum('quantity');

        // 3. User Overview Stats
        $totalOrdersCount = $orders->count();
        $totalAccountsPurchased = $orders->sum('total_quantity');
        $totalSpent = $orders->sum('total_price');

        return view('Pages.account', compact(
            'user',
            'configer',
            'orders',
            'cartItems',
            'cartTotal',
            'cartCount',
            'totalOrdersCount',
            'totalAccountsPurchased',
            'totalSpent',
            'isAdmin'
        ));
    }

    /**
     * Update user account profile information
     */
    public function updateAccount(Request $request)
    {
        $user = auth()->user() ?? auth()->guard('admin')->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:40',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user->name = $validated['name'];
        if (array_key_exists('phone', $validated)) {
            $user->phone = $validated['phone'];
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('users', 'public');
            $user->image = 'storage/' . $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile information updated successfully!')->with('tab', 'profile');
    }

    /**
     * Update user password from dashboard
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user() ?? auth()->guard('admin')->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'The provided current password does not match our records.'])
                ->with('tab', 'security');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!')->with('tab', 'security');
    }

    /**
     * Handle checkout order submission.
     */
    public function submitCheckout(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'package_id' => 'nullable|exists:packages,id',
            'quantity' => 'nullable|integer|min:1',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:40',
            'payment_method' => 'required|string|max:50',
            'notes' => 'nullable|string|max:1000',
            'cart_items' => 'nullable|string',
        ]);

        $totalPrice = $request->input('total_price', '0.00');
        $rawCartItems = $request->input('cart_items');
        $cartItems = !empty($rawCartItems) ? json_decode($rawCartItems, true) : null;

        $itemsSummaryText = "";
        $orderProductName = "";
        $totalQuantity = 0;
        $orderTag = null;

        if (is_array($cartItems) && count($cartItems) > 0) {
            $orderProductName = count($cartItems) . " Items (Multi-Product Cart)";
            foreach ($cartItems as $idx => $cItem) {
                $pName = $cItem['product_name'] ?? ('Product #' . ($cItem['product_id'] ?? ''));
                $q = $cItem['quantity'] ?? 1;
                $tot = $cItem['total_price'] ?? ($cItem['subtotal'] ?? 0);
                $totalQuantity += (int) $q;
                $itemsSummaryText .= "  [" . ($idx + 1) . "] " . $pName . " - " . $q . " accounts ($" . $tot . ")\n";
            }
        } else {
            $product = Product::findOrFail($validated['product_id'] ?? 1);
            $packageId = $request->input('package_id');
            $package = $packageId ? \App\Models\Package::find($packageId) : null;
            $pkgName = $package ? $package->package_name : ($request->input('package_name') ?: '');

            $baseProductName = !empty(trim($product->product_name ?? '')) 
                ? $product->product_name 
                : (!empty(trim($product->tag ?? '')) 
                    ? $product->tag 
                    : (!empty(trim($product->category ?? '')) 
                        ? ucwords(str_replace('_', ' ', $product->category)) 
                        : 'Product #' . $product->id));

            $orderProductName = $pkgName ? ($baseProductName . ' (' . $pkgName . ')') : $baseProductName;
            $orderTag = $package ? $package->package_name : $product->tag;
            $totalQuantity = (int) ($validated['quantity'] ?? ($package ? $package->account_count : 1));
            $itemsSummaryText = "  [1] " . $orderProductName . " - " . $totalQuantity . " accounts ($" . $totalPrice . ")\n";
        }

        $methodModel = \App\Models\PaymentMethod::where('slug', $validated['payment_method'])->first();
        $methodDisplayName = $methodModel ? $methodModel->name : ucfirst($validated['payment_method']);

        // 1. Create Real Order in database
        $orderNumber = 'AV-' . date('ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5));
        
        // Ensure user_id strictly references an existing record in the users table (never admin guard id)
        $authUserId = null;
        if (auth()->guard('web')->check()) {
            $candidateId = auth()->guard('web')->id();
            if (\App\Models\User::where('id', $candidateId)->exists()) {
                $authUserId = $candidateId;
            }
        } elseif (!empty($validated['email'])) {
            $matchedUser = \App\Models\User::where('email', $validated['email'])->first();
            if ($matchedUser) {
                $authUserId = $matchedUser->id;
            }
        }

        $order = \App\Models\Order::create([
            'order_number' => $orderNumber,
            'user_id' => $authUserId,
            'customer_name' => $validated['name'],
            'customer_email' => $validated['email'],
            'customer_phone' => $validated['phone'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'status' => 'pending',
            'total_quantity' => $totalQuantity,
            'total_price' => (float) $totalPrice,
            'ip_address' => $request->ip(),
        ]);

        // 2. Create Order Items
        if (is_array($cartItems) && count($cartItems) > 0) {
            foreach ($cartItems as $cItem) {
                $cartProduct = !empty($cItem['product_id'])
                    ? Product::find($cItem['product_id'])
                    : null;
                $cartProductName = !empty(trim($cItem['product_name'] ?? ''))
                    ? $cItem['product_name']
                    : (!empty(trim($cartProduct?->product_name ?? ''))
                        ? $cartProduct->product_name
                        : (!empty(trim($cartProduct?->tag ?? ''))
                            ? $cartProduct->tag
                            : ('Product #' . ($cItem['product_id'] ?? $cartProduct?->id ?? ''))));

                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cItem['product_id'] ?? null,
                    'product_name' => $cartProductName,
                    'category' => $cItem['category'] ?? $cartProduct?->category,
                    'tag' => $cItem['tag'] ?? $cartProduct?->tag,
                    'quantity' => (int) ($cItem['quantity'] ?? 1),
                    'unit_price' => (float) ($cItem['unit_price'] ?? 0.85),
                    'subtotal' => (float) ($cItem['total_price'] ?? ($cItem['subtotal'] ?? 0)),
                    'product_logo' => $cItem['product_logo'] ?? ($cartProduct?->product_logo ? asset('storage/' . $cartProduct->product_logo) : null),
                ]);
            }
        } else {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $orderProductName,
                'category' => $product->category,
                'tag' => $orderTag ?? $product->tag,
                'quantity' => $totalQuantity,
                'unit_price' => $totalQuantity > 0 ? ((float) $totalPrice / $totalQuantity) : 0.85,
                'subtotal' => (float) $totalPrice,
                'product_logo' => $product->product_logo ? asset('storage/' . $product->product_logo) : null,
            ]);
        }

        // 3. Keep contact inquiry record for notification redundancy
        $orderMessage = "NEW ORDER PLACED VIA CHECKOUT [Order #{$orderNumber}]:\n" .
            "Order Type: " . (is_array($cartItems) && count($cartItems) > 1 ? 'Multiple Products Cart' : 'Direct Order') . "\n" .
            "Items Ordered:\n" . $itemsSummaryText .
            "Total Quantity: " . $totalQuantity . " accounts\n" .
            "Total Order Price: $" . $totalPrice . "\n" .
            "Payment Method: " . $methodDisplayName . "\n" .
            "Customer Name: " . $validated['name'] . "\n" .
            "Customer Email: " . $validated['email'] . "\n" .
            "Customer Phone/WhatsApp: " . ($validated['phone'] ?? 'Not provided') . "\n" .
            "Order Notes: " . ($validated['notes'] ?? 'None');

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'service' => 'Cart Order: ' . $orderProductName,
            'subject' => 'Checkout Order #' . $orderNumber . ' - ' . $totalQuantity . ' accounts ($' . $totalPrice . ')',
            'message' => $orderMessage,
        ]);

        // 4. Parallel Dispatch Order Taking Notifications (Telegram, Discord, Email)
        try {
            app(\App\Services\OrderNotificationService::class)->sendOrderNotifications($order);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Order notification dispatch error: ' . $e->getMessage());
        }

        // If user logged in, clear their DB cart
        $authId = auth()->id() ?? auth()->guard('admin')->id();
        $authType = auth()->check() ? 'user' : (auth()->guard('admin')->check() ? 'admin' : null);
        if ($authId) {
            \App\Models\Cart::where('user_id', $authId)
                ->where('user_type', $authType)
                ->delete();
        }

        return redirect()->back()->with('order_success', [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'product_name' => $orderProductName,
            'quantity' => $totalQuantity,
            'total_price' => $totalPrice,
            'email' => $validated['email'],
            'payment_method' => $methodDisplayName,
            'clear_cart' => true,
        ]);
    }
}
