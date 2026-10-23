@extends('Backend.Layouts.master')
@section('title', 'Products')
@section('master-content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Custom Scrollbar for Textareas */
        textarea::-webkit-scrollbar {
            width: 8px;
        }
        textarea::-webkit-scrollbar-track {
            background: transparent; 
        }
        textarea::-webkit-scrollbar-thumb {
            background: #ffffff50; 
            border-radius: 4px;
        }
        textarea::-webkit-scrollbar-thumb:hover {
            background: #ffffff80; 
        }

        /* Select arrow color fix for dark inputs */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            -webkit-appearance: none;
            appearance: none;
        }
    </style>

    <!-- success message start -->
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="fixed top-5 right-5 z-50 flex items-center gap-3 bg-green-600 text-white px-5 py-3 rounded-lg shadow-lg" >
            <i class="fas fa-check-circle text-lg"></i>
            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>
        </div>
    @endif
    <!-- success message end -->
    <!-- error message start -->
    @if ($errors->any())
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
        class="fixed top-5 right-5 z-50 bg-red-600 text-white px-5 py-3 rounded-lg shadow-lg max-w-sm">
        <strong class="block text-sm font-semibold mb-1">Validation Error</strong>
        <ul class="text-xs space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- error message end -->

    <!-- add new product start -->
    <div x-data="{ open: false }" class="p-5">
        <!-- Toggle Button -->
        <div class="flex justify-end">
            <button @click="open = !open" class="mb-4 px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Add Product +
            </button>
        </div>
        <div x-show="open"
            x-transition
            @click.outside="open = false" class="min-h-screen py-10 px-4 font-sans text-gray-700">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-6 text-center">
                    <h1 class="text-2xl font-bold text-white">Add New Product</h1>
                    <p class="text-gray-500 text-sm mt-1">Configure product details, visuals, and status.</p>
                </div>

                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="rounded-xl shadow-sm border border-[#ffffff28] overflow-hidden">
                    @csrf
                    <div class="p-6 md:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Tag -->
                            <div>
                                <label for="tag" class="block text-sm font-medium text-gray-400 mb-1">Tag</label>
                                <input type="text" name="tag" id="tag" placeholder="e.g. New Arrival" 
                                    class="w-full bg-transparent rounded-lg border-[#ffffff28] border px-4 py-2.5 outline-none text-white">
                            </div>

                            <!-- Hot, Popular or Normal (Selectable Radio Group) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Highlight Type</label>
                                <div class="flex gap-3">
                                    <!-- Option: Hot -->
                                    <label class="flex-1 cursor-pointer relative group">
                                        <input type="radio" name="popularity" value="hot" class="peer sr-only" checked>
                                        <div class="flex items-center justify-center p-3 border border-[#ffffff28] rounded-lg hover:bg-transparent transition-all peer-checked:border-[#6366f1] peer-checked:bg-[#6366f1]/5 peer-checked:ring-2 peer-checked:ring-[#6366f1]/20">
                                            <i class="fas fa-fire text-gray-400 peer-checked:text-[#6366f1] mr-2 transition-colors"></i>
                                            <span class="text-sm font-medium text-white peer-checked:text-[#6366f1]">Hot</span>
                                        </div>
                                    </label>

                                    <!-- Option: Popular -->
                                    <label class="flex-1 cursor-pointer relative group">
                                        <input type="radio" name="popularity" value="popular" class="peer sr-only">
                                        <div class="flex items-center justify-center p-3 border border-[#ffffff28] rounded-lg hover:bg-transparent transition-all peer-checked:border-[#6366f1] peer-checked:bg-[#6366f1]/5 peer-checked:ring-2 peer-checked:ring-[#6366f1]/20">
                                            <i class="fas fa-star text-gray-400 peer-checked:text-[#6366f1] mr-2 transition-colors"></i>
                                            <span class="text-sm font-medium text-white peer-checked:text-[#6366f1]">Popular</span>
                                        </div>
                                    </label>

                                    <!-- Option: Normal (New) -->
                                    <label class="flex-1 cursor-pointer relative group">
                                        <input type="radio" name="popularity" value="normal" class="peer sr-only">
                                        <div class="flex items-center justify-center p-3 border border-[#ffffff28] rounded-lg hover:bg-transparent transition-all peer-checked:border-[#6366f1] peer-checked:bg-[#6366f1]/5 peer-checked:ring-2 peer-checked:ring-[#6366f1]/20">
                                            <i class="fas fa-layer-group text-gray-400 peer-checked:text-[#6366f1] mr-2 transition-colors"></i>
                                            <span class="text-sm font-medium text-white peer-checked:text-[#6366f1]">Normal</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Product Logo (File Input) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Product Logo</label>
                                <div
                                    class="relative border-2 border-dashed border-[#ffffff28] rounded-lg p-6 hover:border-[#6366f1] transition-colors text-center group cursor-pointer">
                                    <input type="file" name="product_logo" id="product_logo" accept="image/*"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                                    <!-- Upload Placeholder -->
                                    <div id="upload-placeholder" class="space-y-2 pointer-events-none">
                                        <div class="mx-auto h-10 w-10 flex items-center justify-center rounded-full shadow-sm group-hover:scale-110 transition-transform">
                                            <i class="fas fa-cloud-upload-alt text-xl text-[#6366f1]"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700">Click to upload logo</p>
                                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                    </div>

                                    <!-- Image Preview -->
                                    <img id="logo-preview" class="hidden mx-auto max-h-32 rounded-md object-contain" alt="Logo Preview">
                                </div>
                            </div>

                            <!-- Background Color (Now TWO colors) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Background Gradient Colors</label>
                                <div class="flex items-center gap-2">
                                    <!-- Color 1 -->
                                    <div class="flex items-center gap-1">
                                        <div class="relative h-9 w-9 overflow-hidden rounded border border-[#ffffff28] cursor-pointer hover:shadow-md transition-shadow bg-transparent">
                                            <input type="color" id="bg_color_1" value="#0f172a" name="bg_color_1"
                                                class="absolute -top-2 -left-2 w-[150%] h-[150%] cursor-pointer p-0 border-0 text-white">
                                        </div>
                                        <input type="text" id="bg_color_text_1" value="#0f172a" maxlength="7"
                                            class="w-20 rounded-lg border-[#ffffff28] border px-2 py-2 bg-transparent text-white text-xs uppercase font-mono focus:outline-none focus:border-[#6366f1]">
                                    </div>
                                    <!-- Divider -->
                                    <span class="text-gray-500">-</span>
                                    <!-- Color 2 -->
                                    <div class="flex items-center gap-1">
                                        <div class="relative h-9 w-9 overflow-hidden rounded border border-[#ffffff28] cursor-pointer hover:shadow-md transition-shadow bg-transparent">
                                            <input type="color" id="bg_color_2" value="#1e293b" name="bg_color_2"
                                                class="absolute -top-2 -left-2 w-[150%] h-[150%] cursor-pointer p-0 border-0 text-white">
                                        </div>
                                        <input type="text" id="bg_color_text_2" value="#1e293b" maxlength="7"
                                            class="w-20 rounded-lg border-[#ffffff28] border px-2 py-2 bg-transparent text-white text-xs uppercase font-mono focus:outline-none focus:border-[#6366f1]">
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">These colors set the page background.</p>

                                <!-- Category (Select) -->
                                <div class="md:col-span-2 mt-3">
                                    <label for="category" class="block text-sm font-medium text-gray-400 mb-1">Choose Category</label>
                                    <select name="category" id="category" 
                                        class="w-full rounded-lg border-[#ffffff28] border px-4 py-2.5 bg-transparent focus:border-[#6366f1] focus:ring-[#6366f1] focus: transition duration-200 outline-none cursor-pointer">
                                        <option value="">Select Category</option>
                                        <option value="social_media">Social Media Accounts</option>
                                        <option value="email_communication">Email / Communication Accounts</option>
                                        <option value="payment_finance">Payment / Finance Accounts</option>
                                        <option value="marketplace_ecommerce">Marketplace / E-commerce Accounts</option>
                                        <option value="development_tech">Development / Tech Accounts</option>
                                        <option value="advertising_marketing">Advertising / Marketing Accounts</option>
                                        <option value="entertainment_media">Entertainment / Media Accounts</option>
                                    </select>
                                </div>


                            </div>

                            <!-- Product Color -->
                            <div>
                                <label for="product_color" class="block text-sm font-medium text-gray-400 mb-1">Product Color</label>
                                <div class="flex items-center gap-3">
                                    <div class="relative h-10 w-14 overflow-hidden rounded-lg border border-[#ffffff28] shadow-sm cursor-pointer hover:shadow-md transition-shadow bg-transparent">
                                        <input type="color" name="product_color" id="product_color" value="#6366f1"
                                            class="absolute -top-2 -left-2 w-[150%] h-[150%] cursor-pointer p-0 border-0">
                                    </div>
                                    <input type="text" id="product_color_text" value="#6366f1" maxlength="7"
                                        class="flex-1 rounded-lg border-[#ffffff28] border px-3 py-2 bg-transparent text-white text-sm uppercase font-mono focus:outline-none">
                                </div>
                            </div>

                            <!-- Product Name -->
                            <div>
                                <label for="product_name" class="block text-sm font-medium text-gray-400 mb-1">Product Name</label>
                                <input type="text" name="product_name" id="product_name" placeholder="Enter product name" 
                                    class="w-full rounded-lg border-[#ffffff28] border px-4 py-2.5 text-white bg-transparent focus:border-[#6366f1] focus:ring-[#6366f1] focus: transition duration-200 outline-none">
                            </div>

                            <!-- Feature List (Textarea) -->
                            <div class="md:col-span-2">
                                <label for="feature_list" class="block text-sm font-medium text-gray-400 mb-1">Feature List</label>
                                <textarea name="feature_list" id="feature_list" rows="4" 
                                    class="w-full rounded-lg border-[#ffffff28] border text-white px-4 py-2.5 bg-transparent focus:border-[#6366f1] focus:ring-[#6366f1] focus: transition duration-200 outline-none resize-y" 
                                    placeholder="- Feature One&#10;- Feature Two&#10;- Feature Three"></textarea>
                                <p class="text-xs text-gray-500 mt-1">Separate each feature with a new line.</p>
                            </div>

                            <!-- Product Description (Textarea) -->
                            <div class="md:col-span-2">
                                <label for="product_desc" class="block text-sm font-medium text-gray-400 mb-1">Product Description</label>
                                <textarea name="product_desc" id="product_desc" rows="4" 
                                    class="w-full rounded-lg border-[#ffffff28] border text-white px-4 py-2.5 bg-transparent focus:border-[#6366f1] focus:ring-[#6366f1] focus: transition duration-200 outline-none resize-y" 
                                    placeholder="Enter full product description..."></textarea>
                            </div>

                            <!-- Status (Select) -->
                            <div class="md:col-span-2">
                                <label for="status" class="block text-sm font-medium text-gray-400 mb-1">Status</label>
                                <select name="status" id="status" 
                                    class="w-full rounded-lg border-[#ffffff28] border px-4 py-2.5 bg-transparent focus:border-[#6366f1] focus:ring-[#6366f1] focus: transition duration-200 outline-none cursor-pointer">
                                    <option value="active">Active</option>
                                    <option value="disabled">Inactive</option>
                                </select>
                            </div>

                            <!-- Initial Product Package (Optional) -->
                            <div class="md:col-span-2 border border-indigo-500/30 rounded-xl p-4 bg-indigo-950/20">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-box-open text-indigo-400 text-lg"></i>
                                        <h3 class="text-sm font-bold text-white uppercase tracking-wider">Initial Package (Optional)</h3>
                                    </div>
                                    <span class="text-xs text-indigo-300">You can also add or edit packages anytime later</span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-300 mb-1">Package Name</label>
                                        <input type="text" name="package_name" placeholder="e.g. Starter Pack (10 Accounts)" 
                                            class="w-full bg-transparent rounded-lg border-[#ffffff28] border px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500">
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-gray-300 mb-1">Price ($ USD)</label>
                                        <input type="number" step="0.01" min="0" name="package_price" placeholder="e.g. 8.50" 
                                            class="w-full bg-transparent rounded-lg border-[#ffffff28] border px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500">
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-medium text-gray-300 mb-1">Package Heading / Subtitle</label>
                                        <input type="text" name="package_heading" placeholder="e.g. 10 Verified Accounts with Recovery Email Included" 
                                            class="w-full bg-transparent rounded-lg border-[#ffffff28] border px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500">
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-medium text-gray-300 mb-1">Package Features (One per line)</label>
                                        <textarea name="package_features" rows="3" placeholder="100% Phone Verified Real SIMs&#10;Clean Residential IPs&#10;Full Credentials & Recovery Email&#10;48-Hour Replacement Guarantee" 
                                            class="w-full bg-transparent rounded-lg border-[#ffffff28] border px-3 py-2 text-xs text-white focus:outline-none focus:border-indigo-500 resize-y"></textarea>
                                    </div>

                                    <div class="flex items-center gap-6 md:col-span-2 pt-1">
                                        <label class="flex items-center gap-2 cursor-pointer text-xs text-gray-300">
                                            <input type="checkbox" name="package_is_highlight" value="1" class="rounded border-gray-600 text-indigo-600 focus:ring-indigo-500">
                                            <span>⭐ Highlight / Featured Badge (Best Value)</span>
                                        </label>

                                        <label class="flex items-center gap-2 cursor-pointer text-xs text-gray-300">
                                            <input type="checkbox" name="package_is_enabled" value="1" checked class="rounded border-gray-600 text-emerald-600 focus:ring-emerald-500">
                                            <span>🟢 Enable Immediately (Visible on website)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-transparent px-6 py-4 border-t border-[#ffffff28] flex justify-end items-center gap-3">
                        <button type="button" class="px-4 py-2 text-sm font-medium text-white border border-[#ffffff28] rounded-lg hover:bg-transparent focus:ring-2 focus:ring-offset-1 focus:ring-gray-200 transition-all">
                            Cancel
                        </button>
                        <button type="submit" 
                            class="bg-[#6366f1] text-white px-6 py-2 rounded-lg hover:bg-[#4f46e5] focus:ring-4 focus:ring-[#6366f1]/30 transition-all font-medium shadow-md hover:shadow-lg flex items-center gap-2">
                            <i class="fas fa-save"></i> Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add new product start -->

    <!-- product list and update start -->
    @if($products->count())
    <div class="mt-5 mb-10 space-y-6 px-5">

        <div class="md:flex items-center justify-between mb-4 gap-4">
            <h2 class="text-xl font-semibold text-white w-1/2">
                Product Preview List
            </h2>

            <div class="w-full md:w-1/2 md:flex gap-3">
                <form method="GET" class="flex gap-2 items-end w-full md:w-2/3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                        class="w-full px-3 py-2 text-sm border rounded-md text-black">
                        <a href="{{ route('admin.product.index') }}" class="border border-white h-full flex w-[40px] rounded bg-white"><i class="m-auto text-black fa-solid fa-arrow-rotate-right"></i></a>
                    <input type="hidden" name="product_id" value="{{ request('product_id') }}">
                </form>

                <form method="GET" class="flex gap-2 mt-2 md:mt-0 items-center w-full md:w-1/3">
                    <!-- Product Select -->
                    <select
                        name="product_id"
                        id="productSelect"
                        onchange="this.form.submit()"
                        class="w-full px-3 py-2 text-sm border rounded-md text-black">
                        <option value="">All Products</option>
                        @foreach($allProducts as $product)
                            <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <script>
            const filterInput = document.getElementById('filterInput');
            const select = document.getElementById('productSelect');

            filterInput.addEventListener('keyup', function () {
                const keyword = this.value.toLowerCase();

                Array.from(select.options).forEach(option => {
                    if (!option.value) return; // keep placeholder

                    option.style.display = option.text.toLowerCase().includes(keyword)
                        ? 'block'
                        : 'none';
                });
            });
        </script>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($products as $product)
            <div x-data="{ openPkgModal: false, showAddPkg: false, editingPkgId: null }" class="flex flex-col">
                <!-- {{ $product->product_name }} Form -->
                <form
                    action="{{ route('admin.product.update', $product->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="rounded-xl border shadow hover:shadow-lg transition overflow-hidden bg-white flex flex-col h-full">
                    @csrf
                    @method('PUT')

                    <!-- Gradient Preview -->
                    <div class="h-36 flex items-center justify-center relative group"
                        style="background: linear-gradient(135deg, {{ $product->bg_color_1 }}, {{ $product->bg_color_2 }});">
                        @if($product->product_logo)
                            <img src="{{ $product->product_logo ? asset('storage/' . $product->product_logo) : asset('no_image.jpg') }}"
                                class="h-16 w-auto rounded shadow">
                        @endif
                        <!-- Logo Upload -->
                        <input type="file" name="product_logo" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>

                    <!-- Content -->
                    <div class="p-4 space-y-3 flex-1 flex flex-col justify-between">
                        <div class="space-y-3">
                            <!-- Name -->
                            <input type="text" name="product_name" value="{{ $product->product_name }}"
                                class="w-full text-lg font-bold bg-transparent border-b focus:outline-none"
                                style="color: {{ $product->product_color }}">

                            <!-- Tag -->
                            <input type="text" name="tag" value="{{ $product->tag }}" placeholder="Tag"
                                class="text-xs px-2 py-1 rounded bg-indigo-100 text-indigo-700 w-fit focus:outline-none">
                            
                            <!-- Category -->
                            <div class="text-xs w-full">
                                <select name="category" class="border text-black rounded px-2 py-1 w-full">
                                    <option value="">Select Category</option>
                                    <option value="social_media" @selected($product->category == 'social_media')>Social Media Accounts</option>
                                    <option value="email_communication" @selected($product->category == 'email_communication')>Email / Communication Accounts</option>
                                    <option value="payment_finance" @selected($product->category == 'payment_finance')>Payment / Finance Accounts</option>
                                    <option value="marketplace_ecommerce" @selected($product->category == 'marketplace_ecommerce')>Marketplace / E-commerce Accounts</option>
                                    <option value="development_tech" @selected($product->category == 'development_tech')>Development / Tech Accounts</option>
                                    <option value="advertising_marketing" @selected($product->category == 'advertising_marketing')>Advertising / Marketing Accounts</option>
                                    <option value="entertainment_media" @selected($product->category == 'entertainment_media')>Entertainment / Media Accounts</option>
                                </select>
                            </div>

                            <!-- Description -->
                            <div>
                                <p class="text-black mt-0 p-0 text-[12px] font-semibold">Description</p>
                                <textarea name="product_desc" rows="2"
                                    class="w-full text-sm text-gray-600 bg-transparent border rounded px-2 py-1 focus:outline-none">{{ $product->product_desc }}</textarea>
                            </div>

                            <!-- Features -->
                            <div>
                                <p class="text-black m-0 p-0 text-[12px] font-semibold">Features</p>
                                <textarea name="feature_list" rows="3" 
                                    class="w-full text-sm text-gray-700 mt-0 bg-transparent border rounded px-2 focus:outline-none" placeholder="Comma separated features">{{ is_array($product->feature_list) ? implode("\n", $product->feature_list) : $product->feature_list }}</textarea>
                            </div>

                            <!-- Colors -->
                            <div class="flex items-center gap-2 text-xs">
                                <label class="flex items-center text-black gap-1">
                                    BG 1
                                    <input type="color" name="bg_color_1" value="{{ $product->bg_color_1 }}">
                                </label>

                                <label class="flex items-center text-black gap-1">
                                    BG 2
                                    <input type="color" name="bg_color_2" value="{{ $product->bg_color_2 }}">
                                </label>

                                <label class="flex text-black items-center gap-1">
                                    Text
                                    <input type="color" name="product_color" value="{{ $product->product_color }}">
                                </label>
                            </div>

                            <!-- Status & Popularity -->
                            <div class="flex gap-2 text-xs w-full">
                                <select name="popularity" class="border text-black rounded px-2 py-1 w-full">
                                    <option value="normal" @selected($product->popularity=='normal')>Normal</option>
                                    <option value="hot" @selected($product->popularity=='hot')>Hot</option>
                                    <option value="popular" @selected($product->popularity=='popular')>Popular</option>
                                </select>

                                <select name="status" class="border text-black rounded px-2 py-1 w-full">
                                    <option value="active" @selected($product->status=='active')>Active</option>
                                    <option value="disabled" @selected($product->status=='disabled')>Disabled</option>
                                </select>
                            </div>

                            <!-- Packages Summary Bar -->
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-1.5 font-semibold text-slate-700">
                                    <i class="fas fa-cubes text-indigo-600"></i>
                                    <span>{{ $product->packages->count() }} Packages</span>
                                    @if($product->packages->where('is_enabled', true)->count() > 0)
                                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold">
                                            {{ $product->packages->where('is_enabled', true)->count() }} Active
                                        </span>
                                    @else
                                        <span class="text-[10px] bg-gray-100 text-gray-500 px-1.5 py-0.5 rounded font-medium">
                                            0 Active
                                        </span>
                                    @endif
                                </div>
                                <button type="button" 
                                        @click="openPkgModal = true" 
                                        class="px-2.5 py-1 rounded bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold border border-indigo-200 transition flex items-center gap-1 shadow-2xs cursor-pointer">
                                    <i class="fas fa-layer-group text-[11px]"></i> Manage
                                </button>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2 mt-4 pt-2 border-t border-slate-100">
                            <button type="submit" class="flex-1 px-3 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition font-bold text-xs">
                                Update
                            </button>
                            <button type="button" 
                                    @click="openPkgModal = true"
                                    class="px-3 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700 transition font-bold text-xs flex items-center gap-1 cursor-pointer">
                                <i class="fas fa-boxes-stacked"></i> Packages
                            </button>
                            <a href="{{ route('admin.productDelete', $product->id) }}" onclick="return confirm('Are you sure you want to delete this product?')" class="px-3 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition font-bold text-xs">
                                Delete
                            </a>
                        </div>

                    </div>
                </form>

                <!-- Dedicated Package Management Modal (Rendered outside card via x-teleport) -->
                <template x-teleport="body">
                    <div x-show="openPkgModal" 
                         x-transition.opacity
                         class="fixed inset-0 z-[9999] overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
                        
                        <div @click.outside="openPkgModal = false" 
                             class="bg-slate-900 border border-slate-700/80 rounded-2xl w-full max-w-4xl max-h-[90vh] flex flex-col shadow-2xl text-slate-100 overflow-hidden">
                            
                            <!-- Modal Header -->
                            <div class="px-6 py-4 bg-slate-800/90 border-b border-slate-700/80 flex items-center justify-between shrink-0">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow overflow-hidden"
                                         style="background: linear-gradient(135deg, {{ $product->bg_color_1 ?? '#0f172a' }}, {{ $product->bg_color_2 ?? '#1e293b' }});">
                                        @if($product->product_logo)
                                            <img src="{{ asset('storage/' . $product->product_logo) }}" class="h-6 w-auto object-contain">
                                        @else
                                            <i class="fas fa-box text-emerald-400"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                                            <span>{{ $product->product_name }}</span>
                                            <span class="text-xs px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 font-semibold border border-indigo-500/30">
                                                {{ $product->packages->count() }} Packages
                                            </span>
                                        </h3>
                                        <p class="text-xs text-slate-400">Manage, create, or edit pricing packages and feature tiers for this product</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <button type="button" 
                                            @click="showAddPkg = !showAddPkg" 
                                            class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition flex items-center gap-1.5 shadow">
                                        <i class="fas" :class="showAddPkg ? 'fa-minus' : 'fa-plus'"></i>
                                        <span x-text="showAddPkg ? 'Close Add Form' : 'Add New Package'"></span>
                                    </button>
                                    <button type="button" 
                                            @click="openPkgModal = false" 
                                            class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white flex items-center justify-center transition">
                                        <i class="fas fa-times text-sm"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Scrollable Body -->
                            <div class="p-6 overflow-y-auto space-y-6 flex-1">
                                
                                <!-- Add New Package Form (Collapsible) -->
                                <div x-show="showAddPkg" x-collapse class="bg-slate-800/70 border border-emerald-500/40 rounded-xl p-5 shadow-lg">
                                    <h4 class="text-sm font-bold text-emerald-400 mb-3 flex items-center gap-2">
                                        <i class="fas fa-plus-circle"></i> Create New Package for {{ $product->product_name }}
                                    </h4>
                                    <form action="{{ route('admin.packages.store', $product->id) }}" method="POST" class="space-y-4">
                                        @csrf
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-300 mb-1">Package Name *</label>
                                                <input type="text" name="package_name" required placeholder="e.g. Starter Pack (10 Accounts)" 
                                                    class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-emerald-500">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-300 mb-1">Price ($ USD) *</label>
                                                <input type="number" step="0.01" min="0" name="price" required placeholder="e.g. 8.50" 
                                                    class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-emerald-500">
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-xs font-semibold text-slate-300 mb-1">Package Heading / Subtitle</label>
                                                <input type="text" name="package_heading" placeholder="e.g. 10 Verified Accounts with Recovery Email Included" 
                                                    class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-emerald-500">
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-xs font-semibold text-slate-300 mb-1">Features List (One feature per line)</label>
                                                <textarea name="features" rows="3" placeholder="100% Phone Verified Real SIMs&#10;Clean Residential IPs&#10;Full Credentials & Recovery Email&#10;48-Hour Replacement Guarantee" 
                                                    class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-emerald-500"></textarea>
                                            </div>
                                            <div class="flex items-center gap-6 md:col-span-2">
                                                <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-300">
                                                    <input type="checkbox" name="is_highlight" value="1" class="rounded border-slate-700 text-indigo-600 focus:ring-indigo-500">
                                                    <span>⭐ Highlight / Featured Badge (Best Value)</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-300">
                                                    <input type="checkbox" name="is_enabled" value="1" checked class="rounded border-slate-700 text-emerald-600 focus:ring-emerald-500">
                                                    <span>🟢 Enable Package (Visible on website)</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="flex justify-end gap-2 pt-2">
                                            <button type="button" @click="showAddPkg = false" class="px-4 py-2 rounded-lg bg-slate-700 hover:bg-slate-600 text-xs font-medium text-slate-200">
                                                Cancel
                                            </button>
                                            <button type="submit" class="px-5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow">
                                                <i class="fas fa-save mr-1"></i> Save Package
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Existing Packages List -->
                                @if($product->packages->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($product->packages as $pkg)
                                            <div class="bg-slate-800/80 border {{ $pkg->is_highlight ? 'border-amber-500/50 shadow-amber-500/10' : 'border-slate-700/80' }} rounded-xl p-4 transition-all">
                                                
                                                <!-- Normal Package View (when not editing) -->
                                                <div x-show="editingPkgId !== {{ $pkg->id }}">
                                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-700/60">
                                                        <div class="flex items-center gap-2 flex-wrap">
                                                            <h4 class="text-base font-bold text-white">{{ $pkg->package_name }}</h4>
                                                            
                                                            @if($pkg->is_highlight)
                                                                <span class="inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40">
                                                                    <i class="fas fa-star text-[10px]"></i> Highlighted
                                                                </span>
                                                            @endif

                                                            @if($pkg->is_enabled)
                                                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                                                    <i class="fas fa-check-circle text-[10px]"></i> Enabled
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-full bg-red-500/20 text-red-300 border border-red-500/30">
                                                                    <i class="fas fa-times-circle text-[10px]"></i> Disabled
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="flex items-center gap-3">
                                                            <span class="text-lg font-black text-emerald-400">
                                                                ${{ number_format($pkg->price, 2) }}
                                                            </span>

                                                            <!-- Toggle Status Button -->
                                                            <form action="{{ route('admin.packages.toggle', $pkg->id) }}" method="POST" class="inline">
                                                                @csrf
                                                                <button type="submit" 
                                                                        title="{{ $pkg->is_enabled ? 'Disable this package' : 'Enable this package' }}"
                                                                        class="px-2.5 py-1 text-xs font-semibold rounded-lg border transition {{ $pkg->is_enabled ? 'bg-amber-500/20 text-amber-300 border-amber-500/40 hover:bg-amber-500/30' : 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40 hover:bg-emerald-500/30' }}">
                                                                    {{ $pkg->is_enabled ? 'Disable' : 'Enable' }}
                                                                </button>
                                                            </form>

                                                            <!-- Edit Button -->
                                                            <button type="button" 
                                                                    @click="editingPkgId = {{ $pkg->id }}" 
                                                                    class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white transition flex items-center gap-1">
                                                                <i class="fas fa-edit text-[11px]"></i> Edit
                                                            </button>

                                                            <!-- Delete Button -->
                                                            <form action="{{ route('admin.packages.destroy', $pkg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete package \'{{ addslashes($pkg->package_name) }}\'?')" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="p-1.5 text-xs text-red-400 hover:text-red-300 hover:bg-red-500/20 rounded-lg transition" title="Delete Package">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    @if($pkg->package_heading)
                                                        <p class="text-xs text-slate-300 mt-2 font-medium">{{ $pkg->package_heading }}</p>
                                                    @endif

                                                    <!-- Features Pills -->
                                                    @if(!empty($pkg->features_array))
                                                        <div class="mt-2.5 flex flex-wrap gap-1.5">
                                                            @foreach($pkg->features_array as $feat)
                                                                <span class="inline-flex items-center gap-1 text-[11px] bg-slate-900/80 text-slate-300 border border-slate-700 px-2 py-0.5 rounded-md">
                                                                    <i class="fas fa-check text-[9px] text-emerald-400"></i>
                                                                    {{ $feat }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Inline Edit Form for this Package -->
                                                <div x-show="editingPkgId === {{ $pkg->id }}" x-cloak class="pt-2">
                                                    <form action="{{ route('admin.packages.update', $pkg->id) }}" method="POST" class="space-y-4">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <div>
                                                                <label class="block text-xs font-semibold text-slate-300 mb-1">Package Name *</label>
                                                                <input type="text" name="package_name" value="{{ $pkg->package_name }}" required 
                                                                    class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500">
                                                            </div>
                                                            <div>
                                                                <label class="block text-xs font-semibold text-slate-300 mb-1">Price ($ USD) *</label>
                                                                <input type="number" step="0.01" min="0" name="price" value="{{ $pkg->price }}" required 
                                                                    class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500">
                                                            </div>
                                                            <div class="md:col-span-2">
                                                                <label class="block text-xs font-semibold text-slate-300 mb-1">Package Heading / Subtitle</label>
                                                                <input type="text" name="package_heading" value="{{ $pkg->package_heading }}" 
                                                                    class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-indigo-500">
                                                            </div>
                                                            <div class="md:col-span-2">
                                                                <label class="block text-xs font-semibold text-slate-300 mb-1">Features (One per line)</label>
                                                                <textarea name="features" rows="4" 
                                                                    class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-indigo-500">{{ $pkg->features_text }}</textarea>
                                                            </div>
                                                            <div class="flex items-center gap-6 md:col-span-2">
                                                                <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-300">
                                                                    <input type="checkbox" name="is_highlight" value="1" @checked($pkg->is_highlight) class="rounded border-slate-700 text-indigo-600 focus:ring-indigo-500">
                                                                    <span>⭐ Highlight / Featured Badge</span>
                                                                </label>
                                                                <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-300">
                                                                    <input type="checkbox" name="is_enabled" value="1" @checked($pkg->is_enabled) class="rounded border-slate-700 text-emerald-600 focus:ring-emerald-500">
                                                                    <span>🟢 Enabled (Visible on website)</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-end gap-2 pt-2 border-t border-slate-700/60">
                                                            <button type="button" @click="editingPkgId = null" class="px-4 py-1.5 rounded-lg bg-slate-700 hover:bg-slate-600 text-xs font-medium text-slate-200">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="px-5 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold shadow">
                                                                Update Package
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-10 px-4 bg-slate-800/40 rounded-xl border border-dashed border-slate-700">
                                        <i class="fas fa-box-open text-4xl text-slate-600 mb-3"></i>
                                        <h4 class="text-sm font-bold text-white mb-1">No Packages Created Yet</h4>
                                        <p class="text-xs text-slate-400 mb-4 max-w-md mx-auto">Create packages so customers can select tiered offerings with specific features and pricing on the website.</p>
                                        <button type="button" @click="showAddPkg = true" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow inline-flex items-center gap-1.5">
                                            <i class="fas fa-plus"></i> Add First Package
                                        </button>
                                    </div>
                                @endif

                            </div>

                            <!-- Modal Footer -->
                            <div class="px-6 py-3 bg-slate-800/60 border-t border-slate-700/80 flex justify-end shrink-0">
                                <button type="button" @click="openPkgModal = false" class="px-5 py-2 bg-slate-700 hover:bg-slate-600 text-white text-xs font-bold rounded-lg transition">
                                    Done
                                </button>
                            </div>

                        </div>
                    </div>
                </template>
            </div>
            @endforeach

        </div>
    </div>
    @endif
    <!-- product list and update start -->


    
<script>
    // Elements for Background Gradient
    const bgPicker1 = document.getElementById('bg_color_1');
    const bgText1 = document.getElementById('bg_color_text_1');
    const bgPicker2 = document.getElementById('bg_color_2');
    const bgText2 = document.getElementById('bg_color_text_2');
    
    // Elements for Product Color
    const productPicker = document.getElementById('product_color');
    const productText = document.getElementById('product_color_text');

    // --- Background Gradient Handlers ---
    if (bgPicker1 && bgText1 && bgPicker2 && bgText2) {
        bgPicker1.addEventListener('input', (e) => {
            bgText1.value = e.target.value.toUpperCase();
        });
        bgText1.addEventListener('input', (e) => {
            const val = e.target.value;
            if (/^#[0-9A-F]{6}$/i.test(val)) {
                bgPicker1.value = val;
            }
        });

        bgPicker2.addEventListener('input', (e) => {
            bgText2.value = e.target.value.toUpperCase();
        });
        bgText2.addEventListener('input', (e) => {
            const val = e.target.value;
            if (/^#[0-9A-F]{6}$/i.test(val)) {
                bgPicker2.value = val;
            }
        });
    }

    // --- Product Color Handlers ---
    if (productPicker && productText) {
        productPicker.addEventListener('input', (e) => {
            productText.value = e.target.value.toUpperCase();
        });
        productText.addEventListener('input', (e) => {
            const val = e.target.value;
            if (/^#[0-9A-F]{6}$/i.test(val)) {
                productPicker.value = val;
            }
        });
    }

    // for product logo/image selection
    const input = document.getElementById('product_logo');
    const preview = document.getElementById('logo-preview');
    const placeholder = document.getElementById('upload-placeholder');

    if (input && preview && placeholder) {
        input.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };

            reader.readAsDataURL(file);
        });
    }
</script>
@endsection

@push('script')

@endpush
