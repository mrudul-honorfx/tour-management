@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Package
        @endslot
        @slot('title')
            Package Listing
        @endslot
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
    
    <h4>Packages</h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="">
                <div class="card-header">
                    <h4 class="card-title">Package Filter</h4>
                </div>
                <div class="card-body">
                    <form id="filter-form" action="{{ route('fliterListing') }}" method="post">
                        @csrf
                        <div class="d-flex align-items-end">
                            <div class="flex-grow-1">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div>
                                            <label class="form-label">Range</label>
                                            <input type="text" name="date_range" class="form-control"
                                                id="datepicker-range" value="">
                                            @if (isset($dateRange))
                                                <p>selected range : {{ $dateRange }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="productname">Departure Airport</label>
                                            <select name="departure_airport" id="departure_destination"
                                                class="form-select">
                                                <option>Select</option>
                                                @foreach ($airportLocations as $index => $airports)
                                                    <option value="{{ $airports->id }}"
                                                        {{ isset($departureAirport) && $departureAirport == $airports->id ? 'selected' : '' }}>
                                                        {{ $airports->airport_name }} ({{ $airports->iata_code }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="productname">Arrival Airport</label>
                                            <select name="arrival" id="departure_destination" class="form-select">
                                                <option>Select</option>
                                                @foreach ($airportLocations as $index => $airport)
                                                    <option value={{ $airport->id }}
                                                        {{ isset($arrivalAirport) && $arrivalAirport == $airport->id ? 'selected' : '' }}>
                                                        {{ $airport->airport_name }}
                                                        ({{ $airport->iata_code }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="productname">Airline</label>
                                            <select name="airline" id="airline_id" class="form-select">
                                                <option>Select</option>
                                                @foreach ($airlineProviders as $index => $airline)
                                                    <option value={{ $airline->id }}
                                                        {{ isset($flight) && $flight == $airline->id ? 'selected' : '' }}>
                                                        {{ $airline->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ms-3">
                                <button type="submit" class="btn btn-primary">Search </button>
                            </div>
                        </div>
                    </form>
                    <form id="clear-filter-form" action="{{ route('package.plisting') }}" method="get">
                        @csrf
                        <div class="ms-3">
                            <button type="submit" class="btn btn-warning"> <i class="mdi mdi-filter-variant"></i> Clear
                                Filters</button>
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

        @foreach ($tourPackages as $index => $package)
            @php
                // Parse the tour_start_date and tour_end_date as Carbon objects
                $startDate = \Carbon\Carbon::parse($package->tour_start_date);
                $endDate = \Carbon\Carbon::parse($package->tour_end_date);
                
                // Format the dates as "day Month" (e.g., "17 Aug")
                $formattedStartDate = $startDate->format('d M');
                $formattedEndDate = $endDate->format('d M');
            @endphp
            <div class="col-md-6 col-xl-4">
                <div class="card package-cards-container" data-package-id="">
                    <div class="card-body">
                        <div class="float-end">
                            <h5 class="muted bold">#{{ $package->package_id }}</h5>
                        </div>
                        <h4 class="card-title mb-4 text-truncate">{{ $package->package_name }}</h4>
                        <div>
                            <h4 class="mb-1 mt-1">{{ $formattedStartDate }} - {{ $formattedEndDate }}</h4>
                            <div class="row">
                                <div class="col-md-12 col-xl-6 py-2">
                                    <p class="text-muted mb-0"><i class="mdi mdi-airplane-takeoff"
                                            style="padding-right:10px;"></i>{{ $package->departure_destination }}</p>
                                </div>
                                <div class="col-md-12 col-xl-6 py-2">
                                    <p class="text-muted mb-0"><i class="mdi mdi-airplane-landing"
                                            style="padding-right:10px;"></i>{{ $package->arrival_destination }}</p>
                                </div>
                                <div class="col-md-12 col-xl-6 py-2">
                                    <p class="text-muted mb-0"><i class="mdi mdi-airplane"
                                            style="padding-right:10px;"></i>{{ $package->airline_name }}</p>
                                </div>
                                {{-- // do a null check and then display --}}
                                @if ($package->hotel_name != null)
                                    <div class="col-md-12 col-xl-6 py-2">
                                        <p class="text-muted mb-0"><i class="mdi mdi-office-building"
                                                style="padding-right:10px;"></i>{{ $package->hotel_name }}</p>
                                    </div>
                                @endif
                                <div class="col-md-12 col-xl-6 py-2">
                                    <p class="text-muted mb-0"><i class="mdi mdi-timer-sand"
                                            style="padding-right:10px;"></i>{{ $package->total_slots - $package->total_booking }}
                                        SLOTS LEFT</p>
                                </div>
                            </div>
                        </div>

                        <div class="float-start mt-3">
                            <a type="button" href="{{ route('addbooking', $package->package_id) }}"
                                class="btn btn-outline-primary waves-effect waves-light">Add Booking</a>
                        </div>
                        <div class="float-end mt-3">
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">View
                                Bookings</button>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- end row -->


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
@endsection
