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
        </ul>+
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
            <!-- {{ $product->product_name }} -->
            <form
                action="{{ route('admin.product.update', $product->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="rounded-xl border shadow hover:shadow-lg transition overflow-hidden bg-white">
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
                <div class="p-4 space-y-3">

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
                     <br>
                    <p class="text-black mt-0 p-0 text-[12px]">Description</p>
                    <textarea name="product_desc" rows="2"
                        class="w-full text-sm text-gray-600 bg-transparent border rounded px-2 py-1 focus:outline-none">{{ $product->product_desc }}</textarea>

                    <!-- Features -->
                    <p class="text-black m-0 p-0 text-[12px]">Features</p>
                    <textarea name="feature_list" rows="4" 
                    class="w-full text-sm text-gray-700 mt-0 bg-transparent border rounded px-2 focus:outline-none" placeholder="Comma separated features">{{ $product->feature_list }}</textarea>

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

                    <!-- Actions -->
                    <div class="flex gap-2 mt-4">
                        <button type="submit" class="flex-1 px-3 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 transition">
                            Update
                        </button>
                        <a href="{{ route('admin.productDelete', $product->id) }}" type="submit" class="px-3 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition">
                            Delete
                        </a>
                    </div>

                </div>
            </form>
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

    // Target the BODY to change the background
    const bodyElement = document.body;

    // Function to update background gradient
    function updateBodyGradient() {
        const color1 = bgText1.value;
        const color2 = bgText2.value;
        bodyElement.style.background = `linear-gradient(135deg, ${color1}, ${color2})`;
    }

    // --- Background Gradient Handlers ---
    
    // Picker 1 -> Text 1
    bgPicker1.addEventListener('input', (e) => {
        bgText1.value = e.target.value.toUpperCase();
        updateBodyGradient();
    });
    // Text 1 -> Picker 1 (Manual Input)
    bgText1.addEventListener('input', (e) => {
        const val = e.target.value;
        if (/^#[0-9A-F]{6}$/i.test(val)) {
            bgPicker1.value = val;
            updateBodyGradient();
        }
    });

    // Picker 2 -> Text 2
    bgPicker2.addEventListener('input', (e) => {
        bgText2.value = e.target.value.toUpperCase();
        updateBodyGradient();
    });
    // Text 2 -> Picker 2 (Manual Input)
    bgText2.addEventListener('input', (e) => {
        const val = e.target.value;
        if (/^#[0-9A-F]{6}$/i.test(val)) {
            bgPicker2.value = val;
            updateBodyGradient();
        }
    });

    // --- Product Color Handlers ---

    // Picker -> Text
    productPicker.addEventListener('input', (e) => {
        productText.value = e.target.value.toUpperCase();
    });
    // Text -> Picker
    productText.addEventListener('input', (e) => {
        const val = e.target.value;
        if (/^#[0-9A-F]{6}$/i.test(val)) {
            productPicker.value = val;
        }
    });

    // Initialize
    updateBodyGradient();


    // for product logo/image selection
    const input = document.getElementById('product_logo')
    const preview = document.getElementById('logo-preview')
    const placeholder = document.getElementById('upload-placeholder')

    input.addEventListener('change', function () {
        const file = this.files[0]

        if (!file) return

        if (!file.type.startsWith('image/')) {
            alert('Please select an image file')
            this.value = ''
            return
        }

        const reader = new FileReader()

        reader.onload = function (e) {
            preview.src = e.target.result
            preview.classList.remove('hidden')
            placeholder.classList.add('hidden')
        }

        reader.readAsDataURL(file)
    })
</script>
@endsection

@push('script')

@endpush
