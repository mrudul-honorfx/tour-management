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
            <div id="addproduct-accordion" class="custom-accordion">
                <form class="needs-validation " novalidate action="{{ route('addPackage.store') }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="card">
                        <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                            <div class="p-4">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Package Details</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>

                        <div id="addproduct-billinginfo-collapse" class="collapse show"
                            data-bs-parent="#addproduct-accordion">
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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="productname">Package Name</label>
                                            <input id="package_name" required name="package_name" type="text"
                                                class="form-control" placeholder="Makkah Package">
                                            <div class="invalid-feedback">
                                                Please provide a package name
                                            </div>
                                        </div>
                                    </div>
        
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="mb-3">
                                            <label class="form-label" for="productname">From</label>
                                            <input id="departure_destination" required name="departure_destination" type="text"
                                                class="form-control" placeholder="Dubai">
                                            <div class="invalid-feedback">
                                                Please provide a departure destination
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="productname">To</label>
                                            <input id="arrival_destination" required name="arrival_destination" type="text"
                                                class="form-control" placeholder="Jeddha">
                                            <div class="invalid-feedback">
                                                Please provide a arrival destination
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">

                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturername">Start Date</label>
                                            <input class="form-control" type="datetime-local" value="<?php echo date('Y-m-d'); ?>"
                                                id="tour_start_date" required name="tour_start_date">
                                            <div class="invalid-feedback">
                                                Please provide a arrival destination
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturername">End Date</label>
                                            <input class="form-control" type="datetime-local" value="<?php echo date('Y-m-d'); ?>"
                                                id="tour_end_date" required name="tour_end_date">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturername">Total Slots</label>
                                            <input class="form-control" type="number" value="20" id="total_slots"
                                                required name="total_slots">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <a href="#addpackage-airline-collapse" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="addpackage-airline-collapse">
                            <div class="p-4">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                02
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Airline Details</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>
                        {{-- 'tour_package_id', 'airline_id', 'flight_number', 'departure_date_time', 'arrival_date_time', 'departure_destination', 'arrival_destination', 'available_seats', 'luggage_capacity', 'check_in_luggage' --}}
                        <div id="addpackage-airline-collapse" class="collapse show"
                            data-bs-parent="#addproduct-accordion">
                            <div class="repeater">
                                <div data-repeater-list="group-a" class="p-3">
                                <div data-repeater-item class="row">
                                    <div class="p-4 border-top border-dashed">
                                        <div class="row">
                                            <div class="col-11 border border-primary p-3">
                                                <div class="row ">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="productname">Airline</label>
                                                            <select required name="airline_id" id="airline_id" class="form-select">
                                                                <option value="">Select</option>
                                                                @foreach ($airlineProviders as $index => $airline)
                                                                    <option value={{ $airline->id }}>{{ $airline->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="productname">Flight Number</label>
                                                            <input id="flight_number" required name="flight_number" type="text"
                                                                class="form-control" placeholder="E1098">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="productname">PNR Number</label>
                                                            <input id="flight_number" name="pnr" type="text"
                                                                class="form-control" placeholder="PNR#93749">
                                                        </div>
                                                    </div>
                                                </div>
                
                                                <div class="row">
                                                    <div class="col-lg-6">
                
                                                        <div class="mb-3">
                                                            <label class="form-label" for="productname">Depature Airport</label>
                                                            <select required name="departure_destination" id="departure_destination"
                                                                class="form-select">
                                                                <option value="">Select</option>
                                                                @foreach ($airportLocations as $index => $airports)
                                                                    <option value={{ $airports->id }}> {{ $airports->airport_name }}
                                                                        ({{ $airports->iata_code }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="productname">Arrival Airport</label>
                                                            <select required name="arrival_destination" id="arrival_destination"
                                                                class="form-select">
                                                                <option vlaue="">Select</option>
                                                                @foreach ($airportLocations as $index => $airports)
                                                                    <option value={{ $airports->id }}> {{ $airports->airport_name }}
                                                                        ({{ $airports->iata_code }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                
                                                <div class="row">
                                                    <div class="col-lg-6">
                
                                                        <div class="mb-3">
                                                            <label for="departure-time" class="form-label">Est. Departure Time</label>
                
                                                            <input class="form-control" type="datetime-local" value=""
                                                                id="departure_date_time" required name="departure_date_time">
                
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="departure-time" class="form-label">Est. Arrival Time</label>
                
                                                            <input class="form-control" type="datetime-local" value=""
                                                                id="arrival_date_time" required name="arrival_date_time">
                
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                
                                                        <div class="mb-3">
                                                            <label for="departure-time" class="form-label">Luggage Capacity (in KG)</label>
                
                                                            <input class="form-control" type="number" placeholder="10"
                                                                id="luggage_capacity" required name="luggage_capacity">
                
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="departure-time" class="form-label">Check In Baggage (in KG)</label>
                
                                                            <input class="form-control" type="number" placeholder="10"
                                                                id="check_in_luggage" required name="check_in_luggage">
                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="d-flex">
                                                    <input data-repeater-delete type="button" class="btn btn-primary"
                                                        value="-" />
                                                    <input data-repeater-create type="button" class="btn btn-success ms-2"
                                                        value="+" />
                                                </div>
                                            </div>
                                
                                        </div>
                                        
                                    </div>

                                </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>



                    <div class="card">
                        <a href="#addproduct-metadata-collapse" class="text-dark collapsed" data-bs-toggle="collapse"
                            aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
                            aria-controls="addproduct-metadata-collapse">
                            <div class="p-4">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                03
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Hotel Details</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>
                        {{-- 'hotel_id', 'tour_package_id', 'room_type_id', 'food_type_id', 'room_view_id', 'available_rooms' --}}
                        <div id="addproduct-metadata-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                            <div id="hotelFormSet">
                                <div class="p-4 border-top">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="metatitle">Hotel</label>
                                                <select required name="hotel_id" id="hotel_id" class="form-select">
                                                    <option>Select</option>
                                                    @foreach ($hotelList as $index => $hotel)
                                                        <option value={{ $hotel->id }}>{{ $hotel->hotel_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">

                                                <div class="row">
                                                    
                                                    <div>
                                                        <label class="form-label" for="metatitle">Room View</label>
                                                        <select required name="room_view_id[]" id="room_view_id"
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
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="metatitle">Food Offerings</label>       
                                                <select required name="food_type[]" id="food_type"
                                                    class="form-select" multiple multiselect-select-all="true" multiselect-search="true" >
                                                    @foreach ($foodTypeList as $index => $foodType)
                                                        <option value={{ $foodType->id }}>
                                                            {{ $foodType->food_type_name }}</option>
                                                    @endforeach
                                                </select>
                                                   
                                                
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="metatitle">Room Type</label>
                                                <select required name="room_type[]" id="room_type"
                                                    class="form-select" multiple multiselect-select-all="true" multiselect-search="true" >
                                                    @foreach ($roomTypeList as $index => $roomType)
                                                        <option value={{ $roomType->id  }}>
                                                            {{ $roomType->room_type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mb-4 p-3">
                                <div class="col ms-auto">
                                    <div class="d-flex flex-reverse flex-wrap gap-2">
                                        <button class="btn btn-success" required name="add-hotel-group" id="add-hotel-group"> <i class="uil uil-file-alt"></i>Add Hotel Information</button>
                                    </div>
                                </div> <!-- end col -->
                            </div> --}}
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col ms-auto">
                            <div class="d-flex flex-reverse flex-wrap gap-2">
                                <button class="btn btn-success" type="submit"> <i class="uil uil-file-alt"></i>Add
                                    Package</button>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')

{{-- <script>
    var i = 0;
    $("#add-airline-group").click(function (e) {
        e.preventDefault();
        ++i;
        $("#airlineFormset").append(
            '<div class="p-4 border-top border-dashed"> <div class="row"> <div class="col-lg-6"> <div class="mb-3"> <label class="form-label" for="productname">Airline</label> <select required name="airline['+i+'][airline_id]" id="airline_id" class="form-select"> <option>Select</option> @foreach ($airlineProviders as $index => $airline) <option value="{{ $airline->id }}">{{ $airline->name }}</option> @endforeach </select> </div> </div> <div class="col-lg-6"> <div class="mb-3"> <label class="form-label" for="productname">Flight Number</label> <input id="flight_number" required name="airline['+i+'][flight_number]" type="text" class="form-control" placeholder="E1098"> </div> </div> </div> <div class="row"> <div class="col-lg-6"> <div class="mb-3"> <label class="form-label" for="productname">Departure Airport</label> <select required name="airline['+i+'][departure_destination]" id="departure_destination" class="form-select"> <option>Select</option> @foreach ($airportLocations as $index => $airports) <option value="{{ $airports->id }}"> {{ $airports->airport_name }} ({{ $airports->iata_code }})</option> @endforeach </select> </div> </div> <div class="col-lg-6"> <div class="mb-3"> <label class="form-label" for="productname">Arrival Airport</label> <select required name="airline['+i+'][arrival_destination]" id="arrival_destination" class="form-select"> <option>Select</option> @foreach ($airportLocations as $index => $airports) <option value="{{ $airports->id }}"> {{ $airports->airport_name }} ({{ $airports->iata_code }})</option> @endforeach </select> </div> </div> </div> <div class="row"> <div class="col-lg-6"> <div class="mb-3"> <label for="departure-time" class="form-label">Est. Departure Time</label> <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="departure_date_time" required name="airline['+i+'][departure_date_time]"> </div> </div> <div class="col-lg-6"> <div class="mb-3"> <label for="departure-time" class="form-label">Est. Arrival Time</label> <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="arrival_date_time" required name="airline['+i+'][arrival_date_time]"> </div> </div> </div> </div>'
        );
    });
    var j = 0;
    $("#add-hotel-group").click(function (e) {
        e.preventDefault();
        ++i;
        $("#hotelFormSet").append(
            '<div class="p-4 border-top"> <div class="row"> <div class="col-sm-6"> <div class="mb-3"> <label class="form-label" for="metatitle">Hotel</label> <select required name="hotel['+i+'][hotel_id]" id="hotel_id['+i+']" class="form-select"> <option>Select</option> @foreach ($hotelList as $index => $hotel) <option value={{ $hotel->id }}>{{ $hotel->hotel_name }}</option> @endforeach </select> </div> </div> <div class="col-sm-6"> <div class="mb-3"> <div class="row"> <div> <label class="form-label" for="metatitle">Room View</label> <select required name="hotel['+i+'][room_view_id]" id="room_view_id['+i+']" class="form-select" multiple multiselect-select-all="true" multiselect-search="true" > @foreach ($roomViewList as $index => $roomView) <option value={{ $roomView->id }}> {{ $roomView->view_type_name }}</option> @endforeach </select> </div> </div> </div> </div> </div> <div class="row"> <div class="col-sm-6"> <div class="mb-3"> <label class="form-label" for="metatitle">Food Offerings</label> <select required name="hotel['+i+'][food_type]" id="food_type['+i+']" class="form-select" multiple multiselect-select-all="true" multiselect-search="true" > @foreach ($foodTypeList as $index => $foodType) <option value={{ $foodType->id }}> {{ $foodType->food_type_name }}</option> @endforeach </select> </div> </div> <div class="col-sm-6"> <div class="mb-3"> <label class="form-label" for="metatitle">Room Type</label> <select required name="hotel['+i+'][room_type]" id="room_type['+i+']" class="form-select" multiple multiselect-select-all="true" multiselect-search="true" > @foreach ($roomTypeList as $index => $roomType) <option value={{ $roomType->id  }}> {{ $roomType->room_type_name }}</option> @endforeach </select> </div> </div> </div> </div>'
        );
        MultiselectDropdown();
    });
</script> --}}

    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/multiselect-dropdown.js') }}"></script>

     <!-- Plugins js -->
     <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
     <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>

     <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    
@endsection
