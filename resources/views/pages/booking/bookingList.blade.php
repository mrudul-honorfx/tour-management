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
                                    <th>Dates</th>
                                    <th>Staff</th>
                                    <th>Status</th>
                                    <th>Actions</th>
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
                                        {{$booking->tour_start_date}}<br>{{$booking->tour_end_date}}
                                    </td>
                                    
                                    <td>
                                        {{$booking->staff_name}}
                                    </td>
                                    <td>
                                        @if($booking->status == '1')
                                        <p class="label bg-primary text-white text-center p-1 rounded-md">ON HOLD</p>
                                        @elseif($booking->status == '2')
                                        <p class="label bg-grey text-white text-center p-1 rounded-md">ISSUED</p>
                                        @elseif($booking->status == '0')
                                        <p class="label bg-orange text-white text-center p-1 rounded-md">CANCELLED</p>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        {{-- anchor button to call the approveBooking ajax function --}}
                                        <button type="button" class="btn bborder border-primary order btn-sm waves-effect waves-light" onclick="approveBooking({{$booking->booking_id}})">
                                            <img src="{{ URL::asset('/assets/images/icons/tick.svg') }}" alt="" srcset="" style="width:15px;height:15px">
                                        <button type="button" class="btn bborder border-primary order btn-sm waves-effect waves-light">
                                            <img src="{{ URL::asset('/assets/images/icons/tick.svg') }}" alt="" srcset="" style="width:15px;height:15px">
                                        </button>
                                        <button type="button" class="btn bborder border-primary order btn-sm waves-effect waves-light">
                                            <img src="{{ URL::asset('/assets/images/icons/cross.svg') }}" alt="" srcset="" style="width:15px;height:15px">
                                        </button>
                                        <a href="{{ route('generateBookingVoucher', $booking->booking_id) }}"class="btn bborder border-primary order btn-sm waves-effect waves-light" data-toggle="modal" data-url="https://google.com" data-target="#myModal"><img src="{{ URL::asset('/assets/images/icons/download.svg') }}" alt="" srcset="" style="width:15px;height:15px"></a>
                                        
                                        <button type="button" class="btn bborder border-primary order btn-sm waves-effect waves-light">
                                            <img src="{{ URL::asset('/assets/images/icons/more-details.svg') }}" alt="" srcset="" style="width:15px;height:15px">
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                    <iframe src="http://domainy.com/" width="100%" height="380" frameborder="0" sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-top-navigation"
                                            allowtransparency="true"></iframe>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    
                    
                </div>
            </div>
        </div>
    </div>
    <script>

        
    </script>
    <!-- end row -->

@endsection
