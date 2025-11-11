@extends('Frontend.Dashboard.Layouts.app')
@section('app-content')
<!-- ========== Left Sidebar ========== -->
@include('Frontend.Dashboard.Includes.sidebar')
<!-- ========== Left Sidebar End========== -->



<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="page-content"  style="background-color:aliceblue;">

    <!-- ========== Topbar Start ========== -->
    @include('Frontend.Dashboard.Includes.navbar')
    <!-- ========== Topbar End ========== -->

    <div class="px-0">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            {{-- @include('Frontend.Dashboard.Includes.bradcam') --}}
            <!-- end page title -->

            {{-- Main Content --}}
            @yield('master-content')
            {{-- Main Content End --}}

        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Footer Start -->
    @include('Frontend.Dashboard.Includes.footer')
    <!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
@endsection
@push('script')
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
  @if (Session::has('message'))
    var type = "{{ Session::get('type', 'info') }}"
    switch(type){
      case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;
      case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;
      case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;
      case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;
    }
  @endif

  @if(session::has('notify'))
    Swal.fire({
        title: "{{ Session::get('title') }}",
        text: "{{ Session::get('notify') }}",
        icon: "{{ Session::get('icon') ?  Session::get('icon') : 'question' }}"
    });

  @endif
</script>
@endpush
