<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.admin_dashboard') }}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.admin_dashboard') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin_dashboard') }}"><i class="fas fa-tachometer-fast"></i> <span>Dashboard</span></a></li>

            <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.settings.index') }}"><i class="fas fa-cogs"></i> <span>Settings</span></a></li>

            <li class="{{ Request::is('admin/banners*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.banners.index') }}"><i class="fas fa-cogs"></i> <span>Banner Images</span></a></li>

            <li class="{{ Request::is('admin/sliders*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.sliders.index') }}"><i class="fas fa-sliders"></i> <span>Sliders</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/abouts*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-info-circle"></i><span>Abouts</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/abouts/about-category') || Request::is('admin/abouts/about-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.about-category.index') }}"><i class="fas fa-angle-right"></i> Category</a></li>
                    <li class="{{ Request::is('admin/abouts/about') || Request::is('admin/abouts/about/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.about.index') }}"><i class="fas fa-angle-right"></i> About</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/features*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.features.index') }}"><i class="fas fa-star"></i> <span>Features</span></a></li>

            <li class="{{ Request::is('admin/facilities*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.facilities.index') }}"><i class="fas fa-concierge-bell"></i> <span>Services</span></a></li>

            <li class="{{ Request::is('admin/appeals*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.appeals.index') }}"><i class="fas fa-tasks"></i> <span>Appeals</span></a></li>

            <li class="{{ Request::is('admin/programs*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.programs.index') }}"><i class="fas fa-calendar"></i> <span>Programs</span></a></li>

            <li class="{{ Request::is('admin/testimonial*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.testimonials.index') }}"><i class="fas fa-quote-left"></i> <span>Testimonials</span></a></li>

            <li class="{{ Request::is('admin/counters*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.counters.index') }}"><i class="fas fa-list-ol"></i> <span>Counters</span></a></li>

            <li class="{{ Request::is('admin/faqs*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.faqs.index') }}"><i class="fas fa-question-circle"></i> <span>FAQs</span></a></li>

            <li class="{{ Request::is('admin/users*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-user"></i> <span>Users</span></a></li>

            <li class="{{ Request::is('admin/executives*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.executives.index') }}"><i class="fas fa-user-tie"></i> <span>Executives</span></a></li>

            <li class="{{ Request::is('admin/volunteers*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.volunteers.index') }}"><i class="fas fa-heart"></i> <span>Volunteers</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/gallery/photos*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-images"></i><span>Photo Gallery</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/gallery/photos/photo-category') || Request::is('admin/gallery/photos/photo-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.gallery.photo-category.index') }}"><i class="fas fa-angle-right"></i> Category</a></li>
                    <li class="{{ Request::is('admin/gallery/photos/photo') || Request::is('admin/gallery/photos/photo/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.gallery.photo.index') }}"><i class="fas fa-angle-right"></i> Photo</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/gallery/videos*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-film"></i><span>Video Gallery</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/gallery/videos/video-category') || Request::is('admin/gallery/videos/video-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.gallery.video-category.index') }}"><i class="fas fa-angle-right"></i> Category</a></li>
                    <li class="{{ Request::is('admin/gallery/videos/video') || Request::is('admin/gallery/videos/video/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.gallery.video.index') }}"><i class="fas fa-angle-right"></i> Video</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/post-category/*')||Request::is('admin/post/*')||Request::is('admin/comments')||Request::is('admin/replies') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-blog"></i><span>Blog Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/post-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin_post_category_index') }}"><i class="fas fa-angle-right"></i> Categories</a></li>
                    <li class="{{ Request::is('admin/post/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin_post_index') }}"><i class="fas fa-angle-right"></i> Blogs</a></li>
                    <li class="{{ Request::is('admin/comments') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin_comment') }}"><i class="fas fa-angle-right"></i> Comments</a></li>
                    <li class="{{ Request::is('admin/replies') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin_reply') }}"><i class="fas fa-angle-right"></i> Replies</a></li>
                </ul>
            </li>

            {{-- <li class="nav-item dropdown {{ Request::is('admin/subscriber/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Subscriber Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/subscriber/index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin_subscriber_index') }}"><i class="fas fa-angle-right"></i> All Subscribers</a></li>
                    <li class="{{ Request::is('admin/subscriber/send-message') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin_subscriber_send_message') }}"><i class="fas fa-angle-right"></i> Send Message to All</a></li>
                </ul>
            </li> --}}

            {{-- <li class="{{ Request::is('admin/event/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin_event_index') }}"><i class="fas fa-hand-point-right"></i> <span>Events</span></a></li> --}}

            <li class="{{ Request::is('admin/news/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin_news_index') }}"><i class="fas fa-child"></i> <span>News</span></a></li>

            <li class="{{ Request::is('admin/orphans*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.orphans.index') }}"><i class="fas fa-child"></i> <span>Orphans</span></a></li>

            <li class="{{ Request::is('admin/cause*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.causes.index') }}"><i class="fas fa-hands-helping"></i> <span>Causes</span></a></li>

            <li class="{{ Request::is('admin/other-pages/terms*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.terms.index') }}"><i class="fas fa-file-contract"></i> <span>Terms Page</span></a></li>

            <li class="{{ Request::is('admin/other-pages/privacy*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.privacy.index') }}"><i class="fas fa-lock"></i> <span>Privacy Page</span></a></li>


        </ul>
    </aside>
</div>
