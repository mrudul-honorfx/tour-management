@extends('layouts.master')
@section('title')
    @lang('translation.Starter_Page')
@endsection
@section('css')
<!-- plugin css -->
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Report @endslot
        @slot('title') Hotel Report @endslot
    @endcomponent
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data"   method="POST" action="{{ route('generateHotelReport') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Select Hotel</label>
                                <select class="select2 form-control select2-multiple" name="hotel_id"  data-placeholder="Choose ...">
                                    @foreach($hotelList as $hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->hotel_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                    <input type="text" class="form-control" name="start_date" placeholder="Start Date" />
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                    <input type="text" class="form-control" name="end_date" placeholder="End Date" />
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mb-3">
                                <input type="submit" class="btn btn-primary" value="Get Report" />
                        </div>
                    </div>
                </form>
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
                            {{-- @foreach($bookings as $booking) --}}
                            <tr>
                                {{-- <td><a href="javascript: void(0);" class="text-body fw-bold">#{{$booking->booking_id}}</a> </td>
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
                                    <p class="label bg-grey text-white text-center p-1 rounded-md">CONFIRMED</p>
                                    @elseif($booking->status == '0')
                                    <p class="label bg-orange text-white text-center p-1 rounded-md">CANCELLED</p>
                                    @endif
                                </td> --}}
                               {{--  <td class="button-group">
                                        <a href="{{ route('approveBooking', $booking->booking_id) }}"class="btn bborder border-primary order btn-sm waves-effect waves-light"><img src="{{ URL::asset('/assets/images/icons/tick.svg') }}" alt="" srcset="" style="width:15px;height:15px"></a>
                                        <a href="{{ route('rejectBooking', $booking->booking_id) }}"class="btn bborder border-primary order btn-sm waves-effect waves-light"><img src="{{ URL::asset('/assets/images/icons/cross.svg') }}" alt="" srcset="" style="width:15px;height:15px"></a>
                                        <a target="_blank" href="{{ route('generateBookingVoucher', $booking->booking_id)}}"class="btn bborder border-primary order btn-sm waves-effect waves-light" ><img src="{{ URL::asset('/assets/images/icons/download.svg') }}" alt="" srcset="" style="width:15px;height:15px"></a>
                                        
                                        <div class="dropdown">
                                            <button class="btn border-primary btn-sm dropdown-toggle waves-effect waves-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ URL::asset('/assets/images/icons//more-details.svg') }}" alt="" srcset="" style="width:15px;height:15px"> <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('getBookingDetails', $booking->booking_id) }}">View Details</a>
                                                <a class="dropdown-item" target="_blank" href="{{ route('generateBookingVoucher', ['id' => $booking->booking_id, 'ar' => "ar" ])}}">Download In Arabic</a>

                                                <a class="dropdown-item" href="" onclick="openTicketModal(event,{{$booking->booking_id}})">Add Ticket Information</a>
                                            </div>
                                        </div>
                                </td> --}}
                            </tr>
                           {{--  @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
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