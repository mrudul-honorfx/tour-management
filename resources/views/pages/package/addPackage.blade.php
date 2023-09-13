@extends('layouts.master')
@section('title')
Hotel List
@endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Package @endslot
@slot('title') Add Package @endslot
@endcomponent


<div class="row">
    <div class="col-lg-12">
        <div id="addproduct-accordion" class="custom-accordion">
            <form class="needs-validation " novalidate action="{{ route('addHotel.store') }}" method="POST" enctype="multipart/form-data">
            

            <div class="card">
                <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
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

                <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                    <div class="p-4 border-top">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                            <label class="form-label" for="productname">From</label>
                                <input id="departure_destination" name="departure_destination" type="text" class="form-control" placeholder="Dubai">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="productname">To</label>
                                        <input id="arrival_destination" name="arrival_destination" type="text" class="form-control" placeholder="Jeddha">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label class="form-label" for="manufacturername">Start Date</label>
                                        <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="tour_start_date"  name="tour_start_date">
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label class="form-label" for="manufacturername">End Date</label>
                                        <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="tour_end_date"  name="tour_end_date">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="manufacturername">Total Slots</label>
                                        <input class="form-control" type="number" value="20"  id="total_slots"  name="total_slots">
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="card">
                <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
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
                <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                    
                    <div class="p-4 border-top">     
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                         <label class="form-label" for="productname">Airline</label>
                                         <select name="airline[0]['airline_id']" id="airline_id" class="form-select">
                                            <option>Select</option>
                                            @foreach($airlineProviders as $index => $airline)
                                                <option value={{$airline->id}}>{{$airline->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                         <label class="form-label" for="productname">Flight Number</label>
                                         <input id="flight_number" name="airline[0]['flight_number']" type="text" class="form-control" placeholder="E1098">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                         <label class="form-label" for="productname">Depature Airport</label>
                                         <select name="airline[0]['departure_destination']" id="departure_destination" class="form-select">
                                            <option>Select</option>
                                            @foreach($airportLocations as $index => $airports)
                                                <option value={{$airports->id}}> {{$airports->airport_name}} ({{$airports->iata_code}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="productname">Arrival Airport</label>
                                        <select name="airline[0]['arrival_destination']" id="arrival_destination" class="form-select">
                                           <option>Select</option>
                                           @foreach($airportLocations as $index => $airports)
                                               <option value={{$airports->id}}> {{$airports->airport_name}} ({{$airports->iata_code}})</option>
                                           @endforeach
                                       </select>
                                   </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="departure-time"  class="form-label">Est. Departure Time</label>
                                        
                                        <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="departure_date_time" name="airline[0]['departure_date_time']">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="departure-time"  class="form-label">Est. Arrival Time</label>
                                        
                                        <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="arrival_date_time" name="airline[0]['arrival_date_time']">
                                        
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="p-4 border-top">     
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="mb-3">
                                     <label class="form-label" for="productname">Airline</label>
                                     <select name="airline[1]['airline_id']" id="airline_id" class="form-select">
                                        <option>Select</option>
                                        @foreach($airlineProviders as $index => $airline)
                                            <option value={{$airline->id}}>{{$airline->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                     <label class="form-label" for="productname">Flight Number</label>
                                     <input id="flight_number" name="airline[1]['flight_number']" type="text" class="form-control" placeholder="E1098">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="mb-3">
                                     <label class="form-label" for="productname">Depature Airport</label>
                                     <select name="airline[1]['departure_destination']" id="departure_destination" class="form-select">
                                        <option>Select</option>
                                        @foreach($airportLocations as $index => $airports)
                                            <option value={{$airports->id}}> {{$airports->airport_name}} ({{$airports->iata_code}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="productname">Arrival Airport</label>
                                    <select name="airline[1]['arrival_destination']" id="arrival_destination" class="form-select">
                                       <option>Select</option>
                                       @foreach($airportLocations as $index => $airports)
                                           <option value={{$airports->id}}> {{$airports->airport_name}} ({{$airports->iata_code}})</option>
                                       @endforeach
                                   </select>
                               </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="departure-time"  class="form-label">Est. Departure Time</label>
                                    
                                    <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="departure_date_time" name="airline[1]['departure_date_time']">
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="departure-time"  class="form-label">Est. Arrival Time</label>
                                    
                                    <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="arrival_date_time" name="airline[1]['arrival_date_time']">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>

            

            <div class="card">
                <a href="#addproduct-metadata-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-metadata-collapse">
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
                    <div class="p-4 border-top">
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="metatitle">Hotel</label>
                                        <select name="hotel[0]['hotel_id']" id="hotel_id" class="form-select">
                                            <option>Select</option>
                                            @foreach($hotelList as $index => $hotel)
                                                <option value={{$hotel->id}}>{{$hotel->hotel_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
    
                                        <div class="row">
                                            @foreach($roomViewList as $index => $roomView)
                                            <div>
                                                <label class="form-label" for="metatitle">Room View</label>
                                                <select name="hotel[0]['room_view_id']" id="room_view_id" class="form-select">
                                                    <option>Select</option>
                                                    @foreach($roomViewList as $index => $roomView)
                                                        <option value={{$roomView->id}}>{{$roomView->view_type_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="metatitle">Food Offerings</label>
                                        <div class="row">
                                            @foreach($foodTypeList as $index => $foodType)
                                            <div>
                                                <input type="checkbox" class="form-check-input" value="{{ $foodType->id}}" id="formrow-customCheck" name="hotel[0]['food_type']">
                                                <label class="form-check-label" for="formrow-customCheck">{{$foodType->food_type_name}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="metatitle">Room Type</label>
                                        <div class="row">
                                            @foreach($roomTypeList as $index => $roomType)
                                            <div>
                                                <input type="checkbox" class="form-check-input" value="{{ $roomType->id}}" id="formrow-customCheck" name="hotel[0]['room_type']">
                                                <label class="form-check-label" for="formrow-customCheck">{{$roomType->room_type_name}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col ms-auto">
                    <div class="d-flex flex-reverse flex-wrap gap-2">
                        <button class="btn btn-success" type="submit"> <i class="uil uil-file-alt"></i>Add Hotel</button>
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
<script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
