@php
    $configer = App\Models\Configer::latest()->first();
@endphp
<link rel="stylesheet" href="{{ url('Backend/css/sidebar.css') }}">
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('Frontend') }}/assets/img/logo/pavicon.icon" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $configer->name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2 pb-7">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-house mr-1"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <!-- Educational info -->
                <li class="nav-item">
                    <a href="{{ route('admin.eduinfo.index') }}"
                        class="nav-link {{ Route::is('admin.eduinfo.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <p>Educational Info </p>
                    </a>
                </li>
                <!-- services -->
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}"
                        class="nav-link {{ Route::is('admin.services.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-list-ul"></i> 
                        <p>Services </p>
                    </a>
                </li>
                <!-- country -->
                <li class="nav-item">
                    <a href="{{ route('admin.country.index') }}"
                        class="nav-link {{ Route::is('admin.country.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-earth-americas"></i>
                        <p>Country </p>
                    </a>
                </li>
                <!-- course -->
                <li class="nav-item">
                    <a href="{{ route('admin.course.index') }}"
                        class="nav-link {{ Route::is('admin.course.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-book"></i>
                        <p>Courses </p>
                    </a>
                </li>
                <!-- Studylevel -->
                <li class="nav-item">
                    <a href="{{ route('admin.studylevel.index') }}"
                        class="nav-link {{ Route::is('admin.studylevel.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-graduate"></i>
                        <p>Study Level </p>
                    </a>
                </li>
                <!-- University -->
                <li class="nav-item">
                    <a href="{{ route('admin.university.index') }}"
                        class="nav-link {{ Route::is('admin.university.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-building-columns"></i>
                        <p>University</p>
                    </a>
                </li>
                <!-- Pro Consultants (Package) -->
                <li
                    class="nav-item has-treeview {{ Route::is('admin.proUser.packages') ? 'menu-open' : '' }}">
                    <a class="nav-link">
                        <i class="fa-solid fa-crown"></i>
                        <p>
                            Pro-Consultants
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.proUser.packages') }}"
                                class="nav-link {{ Route::is('admin.proUser.packages') ? 'active' : '' }}">
                                <i class="fa-solid fa-box-open"></i>
                                <p>Packages</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Verified Consultants -->
                <li
                    class="nav-item has-treeview {{ Route::is('admin.verified.user') ? 'menu-open' : '' }}">
                    <a class="nav-link">
                        <i class="fa-solid fa-user-check"></i>
                        <p>
                            Verified-Consultants
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.verified.user') }}"
                                class="nav-link {{ Route::is('admin.verified.user') ? 'active' : '' }}">
                                <i class="fa-solid fa-bell"></i>
                                <p>Request</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Student -->
                <li
                    class="nav-item has-treeview {{ Route::is('admin.student.query') ? 'menu-open' : '' }}">
                    <a class="nav-link">
                        <i class="fa-solid fa-user-graduate"></i>
                        <p>
                            Student
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.student.query') }}"
                                class="nav-link {{ Route::is('admin.student.query') ? 'active' : '' }}">
                                <i class="fa-solid fa-clipboard-question"></i>
                                <p>Queries</p>
                            </a>
                        </li>
                    </ul>
                </li>

                 <!-- Training Section -->
                <li class="nav-item">
                    <a href="{{ route('admin.trianingInfo.index') }}"
                        class="nav-link {{ Route::is('admin.trianingInfo.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <p>Trainings </p>
                    </a>
                </li>

                 <!-- Transaction -->
                <li
                    class="nav-item has-treeview {{ Route::is('admin.user.serviceCharge') ? 'menu-open' : '' }}">
                    <a class="nav-link">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        <p>
                            Transaction
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.serviceCharge') }}"
                                class="nav-link {{ Route::is('admin.proUser.packages') ? 'active' : '' }}">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                <p>Service Charge</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item has-treeview {{ Route::is('admin.user.index') || Route::is('admin.user.create') || Route::is('admin.user.show') || Route::is('admin.user.edit') ? 'menu-open' : '' }}">
                    <a class="nav-link">
                        <i class="mr-1 fa-solid fa-user-shield"></i>
                        <p>
                            Manage Users
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.create') }}"
                                class="nav-link {{ Route::is('admin.user.create') ? 'active' : '' }}">
                                <i class="mr-1 fa-solid fa-plus"></i>
                                <p>Create User </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                                class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                                <i class="mr-1 fa-solid fa-list"></i>
                                <p>All Users </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.slider.index') }}"
                        class="nav-link {{ Route::is('admin.slider.index') || Route::is('admin.slider.create') || Route::is('admin.slider.show') || Route::is('admin.slider.edit') ? 'active' : '' }}">
                        <i class="mr-1 fa-brands fa-slideshare"></i>
                        <p>Slider </p>
                    </a>
                </li>
                <li
                    class="nav-item has-treeview {{ Route::is('admin.about.index') || Route::is('admin.about.create') || Route::is('admin.about.show') || Route::is('admin.about.edit') || Route::is('admin.companyView') || Route::is('admin.companyDetails') ? 'menu-open' : '' }}">
                    <a class="nav-link">
                        <i class="mr-1 fa-solid fa-briefcase"></i>
                        <p>
                            About Company
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.companyDetails') }}"
                                class="nav-link {{ Route::is('admin.admin.companyDetails') ? 'active' : '' }}">
                                <i class="mr-1 fa-solid fa-address-card"></i>
                                <p>Company Informations </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.about.index') }}"
                                class="nav-link {{ Route::is('admin.about.index') || Route::is('admin.about.create') || Route::is('admin.about.show') || Route::is('admin.about.edit') || Route::is('companyView') ? 'active' : '' }}">
                                <i class="mr-1 fa-solid fa-address-card"></i>
                                <p>About us </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.contactContent') }}"
                        class="nav-link {{ Route::is('admin.contactContent') || Route::is('admin.contactShow') ? 'active' : '' }}">
                        <i class="mr-1 fa-solid fa-envelope-open-text"></i>
                        <p>Message </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.testimonials.index') }}"
                        class="nav-link {{ Route::is('admin.testimonials.index') || Route::is('admin.testimonials.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-message"></i>
                        <p>Testimonials </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.faq.index') }}"
                        class="nav-link {{ Route::is('admin.faq.index') || Route::is('admin.faq.index') ? 'active' : '' }}">
                        <i class="mr-1 fa-solid fa-envelope-open-text"></i>
                        <p>F.A.Q </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.schedule.index') }}"
                        class="nav-link {{ Route::is('admin.schedule.index') || Route::is('admin.schedule.index') ? 'active' : '' }}">
                        <i class="mr-1 fa-regular fa-clock"></i>
                        <p>Class Schedule </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.order.index') }}"
                        class="nav-link {{ Route::is('admin.order.index') || Route::is('admin.order.index') ? 'active' : '' }}">
                        <i class="mr-1 fa-solid fa-cart-shopping"></i>
                        <p>Orders </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.configer.index') }}"
                        class="nav-link {{ Route::is('admin.configer.index') || Route::is('admin.configer.edit') ? 'active' : '' }}">
                        <i class="mr-1 fa-solid fa-screwdriver-wrench"></i>
                        <p>Configuration </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.termscondition.index') }}"
                        class="nav-link {{ Route::is('admin.termscondition.index') || Route::is('admin.termscondition.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-circle-info"></i>
                        <p>Terms & Condition</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
