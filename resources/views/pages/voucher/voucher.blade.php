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
                                        <b class="tm_primary_color">3</b>
                                    </div>
                                    <div>
                                        <span>Food:</span> <br>
                                        <b class="tm_primary_color">1</b>
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
                                                <td><b class="tm_primary_color">Passenger Name:</b> Jhon Doe</td>
                                                <td class="tm_border_left"><b class="tm_primary_color">Payment
                                                        Gatway:</b>
                                                    American Express</td>
                                                <td class="tm_border_left"><b class="tm_primary_color">Passenger
                                                        Name:</b> Jhon Doe</td>
                                                <td class="tm_border_left"><b class="tm_primary_color">Payment
                                                        Gatway:</b>
                                                    American Express</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </section>
                    <section style="page-break-inside: avoid;"> 
                        <p class="tm_m0 tm_text_center tm_primary_color">Thank you for purchasing the ticket, have a
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
