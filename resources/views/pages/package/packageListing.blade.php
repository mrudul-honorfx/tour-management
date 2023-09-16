@extends('layouts.master')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Package @endslot
@slot('title') Package Listing  @endslot
@endcomponent
@section('css')
<!-- plugin css -->
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/flatpickr/flatpickr.min.css') }}">
@endsection
<div class="row">
    {{-- @component('common-components.upcommingPackage')
        
    @endcomponent --}}
    <h4>Packages</h4>
    <div class="row">
        <div class="col-lg-12 package-cards-container">
            <div class="card " id="">
                <div class="card-header">
                    <h4 class="card-title">Package Filter</h4>
                </div>
                <div class="card-body">
    
                    <form id="filter-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div>
                                    <label class="form-label">Range</label>
                                    <input type="text" name=date_range class="form-control" id="datepicker-range">
                                </div>
                            </div>
                            <div class="col-lg-4">

                            <div class="mb-3">
                                <label class="form-label" for="productname">Depature Airport</label>
                                <select name="departure_airport" id="departure_destination"
                                    class="form-select">
                                    <option>Select</option>
                                    @foreach ($airportLocations as $index => $airports)
                                        <option value={{ $airports->id }}> {{ $airports->airport_name }}
                                            ({{ $airports->iata_code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="productname">Arrival Airport</label>
                                    <select name="arrival" id="departure_destination"
                                        class="form-select">
                                        <option>Select</option>
                                        @foreach ($airportLocations as $index => $airports)
                                            <option value={{ $airports->id }}> {{ $airports->airport_name }}
                                                ({{ $airports->iata_code }})</option>
                                        @endforeach
                                    </select>
                                </div>
                             </div>
                             <div class="col-lg-4">
    
                                <div class="mb-3">
                                    <label class="form-label" for="productname">Airline</label>
                                    <select name="airline" id="airline_id" class="form-select">
                                        <option>Select</option>
                                        @foreach ($airlineProviders as $index => $airline)
                                            <option value={{ $airline->id }}>{{ $airline->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
<div class="row">
   
    @foreach($tourPackages as $index => $package)
        @php
            // Parse the tour_start_date and tour_end_date as Carbon objects
            $startDate = \Carbon\Carbon::parse($package->tour_start_date);
            $endDate = \Carbon\Carbon::parse($package->tour_end_date);

            // Format the dates as "day Month" (e.g., "17 Aug")
            $formattedStartDate = $startDate->format('d M');
            $formattedEndDate = $endDate->format('d M');
        @endphp
        <div class="col-md-6 col-xl-4">
            <div class="card" data-package-id="{{ $package->package_id }}">
                <div class="card-body">
                   
                    <div>
                        <h4 class="mb-1 mt-1">{{ $formattedStartDate }} - {{ $formattedEndDate }}</h4>
                        <div class="row">
                            <div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-airplane-takeoff" style="padding-right:10px;"></i>{{$package->departure_destination}}</p></div>
                            <div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-airplane-landing" style="padding-right:10px;"></i>{{$package->arrival_destination}}</p></div>
                            <div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-airplane" style="padding-right:10px;"></i>{{$package->airline_name}}</p></div>
                            {{-- // do a null check and then display --}}
                            @if($package->hotel_name != null)
                            <div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-office-building" style="padding-right:10px;"></i>{{$package->hotel_name}}</p></div>
                           @endif
                            <div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-timer-sand" style="padding-right:10px;"></i>{{$package->total_slots}} SLOTS LEFT</p></div>
                        </div>
                    </div>
                    
                    <div class="float-start mt-3">
                        <button type="button" class="btn btn-outline-primary waves-effect waves-light">Add Booking</button>
                    </div>

                </div>
            </div>
        </div> 
    @endforeach   
</div>
   
<!-- end row -->

<div class="row">
    <div class="col-lg-12">
     
    </div>
</div>
<!-- end row -->

@endsection
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('script')
<script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
<script>
    $(document).ready(function () {
        // Function to fetch filtered data via Ajax and replace existing data
        function fetchAndReplaceData() {
            var formData = $('#filter-form').serialize();

            $.ajax({
                url: '/package/plisting1',
                type: 'GET',
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function (data) {
                    
                    // Remove existing cards
                    $('#package-cards-container').empty();

                    // Iterate over the received data and create new cards
                    data.forEach(function (package) {
                        
                        // Create a new card element
                        var $card = $('<div class="col-md-6 col-xl-4">' +
                            '<div class="card" data-package-id="' + package.package_id + '">' +
                            '<div class="card-body">' +
                            '<div>' +
                            '<h4 class="mb-1 mt-1">' + package.formatted_dates + '</h4>' +
                            '<div class="row">' +
                            '<div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-airplane-takeoff" style="padding-right:10px;"></i>' + package.departure_destination + '</p></div>' +
                            '<div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-airplane-landing" style="padding-right:10px;"></i>' + package.arrival_destination + '</p></div>' +
                            '<div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-airplane" style="padding-right:10px;"></i>' + package.airline_name + '</p></div>'+

                       '<div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-office-building" style="padding-right:10px;"></i>' + package.hotel_name + '</p></div>'+
                        
                        '<div class="col-md-12 col-xl-6 py-2"><p class="text-muted mb-0"><i class="mdi mdi-timer-sand" style="padding-right:10px;"></i>' + package.total_slots + ' SLOTS LEFT</p></div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="float-start mt-3">' +
                            '<button type="button" class="btn btn-outline-primary waves-effect waves-light">Add Booking</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>');

                        // Append the new card to the container
                        $('#package-cards-container').append($card);
                    });
                },
                error: function () {
                    alert('Error fetching filtered data.');
                }
            });
        }

        // Check for changes in form elements
        $('#filter-form input, #filter-form select').on('change', function () {
            fetchAndReplaceData();
        });

        // Initial data load (only if form has been modified)
        //fetchAndReplaceData();
    });
</script>



@endsection



{{-- <script>
    $(document).ready(function () {
        var formModified = false; // Flag to track form modification

        // Function to fetch filtered data via Ajax
        function fetchFilteredData() {
            
            if (formModified) {
                var formData = $('#filter-form').serialize();

                $.ajax({
                    url: '/package/plisting1',
                    type: 'GET',
                    data: formData,
                   
                    dataType: 'json', // Expect JSON response
    success: function (data) {
        // Iterate over the received data
        data.forEach(function (package) {
            // Get the package ID from the received data
            var packageId = package.package_id;

            // Find the card with the matching data-package-id attribute
            var $card = $('[data-package-id="' + packageId + '"]');

            // Update the card content
            $card.find('.mb-1').text(package.formatted_dates);
            $card.find('.mdi-airplane-takeoff').next().text(package.departure_destination);
            $card.find('.mdi-airplane-landing').next().text(package.arrival_destination);
            $card.find('.mdi-airplane').next().text(package.airline_name);

            // Check for hotel_name and update if available
            var $hotelName = $card.find('.mdi-office-building').next();
            if (package.hotel_name != null) {
                $hotelName.text(package.hotel_name);
            } else {
                $hotelName.text(''); // Clear the content if hotel_name is null
            }

            $card.find('.mdi-timer-sand').next().text(package.total_slots + ' SLOTS LEFT');
        });
    },
                    error: function () {
                        alert('Error fetching filtered data.');
                    }
                });
            }
        }

        // Check for changes in form elements
        $('#filter-form input, #filter-form select').on('change', function () {
            formModified = true;
            fetchFilteredData();
        });

        // Initial data load (only if form has been modified)
        fetchFilteredData();
    });
</script> --}}









