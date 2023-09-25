@extends('layouts.master')
@section('title')
    Package List
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Package
        @endslot
        @slot('title')
            List
        @endslot
    @endcomponent

    <div class="row">
        {{-- @component('common-components.upcommingPackage')
        
    @endcomponent --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Packages</h4>
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tour Start Date</th>
                                        <th>Tour End Date</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Airline</th>
                                        <th>Hotel</th>
                                        <th>Slots</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tourPackages as $index => $package)
                                    @php
                                        // Parse the tour_start_date and tour_end_date as Carbon objects
                                        $startDate = \Carbon\Carbon::parse($package->tour_start_date);
                                        $endDate = \Carbon\Carbon::parse($package->tour_end_date);
                            
                                        // Format the dates as "day Month" (e.g., "17 Aug")
                                        $formattedStartDate = $startDate->format('d M Y');
                                        $formattedEndDate = $endDate->format('d M Y');
                                    @endphp
                                    <tr>
                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#{{$package->package_id}}</a> </td>
                                        <td>{{$formattedStartDate}}</td>
                                        <td>
                                            {{$formattedEndDate}}
                                        </td>
                                        <td>
                                            {{$package->departure_destination}}
                                        </td>
                                        <td>
                                            {{$package->arrival_destination}}
                                            {{-- <span class="badge rounded-pill bg-soft-success font-size-12">Paid</span> --}}
                                        </td>
                                        <td>
                                            {{$package->airline_name}} Airlines
                                        </td>
                                        <td>
                                            {{-- display hotel name if not null else display NIL --}}
                                            @if ($package->hotel_name == null)
                                                NIL
                                            @else
                                            {{$package->hotel_name}}
                                            @endif
                                        </td>
                                        <td>
                                            {{$package->total_slots - $package->total_booking}}
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <a type="button"
                                                href="{{ route('addbooking', $package->package_id) }}"
                                                class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <!-- apexcharts -->
        <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    @endsection
