@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Minible
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent
   
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$stats['totalBookings']}}</span></h4>
                        <p class="text-muted mb-0">Bookings</p>
                    </div>
                    <p class="text-muted mt-3 mb-0"><span class="text-success me-1">{{$stats['totalBookingsMonth']}}</span> this month
                    </p>
                </div>
            </div>
        </div> <!-- end col-->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="orders-chart" data-colors='["--bs-success"]'> </div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$stats['totalActivePackages']}}</span></h4>
                        <p class="text-muted mb-0">Active Packages</p>
                    </div>
                    <p class="text-muted mt-3 mb-0"><span class="text-danger me-1">{{$stats['totalPackages']}}</span> packages in total
                    </p>
                </div>
            </div>
        </div> <!-- end col-->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="customers-chart" data-colors='["--bs-primary"]'> </div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$stats['totalBookingsByMonth']}}</span></h4>
                        <p class="text-muted mb-0">Bookings in <?php echo \Carbon\Carbon::now()->format('M'); ?></p>
                    </div>
                    <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i
                                class="mdi mdi-arrow-down-bold me-1"></i>{{ $stats['totalBookingsByMonth'] != 0 ? (($stats['totalBookingsByMonth'] - $stats['totalBookingsLastMonth'])/$stats['totalBookingsByMonth'])*100 : '0'}} %</span> since last month
                    </p>
                </div>
            </div>
        </div> <!-- end col-->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="growth-chart" data-colors='["--bs-warning"]'></div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$stats['totalBookingsOnHold']}}</span></h4>
                        <p class="text-muted mb-0">Bookings on Hold</p>
                    </div>
                    <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i
                                class="mdi mdi-arrow-up-bold me-1"></i>{{$stats['totalRejectedBookings']}}</span> rejected
                    </p>
                </div>
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Upcomming Packages</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Package Name</th>
                                <th>Airline</th>
                                <th>Hotel</th>
                                <th>Departure-Destination</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tourPackages as $index => $package)
                                <tr>
                                    <td>
                                        <h5>{{ $package->package_name }}</h5>
                                    </td>
                                    <td>
                                        <p>{{ $package->airline_name }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $package->hotel_name }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $package->departure_destination }}</p>
                                    </td>
                                    <td class="text-start">
                                        <form action="{{ route('filtered-packages') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="departure_destination"
                                                value="{{ $package->departure_destination }}">
                                            <input type="hidden" name="airline_id" value="{{ $package->airline_id }}">
                                            <input type="hidden" name="hotel_id" value="{{ $package->hotel_id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Add
                                                Booking</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- end col-->
            </div> <!-- end row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Latest Bookings</h4>
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Package</th>
                                            <th>Primary Contact</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Total Passengers</th>
                                            <th>Staff</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($latestBooking) > 0)
                                            @foreach ($latestBooking as $booking)
                                                <tr>
                                                    <td><a href="javascript: void(0);"
                                                            class="text-body fw-bold">#{{ $booking->booking_id }}</a> </td>
                                                    <td>
                                                        <p>{{ $booking->departure_destination }} -
                                                            {{ $booking->arrival_destination }}</p>
                                                        <small><span>{{ $booking->airline_name }} -
                                                                {{ $booking->hotel_name }}</span></small>
                                                    </td>
                                                    <td>{{ $booking->primary_traveller }}</td>
                                                    <td>
                                                        {{ $booking->tour_start_date }}
                                                    </td>
                                                    <td>
                                                        {{ $booking->tour_end_date }}
                                                    </td>
                                                    <td>
                                                        {{ $booking->total_passengers }}
                                                    </td>
                                                    <td>
                                                        {{ $booking->staff_name }}
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <a type="button"
                                                            href="{{ route('getBookingDetails', ['id' => $booking->booking_id]) }}"
                                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                            View Details
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8"  rowspan="3" class="text-center">No Bookings Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <!-- end row -->
        @endsection
        @section('script')
            <!-- apexcharts -->
            <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
            <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
        @endsection
