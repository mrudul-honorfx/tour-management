@extends('layouts.master')
@section('title')
    Hotel List
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.11.0/css/flag-icons.min.css" />
    <style>
        .border-grey{
            border: 1px solid #45424278 !important;
        }
        .sectionTitle{
            color: #FF2D46;
            font-weight: 600;
        }
    </style>
@endsection



@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Package
        @endslot
        @slot('title')
            Add Package
        @endslot
    @endcomponent

    <div class="row">
       
    <div class="card">
        <div class="card-body fs-10">
            <div class="float-end">
                <div class="flex">
                    <a href="{{ route('generateBookingVoucher', $bookingDetails->booking_id)}}"class="btn bborder border-primary order btn-sm waves-effect waves-light" ><img src="{{ URL::asset('/assets/images/icons/download.svg') }}" alt="" srcset="" style="width:15px;height:15px"> Generate Voucher</a>
                    @if($bookingDetails->status == 0)
                    <span class="badge px-3 py-2 bg-warning">Pending</span>
                    @elseif($bookingDetails->status == 1)
                    <span class="badge px-3 py-2 bg-success">Approved</span>
                    @elseif($bookingDetails->status == 2)
                    <span class="badge px-3 py-2 bg-danger">Rejected</span>
                    @endif
                    {{-- // download pdf --}}
                   
                    {{-- // download pdf --}}
                </div>
               

            </div>
            <div class="card-title">
                <h5>Package Detail</h5>
            </div>
            
            <div class="table-responsive mt-3">
                <table class="table table-bordered border-grey mb-0">
                    <tbody>
                        <tr>
                            <th colspan="5" class="sectionTitle">Package Details</th>
                        </tr>
                        <tr>
                            <th>Package Name</th>
                            <th>Departure & Arrival</th>
                            <th>Dates</th>
                            <th>Airline & Hotel</th>
                            
                        </tr>
                        <tr>
                            <th scope="row"> {{$packageInfo->package_name}}</th>
                            <td>{{$packageInfo->departure_destination}} - {{$packageInfo->arrival_destination}}</td>
                            <td>{{formatDate($bookingBasicDetails->tour_start_date)}} - {{formatDate($bookingBasicDetails->tour_end_date)}}</td>
                            <td>Airline: {{$bookingBasicDetails->airline_name}}<br>
                                Hotel: {{$bookingBasicDetails->hotel_name}}
                            </td>
                            
                        </tr>
                        <tr>
                            <th colspan="5" class="sectionTitle">Traveller Details</th>
                        </tr>
                        <tr>
                            <th>Lead Guest</th>
                            <th>Email </th>
                            <th>Phone</th>
                            <th>Number of Travellers</th>
                        </tr>
                        <tr>
                            <th scope="row">{{$bookingBasicDetails->primary_traveller}}</th>
                            <td>{{$bookingBasicDetails->primary_traveller_email}}</td>
                            <td>{{$bookingBasicDetails->primary_traveller_contact_number}}</td>
                            <td>{{$bookingBasicDetails->total_passengers}}</td>
                        </tr>
                        <tr>
                            <th colspan="5" class="sectionTitle">Airline Informations</th>
                        </tr>
                        @foreach(sortSegment($packageAirline) as $segments)
                        <tr>
                            <th colspan="5">
                                <img src="{{ URL::asset('/assets/images/airlines/'. $segments['code'] .'.png') }}" alt="" srcset="" class="rounded" width="30" height="30">
                                {{$segments['airline_name']}} Airlines
                            </th>
                        </tr>
                            @foreach($segments['items'] as $ticketItem)
                            <tr>
                                <td colspan="5">
                                    {{$ticketItem['flight_number']}} ( {{getAirportInfo($ticketItem['departure_destination_code'])}} - {{getAirportInfo($ticketItem['arrival_destination_code'])}} )
                                </td>
                            <tr>
                            <tr>
                                <th>Departure</th>
                                <th>Departure Time</th>
                                <th>Arrival</th>
                                <th>Arrival Time</th>
                            <tr>
                            <tr>
                                <td>{{$ticketItem['departure_destination_code']}} <br> <small>{{$ticketItem['departure_destination_name']}}</small></td>
                                <td>{!! fligtTimeFormator($ticketItem['departure_date_time']) !!}</td>
                                <td>{{$ticketItem['arrival_destination_code']}} <br> <small>{{$ticketItem['arrival_destination_name']}}</small></td>
                                <td>{!! fligtTimeFormator($ticketItem['arrival_date_time']) !!}</td>
                            <tr>
                            @endforeach
                            <tr>
                                <th>Class</th>
                                <th>Cabbin Luggage</th>
                                <th>Check In Luggage</th>
                                
                            <tr>
                            <tr>
                                <th>Class</th>
                                <th>{{$segments['luggage_capacity']}} KG</th>
                                <th>{{$segments['check_in_luggage']}} KG</th>
                            <tr>
                        @endforeach
                        <tr>
                            <th colspan="5" class="sectionTitle">Hotel Informations</th>
                        </tr>
                        @foreach($hotelInfo as $hotel)
                        <tr>
                            <th>Hotel Name</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Days/Nights</th>
                        </tr>
                        <tr>
                            <th scope="row">{{$hotel['hotel_name']}}</th>
                            <td>{{getDayDate($hotel['check_in_date'])}}</td>
                            <td>{{getDayDate($hotel['check_out_date'])}}</td>
                            <td>{{ formatStayDuration($hotel['check_in_date'], $hotel['check_out_date']) }}</td>
                        </tr>
                        <tr>
                            <th>Room Type</th>
                            <th>Meal Type</th>
                            <th>View</th>
                            <th>Total Rooms</th>
                        </tr>
                        <tr>
                            @foreach($hotel['rooms'] as $room)
                            <th>{{$room->room_type_name}}</th>
                            @endforeach
                            @foreach($hotel['food'] as $food)
                            <td>{{$food->food_type_name}}</td>
                            @endforeach
                            @foreach($hotel['view'] as $view)
                            <td>{{$view->view_type_name}}</td>
                            @endforeach
                            <td>{{$bookingDetails->number_of_rooms}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" class="sectionTitle">Transportation Details</th>
                        </tr>
                        <tr>
                            <th>Pickup Location</th>
                            <th>Dropoff Location</th>
                            <th>Vehicle Type</th>
                            <th>Assistant Name</th>
                        </tr>
                        @foreach($bTransferData as $bTransferDataItem)
                        <tr>
                            <th scope="row">{{$bTransferDataItem->pickup_location}}</th>
                            <td>{{$bTransferDataItem->drop_off_location}}</td>
                            <td>{{$bTransferDataItem->vehicle_type}}</td>
                            <td>{{$bTransferDataItem->assistant_name}} <br>{{$bTransferDataItem->assistant_contact_number}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" class="sectionTitle">Passenger Information</th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>Age Category</th>
                            <th>Ticket Number</th>
                        </tr>
                        @foreach($additionalPassengers as $additionalPassenger)
                        <tr>
                            <th scope="row">{{$additionalPassenger->last_name}}/{{$additionalPassenger->first_name}}{{$additionalPassenger->salutation}}</th>
                            <td>{{$additionalPassenger->agecat}}</td>
                            <td>{{$additionalPassenger->ticket_number}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
            <div class="section">

            </div>
        </div>
    </div>
    </div>
    
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/multiselect-dropdown.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/toastr.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            toastr["success"]("Are you the six fingered man?");
        });
    </script>

    {{-- <script>
        $(document).ready(function () {
            var hotelRepeaterItem = 1;
            $('button[data-repeater-create]').click(function () {
                hotelRepeaterItem++;
                var hotelRepeater = $('#hotel-repeater-item-1').clone().attr('id', 'hotel-repeater-item-' + hotelRepeaterItem);
                hotelRepeater.find('input, textarea').val('');
                hotelRepeater.find('input[name="b_details[hotel_id]"]').val('{{ $hotelInfo[0]['id'] }}');
                $(this).closest('.border').find('[data-repeater-list="group-b"]').append(hotelRepeater);
            });
        });
    </script> --}}
@endsection
