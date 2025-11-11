@extends('Backend.Layouts.app')

@section('app-content')
<div class="wrapper">

    <!-- Navbar -->
     @includeIf('Backend.Includes.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
      @includeIf('Backend.Includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @includeIf('Backend.Includes.breadcurmb')
      <!-- /.content-header -->
      <div class="px-3">
        @if(session('message'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @endif
      </div>
      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <!-- All Content goes form here-->
              @yield('master-content')
          </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!--footer content-->
    @includeIf('Backend.Includes.footer')
    <!--footer content end-->

  </div>
@endsection
