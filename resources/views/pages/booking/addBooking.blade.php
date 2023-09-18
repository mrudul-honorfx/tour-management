@extends('layouts.master')
@section('title')
    Hotel List
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.11.0/css/flag-icons.min.css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Package
        @endslot
        @slot('title')
            Add Package
        @endslot
    @endcomponent
    @php
        $tourData = $package->toArray();
        $startDate = \Carbon\Carbon::parse($tourData['tour_start_date']);
        $endDate = \Carbon\Carbon::parse($tourData['tour_end_date']);
        $numberOfDays = $startDate->diffInDays($endDate);
    @endphp
    <hr>
    <div class="row">
        <div class="col-lg-3">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary"><i class="uil uil-user me-3"></i>Package Information</h5>
                </div><!-- end card-header -->
                <div class="card-body">
                    <h3 class="card-title"><strong>{{ $package->departure_destination }} -
                            {{ $package->arrival_destination }} - {{ $packageAirline[0]->airline_name }} -
                            {{ $hotelInfo[0]['hotel_name'] }}</strong></h3>
                    <p class="card-text">
                        Total Days: {{ $numberOfDays }} <br>
                        Total Slots: {{ $package->total_slots }} <br>
                        Remaining Slots: {{ $availableSlots }} <br>
                    </p>

                </div><!-- end card-body -->
            </div>
        </div>
        <div class="col-lg-9">



            <div class="border-top">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @csrf

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            01
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-16 mb-1">Booking Details</h5>
                                    <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                </div>

                            </div>

                            <form class="repeater" enctype="multipart/form-data" action="{{ route('submitBooking') }}"
                                method="POST">
                                @csrf
                                <div class="row pt-4">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">Primary Traveller Name</label>
                                            <input id="p_traveller" name="p_traveller" type="text" class="form-control"
                                                placeholder="Ram">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="productname">Primary Traveller Email</label>
                                            <input id="arrival_destination" name="email" type="email"
                                                class="form-control" placeholder="ram@gmail.com">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">Primary Traveller Contact
                                                No:</label>
                                            <input id="p_traveller" name="contact_no" type="text" class="form-control"
                                                placeholder="Enter Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">Total Passengers</label>
                                            <input id="p_traveller" name="total_passenger" type="number"
                                                class="form-control" placeholder="No of Passanger">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">

                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturername">Departure Date</label>
                                            <input class="form-control"  type="date"
                                                value={{ date_format(date_create($package->tour_start_date), 'Y-m-d') }}
                                                id="tour_start_date" name="tour_start_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturername">Return Date</label>
                                            <input class="form-control" type="date" 
                                                value={{ date_format(date_create($package->tour_end_date), 'Y-m-d') }}
                                                id="return_date" name="return_date">
                                        </div>
                                    </div>

                                </div>

                                <div class="flex-grow-1 overflow-hidden pb-3">
                                    <h5 class="font-size-16 mb-1 mt-2">Co-Traveller Details</h5>
                                </div>
                                <div data-repeater-list="group-a" class="border border-primary p-3">
                                    <div data-repeater-item class="row">
                                        <div class="mb-3 col-lg-3">
                                            <label class="form-label" for="name">First Name:</label>
                                            <input type="text" id="name" name="firstname" class="form-control"
                                                placeholder="Enter your first name" />
                                        </div>

                                        <div class="mb-3 col-lg-3">
                                            <label class="form-label" for="email">Last Name:</label>
                                            <input type="text" id="email" name="lastname" class="form-control"
                                                placeholder="Enter your last name" />
                                        </div>

                                        <div class="mb-3 col-lg-2">
                                            <label class="form-label" for="subject">Ticket Number:</label>
                                            <input type="text" id="subject" name="ticketnumber"
                                                class="form-control" placeholder="Enter your ticket number" />
                                        </div>

                                        <div class="mb-3 col-lg-2">

                                            <label class="form-label" for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-select">
                                                <option value="">Select</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>

                                            </select>

                                        </div>

                                        <div class="col-lg-2 mt-1">
                                            <label class="form-label" for="gender">Action</label>
                                            <div class="d-flex">
                                                <input data-repeater-delete type="button" class="btn btn-primary"
                                                    value="Delete" />
                                                <input data-repeater-create type="button" class="btn btn-success ms-2"
                                                    value="Add" />
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <hr class="my-2 ">
                                <div class="row pt-4">
                                    <div class="flex-grow-1 overflow-hidden mb-2">
                                        <h5 class="font-size-16 mb-1 my-2">Hotel Preferences</h5>
                                    </div>
                                    <p><strong class="font-size-18 mb-2">Hotel Name:
                                            {{ $hotelInfo[0]['hotel_name'] }}</strong><br>
                                        Hotel Address: {{ $hotelInfo[0]['hotel_address'] }}</p>
                                    <input type="hidden" name="b_details[hotel_id]" value="{{ $hotelInfo[0]['id'] }}">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">Room Type
                                            </label>
                                            <select id="room_type" name="b_details[room_type_id]" class="form-select">
                                                @foreach ($hotelInfo[0]['rooms'] as $room)
                                                    <option value="{{ $room->id }}">{{ $room->room_type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">View Type
                                            </label>
                                            <select id="view_type" name="b_details[view_type_id]" class="form-select">
                                                @foreach ($hotelInfo[0]['view'] as $view)
                                                    <option value="{{ $view->id }}">{{ $view->view_type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">Food Type
                                            </label>
                                            <select id="food_type" name="b_details[food_type_id]" class="form-select">
                                                @foreach ($hotelInfo[0]['food'] as $food)
                                                    <option value="{{ $food->id }}">{{ $food->food_type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">Number of Rooms
                                            </label>
                                            <input id="no_of_rooms" name="b_details[no_of_rooms]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">Check In Date
                                            </label>
                                            <input class="form-control" type="date" 
                                                value={{ date_format(date_create($package->tour_start_date), 'Y-m-d') }}
                                                id="check_in_date" name="b_details[check_in_date]">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">Check Out Date
                                            </label>
                                            <input class="form-control" type="date"
                                                value={{ date_format(date_create($package->tour_end_date), 'Y-m-d') }}
                                                id="check_out_date" name="b_details[check_out_date]">
                                        </div>
                                    </div>

                                </div>


                                <hr class="my-2 ">
                                <div class="row pt-4">
                                    <div class="flex-grow-1 overflow-hidden mb-2">
                                        <h5 class="font-size-16 mb-1 my-2">Airline Information</h5>
                                    </div>

                                    <div>
                                        @component('common-components.airticket', ['packageAirline' => $packageAirline])
                                        @endcomponent
                                    </div>



                                </div>

                                <hr class="my-2 ">
                                <div class="col-lg-2 mt-4">
                                    <input type="submit" class="btn btn-primary" value="Submit Booking" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        @endsection
        @section('script')
            <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
            <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
            <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
            <script src="{{ URL::asset('/assets/js/pages/multiselect-dropdown.js') }}"></script>
            <!-- Plugins js -->
            <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
            <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
        @endsection