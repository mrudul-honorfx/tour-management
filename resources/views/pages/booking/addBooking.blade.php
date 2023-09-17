@extends('layouts.master')
@section('title')
    Hotel List
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css" />
    
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


   
    <div class="row">
        <div class="col-lg-12">
           
               
                       
                            <div class="p-4 border-top">
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
                            <form class="repeater"  enctype="multipart/form-data" action="{{ route('submitBooking') }}" method="POST"
                            >
                            @csrf
                                <div class="row">
                                    <div class="col-lg-4">

                                        <div class="mb-3">
                                            <label class="form-label" for="primary_traveller">Primary Traveller Name</label>
                                            <input id="p_traveller" name="p_traveller" type="text"
                                                class="form-control" placeholder="Ram">
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
                                            <label class="form-label" for="primary_traveller">Primary Traveller Contact No:</label>
                                            <input id="p_traveller" name="contact_no" type="text"
                                                class="form-control" placeholder="Enter Contact Number">
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
                                            <input class="form-control" type="date" value=""
                                        
                                                id="tour_start_date" name="tour_start_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturername">Return Date</label>
                                            <input class="form-control" type="date" value=""
                                                id="return_date" name="return_date">
                                        </div>
                                    </div>

                                </div>   
                               

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-16 mb-1 mt-2">Co-Traveller Details</h5>
                                </div>
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item class="row">
                                        <div class="mb-3 col-lg-3">
                                            <label class="form-label" for="name">First Name:</label>
                                            <input type="text" id="name" name="firstname" class="form-control" placeholder="Enter your first name" />
                                        </div>
            
                                        <div class="mb-3 col-lg-3">
                                            <label class="form-label" for="email">Last Name:</label>
                                            <input type="text" id="email" name="lastname" class="form-control" placeholder="Enter your last name" />
                                        </div>
            
                                        <div class="mb-3 col-lg-2">
                                            <label class="form-label" for="subject">Ticket Number:</label>
                                            <input type="text" id="subject" name="ticketnumber" class="form-control" placeholder="Enter your ticket number" />
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
                                                <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" />
                                               
                                            </div>
                                        </div>
                                       
                           
                        </div>
                    </div>
                    <input data-repeater-create type="button" class="btn btn-success ms-2" value="Add Co–Passenger" />
                    <div class="d-flex align-items-center mt-3">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-xs">
                                <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                    02
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="font-size-16 mb-1">Itenary Details</h5>
                            <p class="text-muted text-truncate mb-0">Fill all information below</p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                        </div>

                    </div>
                         <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="metatitle">Hotel</label>
                                                <select name="hotel_id" id="hotel_id" class="form-select">
                                                    <option>Select</option>
                                                    @foreach ($hotelList as $index => $hotel)
                                                        <option value={{ $hotel->id }}>{{ $hotel->hotel_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-sm-4">
                                            <div class="mb-3">

                                                <div class="row">
                                                    
                                                    <div>
                                                        <label class="form-label" for="metatitle">Room View</label>
                                                        <select name="room_view_id[]" id="room_view_id"
                                                            class="form-select" multiple multiselect-select-all="true" multiselect-search="true" >
                                                            @foreach ($roomViewList as $index => $roomView)
                                                                <option value={{ $roomView->id }}>
                                                                    {{ $roomView->view_type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                    
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="metatitle">Food Offerings</label>       
                                                <select name="food_type[]" id="food_type"
                                                    class="form-select" multiple multiselect-select-all="true" multiselect-search="true" >
                                                    @foreach ($foodTypeList as $index => $foodType)
                                                        <option value={{ $foodType->id }}>
                                                            {{ $foodType->food_type_name }}</option>
                                                    @endforeach
                                                </select>
                                                   
                                                
                                            </div>

                                        </div>

                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="metatitle">Room Type</label>
                                                <select name="room_type[]" id="room_type"
                                                    class="form-select" multiple multiselect-select-all="true" multiselect-search="true" >
                                                    @foreach ($roomTypeList as $index => $roomType)
                                                        <option value={{ $roomType->id  }}>
                                                            {{ $roomType->room_type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                      
                                        <div class="col-lg-4">

                                            <div class="mb-3">
                                                <label class="form-label" for="manufacturername">Check In Date</label>
                                                <input class="form-control" type="date" value=""
                                            
                                                    id="tour_start_date" name="check_in_data">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
    
                                            <div class="mb-3">
                                                <label class="form-label" for="manufacturername">Check Out Date</label>
                                                <input class="form-control" type="date" value=""
                                                    id="return_date" name="check_out_data">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-4">
                                            <label class="form-label" for="subject"> Number Of Rooms</label>
                                            <input type="text" id="subject" name="number_of_rooms" class="form-control" placeholder="Enter your number_of_rooms " />
                                        </div>
                                        <div class="mb-3 col-lg-4">
                                            <label class="form-label" for="subject"> Flight Class</label>
                                            <input type="text" id="subject" name="flightclass" class="form-control" placeholder="Enter your Flight Class " />
                                        </div>
            
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
