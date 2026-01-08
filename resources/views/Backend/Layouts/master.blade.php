@extends('Backend.Layouts.app')

@section('app-content')
<div class="dashboard">
  <!-- Main Sidebar Container -->
  @includeIf('Backend.Includes.sidebar')

    <!-- Main Content -->
    <main class="main-content">
      @includeIf('Backend.Includes.navbar')
      @yield('master-content')

    <!--footer content-->
    @includeIf('Backend.Includes.footer')
    <!--footer content end-->
 </main>
</div>
@endsection
