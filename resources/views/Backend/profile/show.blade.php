@extends('Backend.Layouts.master')
@section('title', 'Show Profile')
@section('master-content')
<div class="row">
    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.profile.show') }}">Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile - {{ ucfirst($user->name) }}</li>
                    <li style="margin-left: auto">
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-reply"></i></a>
                    </li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ asset($user->image ? $user->image : 'https://bootdey.com/img/Content/avatar/avatar7.png') }}" alt="Admin" class="rounded-circle" style="height: 150px;width:150px;object-fit:cover;">
                                <div class="mt-3">
                                    <h4>{{ ucfirst($user->name) }}</h4>
                                    <p class="text-secondary mb-1">{{ ucfirst($user->role) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>Website</h6>
                                <span class="text-secondary">{{ $user->website }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline">
                                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                    </svg>Github</h6>
                                <span class="text-secondary">{{ $user->github }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info">
                                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                    </svg>Twitter</h6>
                                <span class="text-secondary">{{ $user->twitter }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M2 22h4V8H2v14zM4 6a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm18 11.65c0-.3-.25-.65-.55-.85-.55-.35-1.25-.8-2-1.3v-.05c0-.05.05-.15.05-.2 0-.1 0-.15-.05-.2-.25-.35-.6-.55-1.05-.55s-.85.2-1.1.55c-.05.05-.05.1-.05.2s.05.15.05.2c.25.3.4.55.4.85 0 .3-.15.6-.4.85s-.6.4-.95.4c-.5 0-.85-.4-.95-.85 0-.05-.05-.1-.05-.2s.05-.15.05-.2c.05-.1.05-.15 0-.2 0-.05-.05-.1-.05-.15v-.05c-.75.5-1.45.95-2 1.3-.3.2-.55.55-.55.85 0 .6.5 1.1 1.1 1.1h11.75c.6 0 1.1-.5 1.1-1.1zM16 10c0 1.1-.9 2-2 2s-2-.9-2-2 2-2 2 2zm-5 2h-2v-4h2v4zm-3 0H6v-4h2v4zm-3 0H2v-4h3v4zm0-5H2V8h3v4zm0-5H2V3h3v4zm15 7h-2V8h2v4zm0-5h-2V3h2v4z"/>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>LinkedIn</h6>
                                <span class="text-secondary">{{ $user->linkedin }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                    </svg>Facebook</h6>
                                <span class="text-secondary">{{ $user->facebook }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  {{ ucfirst($user->name) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  {{ $user->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->phone }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Role</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  {{ $user->role }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gutters-sm">
                        <div class="col-sm-12 cpol-md-12 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Thank Message</h6>
                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit habitant vitae dapibus ac ultricies, sapien euismod turpis a vehicula varius nisl tellus felis placerat quam. Ante id lacus pretium parturient donec sapien, potenti etiam nostra sociosqu luctus rutrum congue, sollicitudin faucibus tristique erat imperdiet. Morbi nam arcu suscipit quam porta aenean dictum non laoreet faucibus gravida suspendisse, diam ligula auctor velit accumsan facilisi tempor enim nibh eu curae.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
