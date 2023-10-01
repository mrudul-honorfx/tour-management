<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <title>Flight Booking Invoice</title>
    @yield('css')

    <link href="{{ URL::asset('assets/voucher/assets/css/style.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />

</head>

<body>
    <div class="tm_container">
        <div class="tm_invoice_wrap">
            <div class="tm_invoice tm_style1" id="tm_download_section">
                <div class="tm_invoice_in">
                    <section style="page-break-inside: avoid;"> 
                        <div class="tm_invoice_head tm_mb20 tm_align_center">
                            <div class="tm_invoice_left">
                                <div class="tm_logo"><img src="{{ URL::asset('assets/voucher/assets/img/logo.svg') }}"
                                        alt=""></div>
                            </div>
                            <div class="tm_invoice_right tm_text_right">
                                <div class="tm_primary_color tm_f30 tm_medium">Booking Voucher</div>
                            </div>
                        </div>
                        <div class="tm_invoice_info tm_mb30">
                            <div class="tm_invoice_seperator tm_gray_bg"></div>
                            <div class="tm_invoice_info_list">
                                <p class="tm_invoice_number tm_m0">Booking No: <b
                                        class="tm_primary_color">#{{ $bookingMaster->id }}</b></p>
                                <p class="tm_invoice_date tm_m0">Booking Date: <b
                                        class="tm_primary_color">{{ $bookingMaster->booking_date }}</b>
                                </p>
                            </div>
                        </div>
                        <div class="tm_grid_row tm_col_2 tm_invoice_info_in tm_round_border tm_mb30">
                            <div class="tm_border_right tm_border_none_sm">
                                <b class="tm_primary_color">First Party</b>
                                <p class="tm_m0">Al Khalidiyah Holidays and Tourism<br>Khalidiyah St, Abu Dhabi,
                                    UAE<br>Phone: +971 26 660 0131</p>
                            </div>
                            <div>
                                <b class="tm_primary_color">Second Party</b>
                                <p class="tm_m0">Al Khalidiyah Holidays and Tourism<br>Khalidiyah St, Abu Dhabi,
                                    UAE<br>Phone: +971 26 660 0131</p>
                            </div>
                        </div>
                    </section>
                    <section style="page-break-inside: avoid;"> 
                        <h2 class="tm_f16 tm_section_heading tm_border_color tm_mb15"><span class="tm_gray_bg">Trip
                                Overview</span></h2>
                        <div
                            class="tm_grid_row tm_col_4 tm_col_2_md tm_invoice_info_in tm_gray_bg tm_mb30 tm_round_border">
                            <div>
                                <span>Tour Start Date</span> <br>
                                <span class="tm_primary_color">{{ $packageInfo->tour_start_date }}</span>
                            </div>
                            <div>
                                <span>Tour End Date</span> <br>
                                <span class="tm_primary_color">{{ $packageInfo->tour_end_date }}</span>
                            </div>
                            <div>
                                <span>Start</span> <br>
                                <span class="tm_primary_color">{{ $packageInfo->departure_destination }}</span>
                            </div>
                            <div>
                                <span>Destination</span> <br>
                                <span class="tm_primary_color">{{ $packageInfo->arrival_destination }}</span>
                            </div>

                            <div>
                                <span>Primary Traveller</span> <br>
                                <span class="tm_primary_color">{{ $bookingMaster->primary_traveller }}</span>
                            </div>
                            <div>
                                <span>Contact Number</span> <br>
                                <span
                                    class="tm_primary_color">{{ $bookingMaster->primary_traveller_contact_number }}</span>
                            </div>
                            <div>
                                <span>Email</span> <br>
                                <span class="tm_primary_color">{{ $bookingMaster->primary_traveller_email }}</span>
                            </div>
                            <div>
                                <span>Total Travellers</span> <br>
                                <span class="tm_primary_color">{{ $bookingMaster->total_passengers }}</span>
                            </div>
                        </div>
                    </section>
                    <section style="page-break-inside: avoid;"> 
                        <div class="tm_table tm_style1 tm_mb30">
                            <h2 class="tm_f16 tm_section_heading tm_border_color tm_mb15"><span
                                    class="tm_gray_bg">Airline Information</span></h2>
                            @foreach ($packageAirline as $airline)
                                @component('pages.voucher.ticket-component', ['airline' => $airline])
                                @endcomponent
                            @endforeach
                        </div>
                    </section>
                    <section style="page-break-inside: avoid;"> 
                        <h2 class="tm_f16 tm_section_heading tm_border_color tm_mb15"><span class="tm_gray_bg">Hotel
                                Info</span></h2>
                        <div class="tm_invoice_info tm_mb25">
                            <div class="tm_invoice_info_left">
                                <p class="tm_mb17">
                                    <b class="tm_f18 tm_primary_color">Invoma Hotel</b> <br>
                                    84 Spilman Street, London <br>United Kingdom. <br>
                                    lowell@gmail.com <br>
                                    +44(0) 327 123 987
                                </p>
                            </div>
                            <div class="tm_invoice_info_right">
                                <div
                                    class="tm_grid_row tm_col_3 tm_col_2_sm tm_invoice_info_in tm_gray_bg tm_round_border">
                                    <div>
                                        <span>Check In:</span> <br>
                                        <b class="tm_primary_color">05 March 2022</b>
                                    </div>
                                    <div>
                                        <span>Check Out:</span> <br>
                                        <b class="tm_primary_color">10 March 2022</b>
                                    </div>
                                    <div>
                                        <span>Booking ID:</span> <br>
                                        <b class="tm_primary_color">124315</b>
                                    </div>
                                    <div>
                                        <span>Room:</span> <br>
                                        <b class="tm_primary_color">Classic City View</b>
                                    </div>
                                    <div>
                                        <span>Food:</span> <br>
                                        <b class="tm_primary_color">All Inclusive</b>
                                    </div>
                                    <div>
                                        <span>View:</span> <br>
                                        <b class="tm_primary_color">Single</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section style="page-break-inside: avoid;"> 
                        <h2 class="tm_f16 tm_section_heading tm_border_color tm_mb15"><span class="tm_gray_bg">Transportation
                                Information</span></h2>

                        <div class="tm_table tm_style1 tm_mb30">
                            <div class="tm_round_border">
                                <div class="tm_table_responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="tm_gray_bg tm_primary_color">Vehicle Type</th>
                                                
                                                <th class="tm_gray_bg tm_primary_color tm_border_left">Pickup Point
                                                </th>
                                                <th class="tm_gray_bg tm_primary_color tm_border_left">Drop Point
                                                </th>
                                                <th class="tm_gray_bg tm_primary_color tm_border_left">Pickup Time
                                                </th>
                                                <th class="tm_gray_bg tm_primary_color tm_border_left">Drop Time
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b class="tm_primary_color">Sedan</td>
                                                <td class="tm_border_left"><b class="tm_primary_color">Airport Terminal A</td>
                                                <td class="tm_border_left"><b class="tm_primary_color">Hotel ABC</td>
                                                <td class="tm_border_left"><b class="tm_primary_color">21 September<br>04:00 PM</td>
                                                <td class="tm_border_left"><b class="tm_primary_color">21 September<br>05:00 PM</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </section>

                    <section style="page-break-inside: avoid;"> 
                        <h2 class="tm_f16 tm_section_heading tm_border_color tm_mb15"><span class="tm_gray_bg">Passenger
                                Information</span></h2>

                        <div class="tm_table tm_style1 tm_mb30">
                            <div class="tm_round_border">
                                <div class="tm_table_responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="tm_gray_bg tm_primary_color">Name</th>
                                                <th class="tm_gray_bg tm_primary_color tm_border_left">Gender
                                                </th>
                                                <th class="tm_gray_bg tm_primary_color tm_border_left">Ticket Number
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Mrudul</td>
                                                <td class="tm_border_left">Male</td>
                                                <td class="tm_border_left">TR31221AE</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </section>

                    
                    <section style="page-break-inside: avoid;"> 
                        <h5 class="tm_f16 tm_section_heading tm_border_color tm_mb15"><span class="tm_gray_bg">Terms & Conditions</span></h5>
                        <div class="tm_table tm_style1 tm_mb30">
                            <p> - Upon receiving this program, the client will acknowledge and agree to the terms and conditions contained therein.</p>
                            <p> - Be present at the airport at least 3 hours before the flight time and adhere to the weight conditions specified by the airlines. Any amendment, delay or cancellation of the flight schedule is the responsibility of the flight airline.</p>
                            <p> - In the event of modification or cancellation of the travel ticket, an amount is calculated for the value of the modification or cancellation that is determined by the airline, and in some cases the ticket is not subject to modification or return according to the sys Airlines.</p>
                            <p> - Some low-cost airlines (Wizaire - Arabia - Flydubai. Etc.) The ticket cannot be canceled and the amount paid will be refunded. It is possible to make an amendment 24 hours before the flight time with a fee. Additional and according to the type of ticket subject to the conditions of the airline.</p>
                            <p> - It is not possible to cancel reservations in the aforementioned hotel or amend the dates of entry and exit, according to the conditions.</p>
                            <p> - Any modification in the room type before or after travel is according to the available availability and is subject to the approval of the hotel or the company through which the reservation was made and will incur additional fee.</p>
                            <p> - The check-in time for the hotel, in check, is 4:00 pm, and the check-out time for the hotel is 12:00 noon, according to the approved system in hotels.</p>
                            <p> - The double room, according to the hotel system, consists of a king-size bed or two separate single beds, and the triple room consists of two beds and the third bed is an extra bed (bed sofa).</p>
                            <p> - The possibility of adjoining the rooms next to each other or between them a door due to the hotel management and according to the availability in the hotel. A copy of the client's passport. Determine the room at any floor when the customer receives the room in the hotel, and it cannot be determined before the customer reaches the requirements of filling out the hotel and Kaaba forms, etc. It may be a partial or full view or a side view, and it varies according to the location of each room, suite, in the hotel, Al Haram, Al Masjid Al Nabawi, Al Masjid Al Aqsa, etc. The type of city view differs. The size of the rooms or suites varies acc.</p>
                            <p> - Precautionary conditions and procedures are applied at all stages of the trip, starting from the airport – the plane – the hotel – transportation – or the destination of the trip, and the customer is directly responsible for implementing them.</p>
                            <p> - Clearly reviewing travel procedures during the Covid 19 period before confirming reservations by the customer and any amendment or A change in travel procedures or entry into a country that the company Al-Khalidiyah Holidays and Tourism has no responsibility for it, and assistance can be provided according to the available capabilities.</p>
                            <p> - The customer is responsible for the travel requirements for the intended destination (PCR swab, Covid-19 vaccine or other travel requirements) in case the swab result is positive and it is not possible.</p>
                            <p> - The signature of the second party.</p>
                            <p> - The customer's travel is subject to the cancellation of the program, including flights, hotels, transportation, etc., to the terms and conditions and the possibility of cancellation.</p>
                        </div>
                        <p class="tm_m0 tm_text_center tm_primary_color">
                            
                            Thank you for purchasing the ticket, have a
                            safe
                            journey 🙂</p>
                    </section>
                </div>
            </div>
            <div class="tm_invoice_btns tm_hide_print">
                <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                                fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <rect x="128" y="240" width="256" height="208" rx="24.32"
                                ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round"
                                stroke-width="32" />
                            <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                                stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <circle cx="392" cy="184" r="24" fill='currentColor' />
                        </svg>
                    </span>
                    <span class="tm_btn_text">Print</span>
                </a>
                <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                        </svg>
                    </span>
                    <span class="tm_btn_text">Download</span>
                </button>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('assets/voucher/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/voucher/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ URL::asset('assets/voucher/assets/js/html2canvas.min.js') }}"></script>
    <script src="{{ URL::asset('assets/voucher/assets/js/main.js') }}"></script>
    <script src="{{ URL::asset('assets/voucher/assets/js/jquery.min.js') }}"></script>
</body>

</html>
