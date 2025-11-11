@php
    $configure = App\Models\Configer::latest()->first();
@endphp
<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <span>
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © {{ $configure->name }}
                </span>
                <span class="mx-2">|</span>
                <span>
                    Design & Developed by <a href="https://fleek.com.bd/" target="_blank">Fleek Bangladesh</a>
                </span>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->
