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
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Booking ID</th>
                                    <th>Booking Date</th>
                                    <th>Primary Traveller</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Total Passengers</th>
                                    <th>Departure Date</th>
                                    <th>Return Date</th>
                                    <th>Hotel Name</th>
                                    <th>Address</th>
                                    <th>Co-Passenger</th> {{-- Single header for Co-Passenger --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $index => $booking)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $booking->booking_id }}</td>
                                        <td>{{ $booking->booking_date }}</td>
                                        <td>{{ $booking->primary_traveller }}</td>
                                        <td>{{ $booking->primary_traveller_contact_number }}</td>
                                        <td>{{ $booking->primary_traveller_email }}</td>
                                        <td>{{ $booking->total_passengers }}</td>
                                        <td>{{ $booking->departure_date }}</td>
                                        <td>{{ $booking->return_date }}</td>
                                        <td>{{ $booking->hotel_name }}</td>
                                        <td>{{ $booking->address }}</td>
                                        <td> {{-- Co-Passenger listing --}}
                                            @if ($booking->traveller_details->isNotEmpty())
                                               
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>First Name</th>
                                                                <th>Last Name</th>
                                                                <th>Gender</th>
                                                                <th>Ticket Number</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($booking->traveller_details as $traveller)
                                                            <tr>
                                                                <td>{{ $traveller->first_name }}</td>
                                                                <td>{{ $traveller->last_name }}</td>
                                                                <td>{{ $traveller->gender }}</td>
                                                                <td>{{ $traveller->ticket_number }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                               
                                            @endif
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
