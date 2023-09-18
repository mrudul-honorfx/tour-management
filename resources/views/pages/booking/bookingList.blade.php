@extends('layouts.master')
@section('title')
    Booking List
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Booking @endslot
        @slot('title') Booking List @endslot
    @endcomponent

   

                   

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Booking list</h4>
                   

                    <div class="table-responsive">
                        <table class="table mb-0">
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
                                @foreach($bookings as $booking)
                                <tr>
                                   
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">#{{$booking->booking_id}}</a> </td>
                                    <td><p>{{$booking->departure_destination}} - {{$booking->arrival_destination}}</p>
                                        <small><span>{{$booking->airline_name}} - {{$booking->hotel_name}}</span></small></td>
                                    <td>{{$booking->primary_traveller}}</td>
                                    <td>
                                        {{$booking->tour_start_date}}
                                    </td>
                                    <td>
                                        {{$booking->tour_end_date}}
                                    </td>
                                    <td>
                                        {{$booking->total_passengers}}
                                    </td>
                                    <td>
                                        {{$booking->staff_name}}
                                   
                                    
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
