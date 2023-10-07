<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{url('index')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="20">
            </span>
        </a>

        <a href="{{url('index')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="20">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    <a href="{{url('dashboard')}}">
                        <i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end">01</span>
                        <span>@lang('translation.Dashboard')</span>
                    </a>
                </li>
              
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-window-section"></i>
                        <span>Packages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                         {{-- check if the user has permision to manage package --}}
                         @if(auth()->user()->role->permissions->contains('permission', 'create_package') || auth()->user()->role->id == 2)
                            <li>
                              
                                <a href="{{url('/package/add')}}">
                                    <i class="mdi mdi-plus"></i>
                                    <span>Add New Package</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->role->permissions->contains('permission', 'view_package') || auth()->user()->role->id == 2)
                        <li>
                            <a href="{{url('/package/plisting')}}">
                                <i class="mdi mdi-format-list-checkbox
                                "></i>
                                <span>Package List </span>
                            </a>
                        </li>
                        @endif
                        
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-window-section"></i>
                        <span>Bookings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        @if(auth()->user()->role->permissions->contains('permission', 'create_booking') || auth()->user()->role->id == 2)
                        <li>
                            <a href="{{url('/package/plisting')}}">
                                <i class="mdi mdi-plus"></i>
                                <span>Add Bookings</span>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->role->permissions->contains('permission', 'view_booking') || auth()->user()->role->id == 2)
                        <li>
                            <a href="{{url('/booking/blisting')}}">
                                <i class="mdi mdi-format-list-checkbox
                                "></i>
                                <span>Booking List</span>
                            </a>
                        </li>
                        @endif
                       
                    </ul>
                </li>
                @if(auth()->user()->role->permissions->contains('permission', 'edit_package_settings') || auth()->user()->role->id == 2)
                <li class="menu-title">Package Settings</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>Hotel</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/hotel/hotel_list') }}"><i class="uil-book-medical"></i> Add Hotel</a></li>
                        <li><a href="{{ url('/hotel/hotel_room_type') }}"><i class="uil-home"></i> Room Types</a></li>
                        <li><a href="{{ url('/hotel/hotel_food_type') }}"><i class="mdi mdi-food"></i>Food Types</a></li>
                        <li><a href="{{ url('/hotel/hotel_view_type') }}"><i class="uil-map-pin-alt"></i>View Types</a></li> 
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>Airline</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/airline/addProvider') }}"><i class="uil-book-medical"></i> Airline Providers</a></li>
                        <li><a href="{{ url('/airline/addAirportphp') }}"><i class="uil-home"></i>Destinations</a></li>
                       
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>Trasportation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/hotel/hotel_list') }}"><i class="uil-book-medical"></i> New Vehicle Type</a></li>
                       
                    </ul>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('permission', 'create_hotel_report') || auth()->user()->role->id == 2)
                <li class="menu-title">Staff Settings</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>Staff</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/staff/role') }}"><i class="mdi mdi-account-convert
                            "></i>Roles</a></li>
                        <li><a href="{{ url('/staff/staff_list') }}"><i class="mdi mdi-account-multiple-plus"></i>Staff List</a></li>
                       
                        <li><a href="{{ url('/permission/permission_list') }}"><i class="mdi mdi-account-settings"></i>Permissions</a></li>  
                        <li><a href="{{ url('/permission/permission_mapping') }}"><i class="mdi mdi-account-network
                            "></i>Permission Mapping</a></li>  
                    </ul>
                    
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>Bank</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/bank/bankDetails') }}"><i class="mdi mdi-account-convert
                            "></i>Bank Details</a></li>
                    </ul>
                    
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('permission', 'permission_admin') || auth()->user()->role->id == 2)
                <li class="menu-title">Reports</li>
                <li>
                   
                    <li><a href="{{ url('/reports/hotelReport') }}"><i class="mdi mdi-account-convert
                        "></i>Hotel Report</a></li>
                    
                    
                </li>
                @endif

            

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
