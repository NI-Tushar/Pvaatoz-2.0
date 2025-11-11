@extends('layouts.app')
@section('title', 'Home')

@push('css')
 

@endpush

@section('app-content')

    <h1>Landing page</h1>
                        <form action="{{ route('logout') }}" method="POST" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        @csrf
                        <button type="submit" class="log_out_confirm" style="background: transparent;border:transparent;outline:none;width:100%;text-align:left;padding:0;color:rgb(58, 58, 58)">
                            <span>{{ __('message.Logout') }}</span>
                        </button>
                    </form>
     
@endsection
@push('script')

@endpush
