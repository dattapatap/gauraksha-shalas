<div class="menu">
    <div class="menu-header">
        <a href="{{ url('/admin') }}" class="menu-header-logo">
            <img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo">
        </a>
        <a href="{{ url('/admin') }}" class="dashboard_close menu-close-btn">
            <i class="bi bi-x"></i>
        </a>
    </div>
    <div class="menu-body">
        <ul>
            <li>
                <a href="{{ url('/admin/home') }}">
                    <span class="nav-link-icon">
                        <i class="bi bi-bar-chart"></i>
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/donations')}}">
                    <span class="nav-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-currency-rupee" viewBox="0 0 16 16">
                            <path
                                d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z" />
                        </svg>
                    </span>
                    <span>Donations List</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/admin/donors-list')}}">
                    <span class="nav-link-icon">
                        <i class="bi bi-person"></i>
                    </span>
                    <span>Donors List</span>
                </a>
            </li>



            <li>
                <a href="javascript:void(0);">
                    <span class="nav-link-icon"><i class="bi bi-globe"></i> </span>
                    <span>Manage Website </span>
                </a>
                <ul>

                    <li>
                        <a href="{{ url('admin/blogs') }}">Events , Blog, News </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/abouts') }}">About Us</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/trustees') }}">Trustees</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/sevas') }}">Sevas</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/projects') }}">Projects</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/testimonial') }}">Testimonials</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)">
                    <span class="nav-link-icon"> <i class="bi bi-hdd-stack"></i> </span>
                    <span> Services Pages </span>
                </a>
                <ul>
                    <li>
                        <a href="{{ url('admin/adopt-cow') }}">Adopt Cow</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/volunteer')}}">Volunteer</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/donations-form')}}">Donation-Form</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)">
                    <span class="nav-link-icon"> <i class="bi bi-files"></i> </span>
                    <span>Galleries</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ url('admin/slider') }}">Banners</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/images')}}">Gallery Images</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/videos')}}">Videos</a>
                    </li>
                </ul>
            </li>



            <li>
                <a href="javascript:void(0);">
                    <span class="nav-link-icon"><i class="bi bi-file-ruled"></i> </span>
                    <span>Terms & Policies </span>
                </a>
                <ul>
                    <li>
                        <a href="{{ url('admin/privacypolicy')}}">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/termsandcondition')}}">Terms &amp; Conditions</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/returnandrefund')}}">Refunds Policy</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/cancellationpolicy')}}">Cancellation Policy</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ url('admin/settings/appsettings')}}">
                    <span class="nav-link-icon"> <i class="bi bi-gear"></i></span>
                    <span>Settings</span>
                </a>
            </li>

        </ul>
    </div>
</div>
