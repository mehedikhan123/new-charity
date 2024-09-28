<!-- Topbar Start -->
<div class="container-fluid px-5 d-none d-lg-block text-white bg-primary">
    <div class="row gx-0">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center" style="height: 67px;">
                @if($global_setting_data->top_address!='')
                    <span><i class="fas fa-map-marker-alt"></i> {{ $global_setting_data->top_address }}</span>
                @endif

                @if($global_setting_data->top_phone!='')
                    <span class="ms-3"><i class="fas fa-phone"></i> {{ $global_setting_data->top_phone }}</span>
                @endif

                @if($global_setting_data->top_email!='')
                    <span class="ms-3"><i class="fas fa-envelope"></i> {{ $global_setting_data->top_email }}</span>
                @endif
            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 67px;">
                <a href="{{ route('donate.index') }}"><button class="btn-donate ms-3">Donate Here</button></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-md-5 py-3 py-lg-0">
        <a href="{{ route('home') }}" class="navbar-brand p-0">
            <div class="d-flex align-items-center">
                <img src="{{ asset('storage/uploads/photo/'. $global_setting_data->logo_1) }}" alt="SBF_logo">
                <p class="ms-1 text-white m-0 text-uppercase fw-bold fs-5">{{ $global_setting_data->seo_company_name }}</p>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link fw-bold {{ Route::is('home') ? 'active' : '' }} fs-6">Home</a>
                <a href="{{ route('appeals.index') }}" class="nav-item nav-link fw-bold {{ Route::is('appeals*') ? 'active' : '' }} fs-6">Appeals</a> 
                <!-- Parent Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ Route::is('about.history', 'about', 'executive*', 'volunteer*') ? 'active' : '' }} fs-6" data-bs-toggle="dropdown">About</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('about.history') }}" class="dropdown-item {{ Route::is('about.history') ? 'active' : '' }}">History</a>
                        <a href="{{ route('about') }}" class="dropdown-item {{ Route::is('about') ? 'active' : '' }}">Who we are</a>
                        <a href="{{ route('executive.index') }}" class="dropdown-item {{ Route::is('executive*') ? 'active' : '' }}">Executives</a>
                        <a href="{{ route('volunteer.index') }}" class="dropdown-item {{ Route::is('volunteer*') ? 'active' : '' }}">Volunteers</a>
                    </div>
                </div>
                <a href="{{ route('programs.index') }}" class="nav-item nav-link fw-bold {{ Route::is('programs*') ? 'active' : '' }} fs-6">Program</a>
                <!-- Parent Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ Route::is('post/successful-stories*', 'stories.feedback') ? 'active' : '' }} fs-6" data-bs-toggle="dropdown">Stories</a>
                    <div class="dropdown-menu m-0">
                        <!-- Child Dropdown -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item dropdown-toggle {{ Route::is('gallery.photo*', 'gallery.video*') ? 'active' : '' }}" data-bs-toggle="dropdown">Gallery</a>
                            <div class="dropdown-menu">
                                <a href="{{ route('gallery.photo') }}" class="dropdown-item {{ Route::is('gallery.photo*') ? 'active' : '' }}">Picture</a>
                                <a href="{{ route('gallery.video') }}" class="dropdown-item {{ Route::is('gallery.video*') ? 'active' : '' }}">Video</a>
                            </div>
                        </div>
                        <a href="{{ route('successful.stories') }}" class="dropdown-item {{ Route::is('post/successful-stories*') ? 'active' : '' }}">Successful Stories</a>
                        <a href="{{ route('testimonials.index') }}" class="dropdown-item {{ Route::is('testimonials*') ? 'active' : '' }}">Feedback</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ Route::is('volunteer.create', 'cause*') ? 'active' : '' }} fs-6" data-bs-toggle="dropdown">Get Involved</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('volunteer.create') }}" class="dropdown-item {{ Route::is('volunteer.create') ? 'active' : '' }}">Join volunteer</a>
                        {{-- <div class="dropdown-submenu"> --}}
                            {{-- <a href="#" class="dropdown-item dropdown-toggle {{ Route::is('donate.index', 'involved.donation.monthly') ? 'active' : '' }}" data-bs-toggle="dropdown">Donation</a> --}}
                            {{-- <div class="dropdown-menu">
                                <a href="{{ route('involved.donation.one-time') }}" class="dropdown-item {{ Route::is('involved.donation.one-time') ? 'active' : '' }}">One time</a>
                                <a href="{{ route('involved.donation.monthly') }}" class="dropdown-item {{ Route::is('involved.donation.monthly') ? 'active' : '' }}">Monthly</a>
                            </div> --}}
                        {{-- </div> --}}
                        <a href="{{ route('cause.index') }}" class="dropdown-item {{ Route::is('cause*') ? 'active' : '' }}">Be a sponsor</a>
                    </div>
                </div>
                <a href="{{ route('post.index') }}" class="nav-item nav-link fw-bold {{ Route::is('post*') ? 'active' : '' }} fs-6">Blogs</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link fw-bold {{ Route::is('contact') ? 'active' : '' }} fs-6">Contact</a>
            </div>
            <a href="{{ route('donate.index') }}" class="donate btn-donate {{ Route::is('donation') ? 'active' : '' }} fs-6">Donate</a>
        </div>        
    </nav>
</div>

