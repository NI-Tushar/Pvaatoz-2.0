{{-- Cart Slide-Over Drawer & Unified Cart Engine --}}
@php
    $isUserLoggedIn = auth()->check() || auth()->guard('admin')->check();
    $currentUserId = auth()->id() ?? auth()->guard('admin')->id();
@endphp

<!-- Cart Drawer Backdrop & Panel -->
<div id="accue-cart-drawer" 
     class="fixed inset-0 z-[9999] overflow-hidden pointer-events-none transition-opacity duration-300 opacity-0"
     aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    
    <!-- Backdrop Background -->
    <div id="accue-cart-backdrop"
         onclick="window.AccueCart && window.AccueCart.close()"
         class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300"></div>

    <div class="fixed inset-y-0 right-0 max-w-full flex pl-10 pointer-events-none">
        <!-- Slide-over Drawer Panel -->
        <div id="accue-cart-panel"
             class="w-screen max-w-md bg-white shadow-2xl flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out pointer-events-auto">
            
            <!-- Drawer Header -->
            <div class="p-5 sm:p-6 bg-slate-900 text-white flex items-center justify-between border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-lg border border-emerald-500/30">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold tracking-tight text-white m-0">Your Shopping Cart</h2>
                        <span id="cart-header-count-text" class="text-xs text-slate-400">0 items selected</span>
                    </div>
                </div>
                <button type="button" 
                        onclick="window.AccueCart && window.AccueCart.close()"
                        class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Drawer Items Body (Scrollable) -->
            <div id="cart-drawer-items-container" class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-4">
                <!-- Dynamically rendered via JS -->
            </div>

            <!-- Empty State (Hidden when items exist) -->
            <div id="cart-empty-state" class="hidden flex-1 flex flex-col items-center justify-center p-8 text-center space-y-4">
                <div class="w-20 h-20 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl shadow-inner">
                    <i class="fa-solid fa-basket-shopping"></i>
                </div>
                <div class="space-y-1">
                    <h3 class="text-lg font-bold text-slate-900">Your cart is empty</h3>
                    <p class="text-xs text-slate-500 max-w-xs mx-auto">
                        Explore our selection of verified PVA accounts and add them to your cart to get started.
                    </p>
                </div>
                <a href="{{ route('home') }}#about" 
                   onclick="window.AccueCart && window.AccueCart.close()"
                   class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs px-5 py-2.5 rounded-xl shadow transition">
                    <i class="fa-solid fa-sparkles"></i>
                    <span>Browse Products</span>
                </a>
            </div>

            <!-- Drawer Footer (Summary & Checkout CTA) -->
            <div id="cart-drawer-footer" class="p-5 sm:p-6 bg-slate-50 border-t border-slate-200/90 space-y-4">
                
                <!-- Price Breakdown -->
                <div class="space-y-2 text-xs">
                    <div class="flex justify-between items-center text-slate-600">
                        <span>Items Subtotal:</span>
                        <span id="cart-summary-subtotal" class="font-bold text-slate-900">$0.00</span>
                    </div>
                    <div id="cart-summary-discount-row" class="hidden flex justify-between items-center text-emerald-600">
                        <span class="flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-tag text-[10px]"></i> Volume Tier Savings:
                        </span>
                        <span id="cart-summary-discount" class="font-bold">-$0.00</span>
                    </div>
                    <div class="flex justify-between items-center text-slate-600">
                        <span>Instant Delivery:</span>
                        <span class="text-emerald-700 font-bold uppercase bg-emerald-100/70 px-2 py-0.5 rounded text-[10px]">FREE (1-5 min)</span>
                    </div>
                    <div class="border-t border-slate-200 pt-2.5 flex justify-between items-baseline">
                        <span class="text-sm font-bold text-slate-900">Estimated Total:</span>
                        <div class="text-right">
                            <span id="cart-summary-total" class="text-2xl font-extrabold text-emerald-700">$0.00</span>
                            <span class="text-[10px] text-slate-500 block">USD (Taxes Included)</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2 pt-1">
                    <a href="{{ route('checkout') }}" 
                       class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-emerald-600/25 transition flex items-center justify-center gap-2 text-sm text-center">
                        <i class="fa-solid fa-lock text-xs"></i>
                        <span>Proceed to Checkout</span>
                    </a>

                    <div class="flex items-center justify-between text-xs pt-1">
                        <button type="button" 
                                onclick="window.AccueCart && window.AccueCart.clear()"
                                class="text-slate-400 hover:text-red-500 transition flex items-center gap-1 cursor-pointer">
                            <i class="fa-regular fa-trash-can text-xs"></i>
                            <span>Clear cart</span>
                        </button>
                        <button type="button" 
                                onclick="window.AccueCart && window.AccueCart.close()"
                                class="text-emerald-700 hover:text-emerald-800 font-semibold cursor-pointer">
                            Continue Shopping →
                        </button>
                    </div>
                </div>

                <!-- Micro Trust Guarantee -->
                <div class="pt-2 border-t border-slate-200/60 flex items-center justify-center gap-4 text-[11px] text-slate-500">
                    <span class="flex items-center gap-1"><i class="fa-solid fa-shield-check text-emerald-600"></i> 48h Warranty</span>
                    <span class="flex items-center gap-1"><i class="fa-solid fa-bolt text-teal-600"></i> Instant Handoff</span>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- Floating Toast Notification for Cart Actions -->
<div id="accue-cart-toast" 
     class="fixed bottom-6 right-6 z-[10000] transform translate-y-20 opacity-0 pointer-events-none transition-all duration-300 max-w-sm w-full bg-slate-900 text-white p-4 rounded-2xl shadow-2xl border border-slate-800 flex items-center gap-3">
    <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 text-lg shadow-md">
        <i class="fa-solid fa-check"></i>
    </div>
    <div class="flex-1 min-w-0">
        <p id="accue-cart-toast-title" class="text-sm font-bold text-white truncate m-0">Added to Cart!</p>
        <p id="accue-cart-toast-msg" class="text-xs text-slate-300 truncate m-0">Item is ready in your cart.</p>
    </div>
    <button type="button" 
            onclick="window.AccueCart && window.AccueCart.open()"
            class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition shrink-0 cursor-pointer">
        View Cart
    </button>
</div>

<!-- Unified Cart Engine JavaScript -->
<script>
(function() {
    'use strict';

    const STORAGE_KEY = 'accuevault_cart';
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
    const IS_LOGGED_IN = {{ $isUserLoggedIn ? 'true' : 'false' }};

    window.AccueCart = {
        items: [],
        isOpen: false,
        isLoggedIn: IS_LOGGED_IN,

        init: function() {
            if (this.isLoggedIn) {
                // If logged in, first sync any offline/guest items from localStorage into DB
                const localItems = this.getLocalItems();
                if (localItems && localItems.length > 0) {
                    this.syncLocalToDatabase(localItems);
                } else {
                    this.fetchDatabaseCart();
                }
            } else {
                // Guest mode: load purely from localStorage
                this.items = this.getLocalItems();
                this.render();
            }

            // Check if URL has ?cart=open to automatically reveal cart
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('cart') === 'open') {
                setTimeout(() => this.open(), 300);
            }
        },

        getLocalItems: function() {
            try {
                const stored = localStorage.getItem(STORAGE_KEY);
                return stored ? JSON.parse(stored) : [];
            } catch (e) {
                console.error('Error reading localStorage cart:', e);
                return [];
            }
        },

        setLocalItems: function(items) {
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
            } catch (e) {
                console.error('Error saving localStorage cart:', e);
            }
        },

        clearLocal: function() {
            localStorage.removeItem(STORAGE_KEY);
            this.items = [];
            this.render();
        },

        fetchDatabaseCart: function() {
            fetch('{{ route('cart.items') }}', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.items) {
                    this.items = data.items;
                    this.render();
                }
            })
            .catch(err => console.error('Error fetching database cart:', err));
        },

        syncLocalToDatabase: function(localItems) {
            fetch('{{ route('cart.sync') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ items: localItems })
            })
            .then(res => res.json())
            .then(data => {
                // Clear local storage after successful sync
                localStorage.removeItem(STORAGE_KEY);
                if (data.items) {
                    this.items = data.items;
                }
                this.render();
            })
            .catch(err => {
                console.error('Error syncing cart:', err);
                this.fetchDatabaseCart();
            });
        },

        add: function(product, quantity = 10, event = null) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            const productId = parseInt(product.id || product.product_id);
            const qty = parseInt(quantity) || 10;
            const unitPrice = parseFloat(product.unit_price) || 0.85;

            if (this.isLoggedIn) {
                // Save to server database
                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: qty,
                        unit_price: unitPrice
                    })
                })
                .then(res => res.json())
                .then(data => {
                    this.fetchDatabaseCart();
                    this.showToast(product.product_name || product.name, qty);
                })
                .catch(err => {
                    console.error('Error adding to DB cart:', err);
                });
            } else {
                // Save to localStorage
                let items = this.getLocalItems();
                const existingIndex = items.findIndex(item => parseInt(item.product_id) === productId);

                if (existingIndex > -1) {
                    items[existingIndex].quantity = parseInt(items[existingIndex].quantity) + qty;
                } else {
                    items.push({
                        product_id: productId,
                        product_name: product.product_name || product.name || 'PVA Account',
                        category: product.category || 'Account',
                        tag: product.tag || '100% PVA',
                        product_logo: product.product_logo || '',
                        bg_color_1: product.bg_color_1 || '#064e3b',
                        bg_color_2: product.bg_color_2 || '#022c22',
                        product_color: product.product_color || '#10b981',
                        quantity: qty,
                        unit_price: unitPrice
                    });
                }

                this.setLocalItems(items);
                this.items = items;
                this.render();
                this.showToast(product.product_name || product.name, qty);
            }
        },

        updateQty: function(productId, newQty) {
            productId = parseInt(productId);
            newQty = parseInt(newQty);

            if (newQty <= 0) {
                return this.remove(productId);
            }

            if (this.isLoggedIn) {
                fetch('{{ route('cart.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: newQty
                    })
                })
                .then(res => res.json())
                .then(() => this.fetchDatabaseCart())
                .catch(err => console.error('Error updating DB cart qty:', err));
            } else {
                let items = this.getLocalItems();
                const idx = items.findIndex(item => parseInt(item.product_id) === productId);
                if (idx > -1) {
                    items[idx].quantity = newQty;
                    this.setLocalItems(items);
                    this.items = items;
                    this.render();
                }
            }
        },

        remove: function(productId) {
            productId = parseInt(productId);

            if (this.isLoggedIn) {
                fetch('{{ route('cart.remove') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(res => res.json())
                .then(() => this.fetchDatabaseCart())
                .catch(err => console.error('Error removing from DB cart:', err));
            } else {
                let items = this.getLocalItems();
                items = items.filter(item => parseInt(item.product_id) !== productId);
                this.setLocalItems(items);
                this.items = items;
                this.render();
            }
        },

        clear: function() {
            if (this.isLoggedIn) {
                fetch('{{ route('cart.clear') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(() => {
                    this.items = [];
                    this.render();
                })
                .catch(err => console.error('Error clearing DB cart:', err));
            } else {
                this.clearLocal();
            }
        },

        calculateItem: function(item) {
            const qty = parseInt(item.quantity) || 1;
            const unitPrice = parseFloat(item.unit_price) || 0.85;
            let discountRate = 0;
            if (qty >= 100) discountRate = 0.25;
            else if (qty >= 50) discountRate = 0.15;
            else if (qty >= 25) discountRate = 0.10;

            const subtotal = qty * unitPrice;
            const discountAmount = subtotal * discountRate;
            const total = subtotal - discountAmount;

            return {
                qty,
                unitPrice,
                subtotal: subtotal.toFixed(2),
                discountRate,
                discountLabel: discountRate > 0 ? (discountRate * 100) + '% OFF' : '',
                discountAmount: discountAmount.toFixed(2),
                total: total.toFixed(2)
            };
        },

        calculateGrandTotals: function() {
            let totalQty = 0;
            let subtotal = 0;
            let totalDiscount = 0;

            this.items.forEach(item => {
                const calc = this.calculateItem(item);
                totalQty += calc.qty;
                subtotal += parseFloat(calc.subtotal);
                totalDiscount += parseFloat(calc.discountAmount);
            });

            const grandTotal = subtotal - totalDiscount;

            return {
                totalQty,
                itemCount: this.items.length,
                subtotal: subtotal.toFixed(2),
                totalDiscount: totalDiscount.toFixed(2),
                grandTotal: grandTotal.toFixed(2)
            };
        },

        render: function() {
            const totals = this.calculateGrandTotals();

            // 1. Update all navbar cart badges
            document.querySelectorAll('.cart-badge-count').forEach(badge => {
                badge.textContent = totals.itemCount;
                if (totals.itemCount > 0) {
                    badge.classList.remove('hidden');
                    badge.classList.add('inline-flex');
                } else {
                    badge.classList.add('hidden');
                    badge.classList.remove('inline-flex');
                }
            });

            // 2. Update Header count
            const headerCount = document.getElementById('cart-header-count-text');
            if (headerCount) {
                headerCount.textContent = `${totals.itemCount} items (${totals.totalQty} accounts)`;
            }

            // 3. Render Items or Empty State
            const container = document.getElementById('cart-drawer-items-container');
            const emptyState = document.getElementById('cart-empty-state');
            const footer = document.getElementById('cart-drawer-footer');

            if (!container) return;

            if (this.items.length === 0) {
                container.innerHTML = '';
                emptyState?.classList.remove('hidden');
                emptyState?.classList.add('flex');
                footer?.classList.add('hidden');
                return;
            }

            emptyState?.classList.add('hidden');
            emptyState?.classList.remove('flex');
            footer?.classList.remove('hidden');

            let html = '';
            this.items.forEach(item => {
                const calc = this.calculateItem(item);
                const pId = item.product_id;
                const pLogo = item.product_logo || '{{ asset('no_image.jpg') }}';
                const bg1 = item.bg_color_1 || '#064e3b';
                const bg2 = item.bg_color_2 || '#022c22';

                html += `
                    <div class="p-3.5 bg-slate-50 border border-slate-200/90 rounded-2xl flex items-center gap-3.5 transition hover:border-emerald-300">
                        <!-- Product Logo Box -->
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center p-2 shrink-0 shadow-sm"
                             style="background: linear-gradient(135deg, ${bg1}, ${bg2});">
                            <img src="${pLogo}" 
                                 alt="${item.product_name}" 
                                 class="max-h-9 max-w-full object-contain filter drop-shadow-sm"
                                 onerror="this.src='{{ asset('no_image.jpg') }}'">
                        </div>

                        <!-- Item Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1 mb-0.5">
                                <h4 class="text-sm font-bold text-slate-900 truncate m-0">${item.product_name}</h4>
                                <button type="button" 
                                        onclick="window.AccueCart.remove(${pId})"
                                        class="text-slate-400 hover:text-red-500 transition text-xs p-1 cursor-pointer"
                                        title="Remove item">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>

                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <span>$${calc.unitPrice.toFixed(2)}/acc</span>
                                ${calc.discountLabel ? `<span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-1.5 py-0.2 rounded-full">${calc.discountLabel}</span>` : ''}
                            </div>

                            <!-- Quantity Controller & Item Total -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center border border-slate-300 rounded-lg bg-white overflow-hidden shadow-sm">
                                    <button type="button" 
                                            onclick="window.AccueCart.updateQty(${pId}, ${calc.qty - 5})"
                                            class="px-2 py-0.5 text-slate-600 hover:bg-slate-100 font-bold text-xs cursor-pointer">-</button>
                                    <input type="number" 
                                           min="1" 
                                           value="${calc.qty}" 
                                           onchange="window.AccueCart.updateQty(${pId}, this.value)"
                                           class="w-12 text-center text-xs font-bold text-slate-900 border-x border-slate-200 py-0.5 focus:outline-none">
                                    <button type="button" 
                                            onclick="window.AccueCart.updateQty(${pId}, ${calc.qty + 5})"
                                            class="px-2 py-0.5 text-slate-600 hover:bg-slate-100 font-bold text-xs cursor-pointer">+</button>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-extrabold text-slate-900">$${calc.total}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;

            // 4. Update Summary Block
            const subtotalElem = document.getElementById('cart-summary-subtotal');
            const totalElem = document.getElementById('cart-summary-total');
            const discountRow = document.getElementById('cart-summary-discount-row');
            const discountElem = document.getElementById('cart-summary-discount');

            if (subtotalElem) subtotalElem.textContent = '$' + totals.subtotal;
            if (totalElem) totalElem.textContent = '$' + totals.grandTotal;

            if (parseFloat(totals.totalDiscount) > 0) {
                discountRow?.classList.remove('hidden');
                if (discountElem) discountElem.textContent = '-$' + totals.totalDiscount;
            } else {
                discountRow?.classList.add('hidden');
            }
        },

        open: function() {
            const drawer = document.getElementById('accue-cart-drawer');
            const panel = document.getElementById('accue-cart-panel');
            if (drawer && panel) {
                drawer.classList.remove('pointer-events-none', 'opacity-0');
                drawer.classList.add('pointer-events-auto', 'opacity-100');
                panel.classList.remove('translate-x-full');
                panel.classList.add('translate-x-0');
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            }
        },

        close: function() {
            const drawer = document.getElementById('accue-cart-drawer');
            const panel = document.getElementById('accue-cart-panel');
            if (drawer && panel) {
                panel.classList.remove('translate-x-0');
                panel.classList.add('translate-x-full');
                drawer.classList.remove('pointer-events-auto', 'opacity-100');
                drawer.classList.add('pointer-events-none', 'opacity-0');
                this.isOpen = false;
                document.body.style.overflow = '';
            }
        },

        toggle: function() {
            if (this.isOpen) {
                this.close();
            } else {
                this.open();
            }
        },

        showToast: function(productName, qty) {
            const toast = document.getElementById('accue-cart-toast');
            const title = document.getElementById('accue-cart-toast-title');
            const msg = document.getElementById('accue-cart-toast-msg');

            if (toast) {
                if (title) title.textContent = `Added ${productName} to cart!`;
                if (msg) msg.textContent = `${qty} accounts added to your cart.`;

                toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
                toast.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');

                // Animate cart badge
                document.querySelectorAll('.cart-badge-count').forEach(badge => {
                    badge.classList.add('animate-bounce');
                    setTimeout(() => badge.classList.remove('animate-bounce'), 1000);
                });

                clearTimeout(this._toastTimer);
                this._toastTimer = setTimeout(() => {
                    toast.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                    toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
                }, 4000);
            }
        }
    };

    // Auto-init on page load
    document.addEventListener('DOMContentLoaded', function() {
        window.AccueCart.init();
    });
})();
</script>
