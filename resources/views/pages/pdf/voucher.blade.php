<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#FF2D46',
            grey: '#434245'
          },
          fontSize: {
            'sm': '0.5rem',
            'base': '0.8rem',
            'md': '0.75rem',
            'lg': '0.9rem',
            'xl': '1.4rem',
            '2xl': '1.563rem',
            '3xl': '1.953rem',
            '4xl': '2.441rem',
            '5xl': '3.052rem',
          }
        }
      }
    }
  </script>
  <style>
    *{
      margin: 0;
      padding:0;
    }
    body {
      width: 100%;
      max-width: 800px;
      height:auto;
    }
    div, img, table {
      break-inside: avoid;
    }
    .block{
      break-before: auto;
      break-after: auto;
    }
    @media print {
    * {
        print-color-adjust: exact; 
    }
  }
  </style>
</head>
<div class="fixed bottom-5 left-5 ">
  <button id="download-button" data-invoice={{$bookingMaster->id}} type="button" class="text-primary hover:text-white border border-primary hover:bg-grey focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-lg px-5 py-2.5 text-center mr-2 mb-2"><i class="fa fa-download px-3"></i>Download as PDF</button>
</div>
<body class="justify-center text-xs mx-auto max-h-screen overflow-y-scrll h-screen py-10 px-5" style="height: 500px;">
  <div id="voucher">
    <header class="body-font">
      <div class="container mx-auto flex justify-between">
        <a class="flex title-font font-medium items-center text-gray-900 ">
          <img src="{{ URL::asset('/assets/images/voucher/logo.png') }}" alt="" srcset="">
        </a>
  
        <div class="flex items-center">
          <div class="pr-4">
            <img src="{{ URL::asset('/assets/images/voucher/seal.png') }}" alt="" srcset="">
          </div>
          <!-- two flex sections -->
          <div class="pr-4">
            <!-- two div for status and issued date -->
            <div class="mb-2">
              <!-- status -->
              <p class="mb-1">Status</p>
              @if($bookingMaster->booking_status == '1')
              <p class="label bg-primary text-white text-center p-1 rounded-md">ON HOLD</p>
              @elseif($bookingMaster->booking_status == '2')
              <p class="label bg-grey text-white text-center p-1 rounded-md">ISSUED</p>
              @elseif($bookingMaster->booking_status == '0')
              <p class="label bg-orange text-white text-center p-1 rounded-md">CANCELLED</p>
              @endif
            </div>
            <div class="mb-2">
              <!-- issued date -->
              <p class="mb-1">Issued:</p>
              <p class="label">{{ formatDate($bookingMaster->booking_date) }}</p>
            </div>
          </div>
          <div class="pl-4 border-l-2 py-3">
            <!-- div for booking voucher title and booking voucher number -->
            <h3 class="text-lg font-semibold">Booking Voucher</h3>
            <h4>#{{ $bookingMaster->id }}</h4>
            
          </div>
        </div>
      </div>
    </header>
  
    <!-- Trip overview section -->
  
    <section class="p-3">
      <!-- main div for trip overview -->
      <div class="flex flex-wrap items-center">
        <!-- div for the trip overview content 3 by 4 width -->
        <div class="w-9/12 ">
          <!-- div for the trip name and title -->
            <div class="border border-grey pb-3 mr-1 border-opacity-20">
              <div>
                  <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                    <h3 class="text-lg font-normal uppercase">Trip Overview</h3>
                    <div class="flex">
                      @if($packageInfo->package_name)<p>{{ $packageInfo->package_name }}<span class="px-1">|<span></p>@endif
                      @if($packageInfo->departure_destination)<p>{{ $packageInfo->departure_destination }}<span class="px-1">-<span></p>@endif
                      @if($packageInfo->arrival_destination)<p>{{ $packageInfo->arrival_destination }}</p>@endif
                   
                    </div>
                  </div>
              </div>
    
              <div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                  <div class="flex items-center">
                    <img src="{{ URL::asset('/assets/images/voucher/usericon.png') }}" alt="" srcset="" class="p-2 h-auto" style="max-width:30px; width:100%;">
                    <p class="text-md font-normal">Lead Guest <br> <span class="text-lg font-bold text-primary">{{$bookingMaster->primary_traveller}}</span></p>
                  </div>
                  <div class="flex items-center">
                    <img src="{{ URL::asset('/assets/images/voucher/user.png') }}" alt="" srcset="" class="p-2 h-auto" style="max-width:30px; width:100%;">
                    <p class="text-md font-normal">Number of Guest<br> <span class="text-lg font-bold text-primary">{{$bookingMaster->total_passengers}}</span>
                    </p>
                  </div>
                  <div class="flex items-center">
                    <img src="{{ URL::asset('/assets/images/voucher/contact.png') }}" alt="" srcset="" class="p-2 h-auto" style="max-width:30px; width:100%;">
                    <p class="text-md font-normal">Contact Number <br> <span class="text-lg font-bold text-grey">{{$bookingMaster->primary_traveller_contact_number}}</span></p>
                  </div>
                  <div class="flex items-center">
                    <img src="{{ URL::asset('/assets/images/voucher/mail.png') }}" alt="" srcset="" class="p-2 h-auto" style="max-width:30px; width:100%;">
                    <p class="text-md font-normal">Email ID <br> <span
                        class="text-lg font-bold text-grey">{{$bookingMaster->primary_traveller_email}}</span></p>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- div for the trip overview content 8 by 12 width -->
        <!-- div for the trip overview content 4 by 12 width -->
        <div class="w-3/12 ">
          <div>
            <div class="flex flex-col justify-between  bg-primary text-white px-4 py-2">
              <div class="flex-none justify-between items-center">
                <p class="text-xl font-bold">{{getDayOnly($bookingMaster->departure_date)}}</p>
                <p class="text-md font-medium">{{getMonthYear($bookingMaster->departure_date)}}</p>
              </div>
              <div class="v-divider py-6 my-1 border-l ml-1 border-white flex-1 grow"></div>
              <div class="flex-none">
                <p class="text-xl font-bold">{{getDayOnly($bookingMaster->return_date)}}</p>
                <p class="text-md font-medium">{{getMonthYear($bookingMaster->return_date)}}</p>
              </div>
            </div>
          </div>
          <!-- div for the trip overview content 4 by 12 width -->
  
  
  
          <!-- div for the trip dates 1/4 width -->
        </div>
        <!-- main div for trip overview -->
    </section>
    <!-- Trip overview section -->
  
    @if(!empty($hotelInfo))
    <!-- Trip hotels section -->
    <section class="p-2">
      <div class="">
        <!-- hotel title section -->
        <div class="border border-grey pb-3 mr-1 border-opacity-20">
          <div>
            <div class="w-full ">
              <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                <h3 class="text-lg font-normal uppercase">Hotel Information</h3>
              </div>
            </div>

            @foreach($hotelInfo as $hotel)
            <div class="flex flex-wrap h-full container w-full py-2 block">
              <!-- Hotel Name and Details -->
              <div class="w-2/6">
                <div class="m-2 p-3 border border-gray border-opacity-20 h-28">
                  <p class="text-lg font-bold">{{$hotel['hotel_name']}}</p>
                  <div class="rating py-2">
                    <div class="flex items-center">
                      @for ($i = 0; $i < $hotel['rating']; $i++)
                        <svg class="text-gray-900 h-3 w-3 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                        </svg>
                      @endfor
                      @for ($i = $hotel['rating']; $i < 5; $i++)
                        <svg class="text-gray-200 h-3 w-3 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                        </svg>
                      @endfor
                    </div>
                  </div>
                  <p class="text-medium font-md">{{$hotel['hotel_address']}}</p>
                </div>
              </div>
              <!-- Hotel Name and Details -->
  
              <!-- Checkin dates and details -->
              <div class="w-4/6">
                <div class="m-2 border border-gray border-opacity-20 h-28">
                    <div class="border-gray border-opacity-20 container m-2 p-3 flex flex-wrap">
                      <div class="w-1/2 text-left">
                        <p class="font-medium text-l text-grey">Check-in</p>
                        <p class="font-bold text-xl text-primary py-1">{{getDayDate($hotel['check_in_date'])}}<span class="text-md pl-1 font-regular text-grey">{{getYearOnly($hotel['check_in_date'])}}</span></p>
                        <p class="text-md font-normal">After 02:00 PM</p>
                      </div>
                      <div class="w-1/2 text-right py-1">
                        <p class="font-medium text-l text-grey">Check-out</p>
                        <p class="font-bold text-xl text-primary py-1">{{getDayDate($hotel['check_in_date'])}}<span class="text-md pl-1 font-regular text-grey">{{getYearOnly($hotel['check_in_date'])}}</span></p>
                        <p class="text-md font-normal">After 02:00 PM</p>
                      </div>
                      <div class="w-full text-center border-t border-gray border-opacity-20 py-1">
                        <p class="text-l font-semibold text-primary">{{ formatStayDuration($hotel['check_in_date'], $hotel['check_out_date']) }}</p>
                      </div>
                    </div>
                </div>
              </div>  
              <!-- Checkin dates and details -->
              <!-- Hotel booking details -->
              <div class="w-full">
                <div class="mx-3 my-2">
                  <div class="grid grid-cols-4 gap-3">
                    <div class="flex flex-col text-left">
                      <p class="text-md font-bold">Room Type</p>
                      <ul class="list-none">
                        @foreach($hotel['rooms'] as $room)
                          <li class="font-medium text-md">{{$room->room_type_name}}</li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="flex flex-col text-left">
                      <p class="text-md font-bold">Meal Type</p>
                      <ul class="list-none">
                        @foreach($hotel['food'] as $food)
                        <li class="font-medium text-md">{{$food->food_type_name}}</li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="flex flex-col text-left">
                      <p class="text-md font-bold">View</p>
                      <ul class="list-none">
                        @foreach($hotel['view'] as $view)
                        <li class="font-medium text-md">{{$view->view_type_name}}</li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="flex flex-col text-left">
                      <p class="text-md font-bold">Total Rooms</p>
                      <p class="font-medium text-md">{{$bookingDetails->number_of_rooms}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>  
  
        </div>  
      </div>
    </section>
    <!-- Trip hotels section -->
    @endif
    <!-- Trip hotels section -->
    @if(!empty($packageAirline))
    <section class="p-2">
      <div class="">
        <!-- hotel title section -->
        <div class="border border-grey  mr-1 border-opacity-20">
          <div>
            <div class="w-full ">
              <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                <h3 class="text-lg font-normal uppercase">AIRLINE INFORMATION</h3>
              </div>
            </div>  
          </div>  
          <!-- sort by segment -->
          
          @foreach(sortSegment($packageAirline) as $segments)
          
          
          <div class="w-full">
            <div class="flex items-start mx-3 my-2">
              <div class="flex-none mx-2 ">
                <img src="{{ URL::asset('/assets/images/airlines/'. $segments['code'] .'.png') }}" alt="" srcset="" class="rounded" width="30" height="30">
              </div>
              <div class="flex flex-col basis-full">
                @foreach($segments['items'] as $ticketItem)
                  <div class="grow basis-full">
                    <div class="grid grid-rows-1 gap-2">
                      <div class="block">
                        <div class="flex py-2">
                          <div class="airline">
                            <p class="font-bold text-lg">
                              {{$ticketItem['flight_number']}} ( {{getAirportInfo($ticketItem['departure_destination_code'])}} - {{getAirportInfo($ticketItem['arrival_destination_code'])}} )
                            </p>
                          </div>
                        </div>
                        <div class="">
                          <div class="grid grid-cols-4 py-2">
                            <div class="flex flex-col text-left">
                              <p class="text-md font-bold uppercase">departure</p>
                              <p class="text-lg font-bold text-primary">{{$ticketItem['departure_destination_code']}}</p>
                              <p class="text-md font-medium text-grey max-w-[80%]">{{$ticketItem['departure_destination_name']}}</p>
                            </div>
                            <div class="flex flex-col text-left">
                              <p class="text-md font-bold uppercase">Departure Time</p>
                              {!! fligtTimeFormator($ticketItem['departure_date_time']) !!}
                            </div>
                            <div class="flex flex-col text-left">
                              <p class="text-md font-bold uppercase">arrival</p>
                              <p class="text-lg font-bold text-primary">{{$ticketItem['arrival_destination_code']}}</p>
                              <p class="text-md font-medium text-grey max-w-[80%]">{{$ticketItem['arrival_destination_name']}}</p>
                            </div>
                            <div class="flex flex-col text-left">
                              <p class="text-md font-bold uppercase">Arrival Time</p>
                              {!! fligtTimeFormator($ticketItem['arrival_date_time']) !!}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <div class="">
                    <div class="grid grid-cols-4 py-2" >
                      <div class="flex flex-col text-left">
                        <p class="text-md font-bold uppercase">CLASS</p>
                        <p class="text-lg font-bold text-primary ">ECONOMY</p>
                      </div>
                      <div class="flex flex-col text-left">
                        <p class="text-md font-bold uppercase">Cabbin Luggage</p>
                        <p class="text-lg font-bold text-primary">{{$segments['luggage_capacity']}} KG</p>
                      </div>
                      <div class="flex flex-col text-left">
                        <p class="text-md font-bold uppercase">Check-in Luggage</p>
                        <p class="text-lg font-bold text-primary">{{$segments['check_in_luggage']}} KG</p>
                      </div>
                    
                    </div>
                  </div>
              </div>
              
            </div>
            
          </div>
          @endforeach
        </div>  
      </div>
    </section>
    @endif
    <!-- Trip hotels section -->
  
    <!-- Trip Travel section -->

    @if(count($bTransferData) > 0)
    <section class="p-2">
      <div class="">
        <!-- hotel title section -->
        <div class="border border-grey pb-3 mr-1 border-opacity-20">
          <div>
            <div class="w-full ">
              <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                <h3 class="text-lg font-normal uppercase">Transportation Details</h3>
              </div>
            </div>
            <div class="flex flex-wrap h-full container">
              <!-- Hotel Name and Details -->
              <!-- Checkin dates and details -->
              <!-- Hotel booking details -->
              <div class="w-full">
                @foreach($bTransferData as $transfer)
                <div class="mx-3 my-2">
                  <div class="grid grid-cols-4 gap-3">
                    <div class="flex flex-col text-left">
                      <p class="text-md font-md pb-1.5 uppercase">Vehicle Type</p>
                      <p class="text-lg font-bold text-grey max-w-[80%]" >{{$transfer['vehicle_type']}}</p>
                    </div>
                    <div class="flex flex-col text-left">
                      <p class="text-md font-md pb-1.5 uppercase">Pickup Point</p>
                      <p class="text-lg font-bold text-grey max-w-[80%]">{{$transfer['pickup_location']}}</p>
                    </div>
                    <div class="flex flex-col text-left">
                      <p class="text-md font-md pb-1.5 uppercase">Drop off pint</p>
                      <p class="text-lg font-bold text-grey">{{$transfer['drop_off_location']}}</p>
                    </div>
                    @if(!empty($transfer['assistant_name']))
                    <div class="flex flex-col text-left">
                      <p class="text-md font-md pb-1.5 uppercase">Assistant Info</p>
                      <p class="text-lg font-bold text-grey max-w-[80%]">{{$transfer['assistant_name']}}</p>
                      <p class="text-md font-bold text-grey max-w-[80%]">{{$transfer['assistant_contact_number']}}</p>    
                    </div>
                    @endif
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>  
  
        </div>  
      </div>
    </section>
    @endif
    <!-- Trip hotels section -->
  
    <!-- Passenger Information -->
    <section class="p-2">
      <div class="">
        <!-- title section -->
        <div class="border border-grey pb-3 border-opacity-20">
          <div>
            <div class="w-full ">
              <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                <h3 class="text-lg font-normal uppercase">Passenger Information</h3>
              </div>
            </div>
            <div class="flex flex-wrap h-full container m-2">
              <div class="w-full ">
                <div class="px-3">
                  <div class="overflow-x-auto">
                      <table class="table-auto w-full">
                          <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                              <tr>
                                  <th class="p-2 whitespace-nowrap">
                                      <div class="font-semibold text-left">Full Name</div>
                                  </th>
                                  <th class="p-2 whitespace-nowrap">
                                      <div class="font-semibold text-left">Age Category</div>
                                  </th>
                                  <th class="p-2 whitespace-nowrap">
                                      <div class="font-semibold text-left">Ticket Number</div>
                                  </th>
                              </tr>
                          </thead>
                          <tbody class="text-md divide-y divide-gray-100">
                              @foreach($additionalPassengers as $passengers)

                              <tr>
                                  <td class="p-2 whitespace-nowrap">
                                      <div class="flex items-center">
                                          <div class="font-lg text-gray-800">{{$passengers['last_name']}}/{{$passengers['first_name']}}</div>
                                      </div>
                                  </td>
                                  <td class="p-2 whitespace-nowrap">
                                      <div class="text-left uppercase text-md">{{$passengers['agecat']}}</div>
                                  </td>
                                  <td class="p-2 whitespace-nowrap">
                                      @if(!empty($passengers['ticket_number']))
                                      <div class="text-left font-medium text-green-500">{{$passengers['ticket_number']}}</div>
                                      @else
                                      <div class="w-fit	">
                                        <p class="label bg-primary text-white text-center px-2 py-1 rounded-md">PENDING</p>
                                      </div>
                                      
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
  
        </div>  
      </div>
    </section>
    <!-- Passenger Information -->
  
    <!-- Bank Information -->
    <section class="p-2">
      <div class="">
        <!-- title section -->
        <div class="border border-grey pb-3 mr-1 border-opacity-20">
          <div>
            <div class="w-full ">
              <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                <h3 class="text-lg font-normal uppercase">Bank Information</h3>
              </div>
            </div>
            <div class="flex flex-wrap h-full container m-2">
              <div class="w-full px-2">
                 <div class="grid grid-cols-2 gap-5">
                    <div class="flex flex-wrap flex-row text-left p-3 border border-gray-200">
                        {{-- <div class="flex flex-grow flex-row items-center uppercase  gap-3">
                          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Emirates_logo.svg/1200px-Emirates_logo.svg.png" alt="" srcset="" class="rounded" width="30" height="30">
                          <p class="text-lg font-medium text-grey">Abu Dhabi Islamic bank</p>
                        </div>
                         --}}
                        <div class="basis-full pt-2 leading-normal	">
                          <p class="text-md font-medium text-grey"> Name: ALKHALIDIYA HOLIDAYS AND TOURISM </p>
                          <p class="text-md font-medium text-grey"> Branch: AL NAJDA </p>
                          <p class="text-md font-medium text-grey"> Account no: 19042914</p>
                          <p class="text-md font-medium text-grey"> IBAN: AE810500000000019042914</p> 
                        </div>
                      
                    </div>
                    <div class="flex flex-wrap flex-row text-left p-3 border border-gray-200">
                      {{-- <div class="flex flex-grow flex-row items-center uppercase  gap-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Emirates_logo.svg/1200px-Emirates_logo.svg.png" alt="" srcset="" class="rounded" width="30" height="30">
                        <p class="text-lg font-medium text-grey">Abu Dhabi Islamic bank</p>
                      </div> --}}
                      <div class="basis-full pt-2 leading-normal	">
                        <p class="text-md font-medium text-grey"> Name: ALKHALIDIYA HOLIDAYS AND TOURISM </p>
                        <p class="text-md font-medium text-grey"> Branch: AL NAJDA </p>
                        <p class="text-md font-medium text-grey"> Account no: 19042914</p>
                        <p class="text-md font-medium text-grey"> IBAN: AE810500000000019042914</p> 
                      </div>
                    
                  </div>
                 </div>
              </div>
            </div>
          </div>  
  
        </div>  
      </div>
    </section>
    <section class="p-2">
      <div class="">
        <!-- title section -->
        <div class="border border-grey pb-3 mr-1 border-opacity-20">
          <div>
            <div class="w-full ">
              <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                <h3 class="text-lg font-normal uppercase">Terms and Conditions</h3>
              </div>
            </div>
            <div class="flex flex-wrap h-full container m-2">
              <div class="w-full px-3">
                <ul class="list-disc	list-outside text-sm text-justify">
                  <li>Upon receiving this program, the client will acknowledge and agree to the terms and conditions contained therein.</li>
                  <li>Be present at the airport at least 3 hours before the flight time and adhere to the weight conditions specified by the airlines. Any amendment, delay or cancellation of the flight schedule is the responsibility of the flight airline.</li>
                  <li>In the event of modification or cancellation of the travel ticket, an amount is calculated for the value of the modification or cancellation that is determined by the airline, and in some cases the ticket is not subject to modification or return according to the sys Airlines.</li>
                  <li>Some low-cost airlines (Wizaire - Arabia - Flydubai. Etc.) The ticket cannot be canceled and the amount paid will be refunded. It is possible to make an amendment 24 hours before the flight time with a fee. Additional and according to the type of ticket subject to the conditions of the airline.</li>
                  <li>It is not possible to cancel reservations in the aforementioned hotel or amend the dates of entry and exit, according to the conditions.</li>
                  <li>Any modification in the room type before or after travel is according to the available availability and is subject to the approval of the hotel or the company through which the reservation was made and will incur additional fee.</li>
                  <li>The check-in time for the hotel, in check, is 4:00 pm, and the check-out time for the hotel is 12:00 noon, according to the approved system in hotels.</li>
                  <li>The double room, according to the hotel system, consists of a king-size bed or two separate single beds, and the triple room consists of two beds and the third bed is an extra bed (bed sofa).</li>
                  <li>The possibility of adjoining the rooms next to each other or between them a door due to the hotel management and according to the availability in the hotel. A copy of the client's passport. Determine the room at any floor when the customer receives the room in the hotel, and it cannot be determined before the customer reaches the requirements of filling out the hotel and Kaaba forms, etc. It may be a partial or full view or a side view, and it varies according to the location of each room, suite, in the hotel, Al Haram, Al Masjid Al Nabawi, AI Masjid Al Aqsa, etc. The type of city view differs. The size of the rooms or suites varies acc.</li>
                  <li>Precautionary conditions and procedures are applied at all stages of the trip, starting from the airport - the plane - the hotel - transportation - or the destination of the trip, and the customer is directly responsible for implementing them.</li>
                  <li>Clearly reviewing travel procedures during the Covid 19 period before confirming reservations by the customer and any amendment or A change in travel procedures or entry into a country that the company Al-Khalidiyah Holidays and Tourism has no responsibility for it, and assistance can be provided according to the available capabilities.</li>
                  <li>The customer is responsible for the travel requirements for the intended destination (PC swab, Covid-19 vaccine or other travel requirements) in case the swab result is positive and it is not possible.</li>
                  <li>The customer's travel is subject to the cancellation of the program, including flights, hotels, transportation, etc., to the terms and conditions and the possibility of cancellation.</li>
                </ul>
              </div>
            </div>
          </div>  
        </div> 
        <img src="{{ URL::asset('/assets/images/voucher/sign.png') }}" alt="" srcset="" class="h-2/5 max-w-xs object-contain float-right	bg-blend-multiply	pr-6"> 
      </div>
    </section>
    
    <!-- Passenger Information -->

  </div>
  

</body>
<script>
  const button = document.getElementById('download-button');
  // get the invoice number from the :data-invoice attribute
 
  function generatePDF() {
    var invoiceId = this.getAttribute('data-invoice');
    console.log(this);
    // Choose the element that your content will be rendered to.
    const element = document.getElementById('voucher');
    var opt = {
      margin:       0.5,
      filename:     'voucher_'+invoiceId+'.pdf',
      image:        { type: 'jpeg', quality: 1 },
      html2canvas: {dpi: 75, scale: 2, letterRendering: true},
      jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    // Choose the element and save the PDF for your user.
    html2pdf().set(opt).from(element).save();


  }

  button.addEventListener('click', generatePDF);
</script>

</html>