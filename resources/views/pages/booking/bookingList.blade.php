@extends('layouts.master')
@section('title')
    Booking List
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Booking @endslot
        @slot('title') Booking List @endslot
    @endcomponent
    <style>
       .label{
       }
       .bg-grey{
            background-color: #434245;
       }
       .text-white{
            color:#fff
       }
       .text-center{
            text-align: center
       }
       .p-1{
            padding: 0.5rem;
       }
       .rounded-md{
            border-radius: 0.2rem;
       }
       .bg-orange
         {
                background-color: #f7b84b;
         }
        .button-group
        {
            display: flex;
            gap:0.2rem;
        }
    </style>
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
                                    <td class="button-group">
                                            <a href="{{ route('approveBooking', $booking->booking_id) }}"class="btn bborder border-primary order btn-sm waves-effect waves-light"><img src="{{ URL::asset('/assets/images/icons/tick.svg') }}" alt="" srcset="" style="width:15px;height:15px"></a>
                                            <a href="{{ route('rejectBooking', $booking->booking_id) }}"class="btn bborder border-primary order btn-sm waves-effect waves-light"><img src="{{ URL::asset('/assets/images/icons/cross.svg') }}" alt="" srcset="" style="width:15px;height:15px"></a>
                                            <a href="{{ route('generateBookingVoucher', $booking->booking_id)}}"class="btn bborder border-primary order btn-sm waves-effect waves-light" ><img src="{{ URL::asset('/assets/images/icons/download.svg') }}" alt="" srcset="" style="width:15px;height:15px"></a>
                                            
                                            <div class="dropdown">
                                                <button class="btn border-primary btn-sm dropdown-toggle waves-effect waves-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="{{ URL::asset('/assets/images/icons//more-details.svg') }}" alt="" srcset="" style="width:15px;height:15px"> <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('getBookingDetails', $booking->booking_id) }}">View Details</a>
                                                    <a class="dropdown-item" href="{{ route('generateBookingVoucher', $booking->booking_id) }}">Add Ticket Information</a>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="voucherModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Extra large modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
@endsection
@section('script-bottom')
<script>

</script>
@endsection

