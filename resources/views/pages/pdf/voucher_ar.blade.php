<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF2D46',
                        grey: '#434245',
                        lightgrey: '#f5f9ff',
                        dropgrey: '#f5f9ff',
                    },
                    fontFamily: {
                        poppins: ['"Poppins"', 'sans-serif'],
                    },
                    fontSize: {
                        'sm': '0.7rem',
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
        * {
            margin: 0;
            padding: 0;
        }

        body {
            width: 100%;
            max-width: 800px;
            height: auto;
        }

        div,
        img,
        table {
            break-inside: avoid;
        }

        .block {
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
    <button id="download-button" data-invoice={{ $bookingMaster->id }} type="button"
        class="text-primary hover:text-white border border-primary hover:bg-grey focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-lg px-5 py-2.5 text-center mr-2 mb-2"><i
            class="fa fa-download px-3"></i>Download as PDF</button>
</div>

<body class="justify-center text-xs mx-auto max-h-screen overflow-y-scrll h-screen py-10 px-5 font-poppins"
    style="height: 500px;">
    <div id="voucher">
        <header class="body-font">
            <div class="container mx-auto flex justify-between align-center">
                <a class="flex title-font font-medium items-center ml-4 text-gray-900 ">
                    <img src="{{ URL::asset('/assets/images/voucher/logo.png') }}" alt="" srcset="">
                </a>
                <div class="flex items-center">
                    <div class="mb-3 mr-4">
                        <h3 class="text-3xl font-md">Booking Voucher</h3>
                    </div>
                </div>
            </div>
            <div class="row flex  justify-between mx-4 wrap my-3">
                <div class="col grow bg-lightgrey w-full my-0.5 mr-3 rounded">
                    <div class="divider h-2 w-full"></div>
                </div>
                <div class="col flex-none">
                    <div class="flex">
                        <p class="text-md">
                            <span class="text-lg font-normal">Booking ID: <strong>#{{ $bookingMaster->id }}</strong>
                                &nbsp;&nbsp;&nbsp;
                                Booking Date: <strong>{{ formatDate($bookingMaster->booking_date) }}</strong>
                                &nbsp;&nbsp;&nbsp;
                                @if ($bookingMaster->booking_status == '1')
                                    <span class="label bg-primary text-sm text-white text-center p-1 rounded-md">ON
                                        HOLD</span>
                                @elseif($bookingMaster->booking_status == '2')
                                    <span
                                        class="label bg-grey text-sm text-white text-center p-1 rounded-md">ISSUED</span>
                                @elseif($bookingMaster->booking_status == '0')
                                    <span
                                        class="label bg-orange text-sm text-white text-center p-1 rounded-md">CANCELLED</span>
                                @endif
                            </span>
                        </p>
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
                    <div class="border border-grey bg-dropgrey pb-3 mr-1 border-opacity-20">
                        <div>
                            <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                                <h3 class="text-lg font-normal uppercase" dir="rtl">تفاصيل الرحلة</h3>
                                <div class="flex">
                                    @if ($packageInfo->package_name_ar)
                                    <p>{{ $packageInfo->package_name_ar }}<span class="px-1">|<span></p>
                                    @elseif($packageInfo->package_name)
                                        <p>{{ $packageInfo->package_name }}<span class="px-1">|<span></p>
                                            @else
                                            <p><span class="px-1">|<span></p>
                                    @endif
                                    @if ($packageInfo->departure_destination)
                                        <p>{{ $packageInfo->departure_destination }}<span class="px-1">-<span></p>
                                    @endif
                                    @if ($packageInfo->arrival_destination)
                                        <p>{{ $packageInfo->arrival_destination }}</p>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="grid grid-cols-2 gap-3 mt-3">
                                <div class="flex items-center">
                                    <img src="{{ URL::asset('/assets/images/voucher/usericon.png') }}" alt=""
                                        srcset="" class="p-2 h-auto" style="max-width:30px; width:100%;">
                                    <p class="text-md font-normal" dir="rtl">اسم العميل الرئيسي<br> <span
                                            class="text-lg font-bold text-primary">{{ $bookingMaster->primary_traveller }}</span>
                                    </p>
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ URL::asset('/assets/images/voucher/user.png') }}" alt=""
                                        srcset="" class="p-2 h-auto" style="max-width:30px; width:100%;">
                                    <p class="text-md font-normal" dir="rtl">عدد العملاء<br> <span
                                            class="text-lg font-bold text-primary">{{ $bookingMaster->total_passengers }}</span>
                                    </p>
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ URL::asset('/assets/images/voucher/contact.png') }}" alt=""
                                        srcset="" class="p-2 h-auto" style="max-width:30px; width:100%;">
                                    <p class="text-md font-normal" dir="rtl">رقم هاتف للتواصل<br> <span
                                            class="text-lg font-md text-grey">{{ $bookingMaster->primary_traveller_contact_number }}</span>
                                    </p>
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ URL::asset('/assets/images/voucher/mail.png') }}" alt=""
                                        srcset="" class="p-2 h-auto" style="max-width:30px; width:100%;">
                                    <p class="text-md font-normal" dir="rtl">البريد الإلكتروني<br> <span
                                            class="text-lg font-md text-grey">{{ $bookingMaster->primary_traveller_email }}</span>
                                    </p>
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
                                <p class="text-xl font-bold">{{ getDayOnly($bookingMaster->departure_date) }}</p>
                                <p class="text-md font-medium">{{ getMonthYear($bookingMaster->departure_date) }}</p>
                            </div>
                            <div class="v-divider py-6 my-1 border-l ml-1 border-white flex-1 grow"></div>
                            <div class="flex-none">
                                <p class="text-xl font-bold">{{ getDayOnly($bookingMaster->return_date) }}</p>
                                <p class="text-md font-medium">{{ getMonthYear($bookingMaster->return_date) }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- div for the trip overview content 4 by 12 width -->



                    <!-- div for the trip dates 1/4 width -->
                </div>
                <!-- main div for trip overview -->
        </section>
        <!-- Trip overview section -->

        @if (!empty($hotelInfo))
            <!-- Trip hotels section -->
            <section class="p-2">
                <div class="">
                    <!-- hotel title section -->
                    <div class="border border-grey  bg-dropgrey pb-3 mr-1 border-opacity-20">
                        <div>
                            <div class="w-full ">
                                <div class="flex items-center justify-between bg-grey  text-white px-3 py-2">
                                    <h3 class="text-lg font-normal uppercase" dir="rtl">بيانات الفندق</h3>
                                </div>
                            </div>

                            @foreach ($hotelInfo as $hotel)
                                <div class="flex flex-wrap h-full container w-full py-2 block">
                                    <!-- Hotel Name and Details -->
                                    <div class="w-2/6">
                                        <div class="m-2 p-3 border border-gray border-opacity-20 h-28">
                                            <p class="text-lg font-bold">{{ $hotel['hotel_name'] }}</p>
                                            <div class="rating py-2">
                                                <div class="flex items-center">
                                                    @for ($i = 0; $i < $hotel['rating']; $i++)
                                                        <svg class="text-gray-900 h-3 w-3 flex-shrink-0"
                                                            viewBox="0 0 20 20" fill="currentColor"
                                                            aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    @endfor
                                                    @for ($i = $hotel['rating']; $i < 5; $i++)
                                                        <svg class="text-gray-200 h-3 w-3 flex-shrink-0"
                                                            viewBox="0 0 20 20" fill="currentColor"
                                                            aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="text-medium font-md">{{ $hotel['hotel_address'] }}</p>
                                        </div>
                                    </div>
                                    <!-- Hotel Name and Details -->

                                    <!-- Checkin dates and details -->
                                    <div class="w-4/6">
                                        <div class="m-2 border border-gray border-opacity-20 h-28">
                                            <div
                                                class="border-gray border-opacity-20 container m-2 p-3 flex flex-wrap">
                                                <div class="w-1/2 text-left">
                                                    <p class="font-medium text-l text-grey" dir="rtl">الدخول</p>
                                                    <p class="font-bold text-xl text-primary py-1">
                                                        {{ getDayDate($hotel['check_in_date']) }}<span
                                                            class="text-md pl-1 font-regular text-grey">{{ getYearOnly($hotel['check_in_date']) }}</span>
                                                    </p>
                                                    <p class="text-md font-normal">After 02:00 PM</p>
                                                </div>
                                                <div class="w-1/2 text-right py-1">
                                                    <p class="font-medium text-l text-grey" dir="rtl">المغادرة</p>
                                                    <p class="font-bold text-xl text-primary py-1">
                                                        {{ getDayDate($hotel['check_out_date']) }}<span
                                                            class="text-md pl-1 font-regular text-grey">{{ getYearOnly($hotel['check_in_date']) }}</span>
                                                    </p>
                                                    <p class="text-md font-normal">After 02:00 PM</p>
                                                </div>
                                                <div
                                                    class="w-full text-center border-t border-gray border-opacity-20 py-1">
                                                    <p class="text-l font-semibold text-primary">
                                                        {{ formatStayDuration($hotel['check_in_date'], $hotel['check_out_date']) }}
                                                    </p>
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
                                                    <p class="text-md font-bold" dir="rtl">نوع الغرفة</p>
                                                    <ul class="list-none">
                                                        @foreach ($hotel['rooms'] as $room)
                                                            <li class="font-medium text-md">
                                                                {{ $room->room_type_name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-bold" dir="rtl">نظام الوجبات</p>
                                                    <ul class="list-none">
                                                        @foreach ($hotel['food'] as $food)
                                                            <li class="font-medium text-md">
                                                                {{ $food->food_type_name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-bold" dir="rtl">الإطلالة</p>
                                                    <ul class="list-none">
                                                        @foreach ($hotel['view'] as $view)
                                                            <li class="font-medium text-md">
                                                                {{ $view->view_type_name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-bold" dir="rtl">إجمالي الغرف</p>
                                                    <p class="font-medium text-md">
                                                        {{ $bookingDetails->number_of_rooms }}</p>
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
        @if (!empty($packageAirline))
            <section class="p-2">
                <div class="">
                    <!-- hotel title section -->
                    <div class="border border-grey bg-dropgrey  mr-1 border-opacity-20">
                        <div>
                            <div class="w-full ">
                                <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                                    <h3 class="text-lg font-normal uppercase" dir="rtl">بيانات خط الطيران</h3>
                                </div>
                            </div>
                        </div>
                        <!-- sort by segment -->

                        @foreach (sortSegment($packageAirline) as $segments)
                            <div class="w-full">
                                <div class="flex items-start mx-3 my-2">
                                    <div class="flex-none mx-2 ">
                                        <img src="{{ URL::asset('/assets/images/airlines/' . $segments['code'] . '.png') }}"
                                            alt="" srcset="" class="rounded" width="30"
                                            height="30">
                                    </div>
                                    <div class="flex flex-col basis-full">
                                        @foreach ($segments['items'] as $ticketItem)
                                            <div class="grow basis-full">
                                                <div class="grid grid-rows-1 gap-2">
                                                    <div class="block">
                                                        <div class="flex py-2">
                                                            <div class="airline">
                                                                <p class="font-bold text-lg">
                                                                    {{ $ticketItem['flight_number'] }} (
                                                                    {{ getAirportInfo($ticketItem['departure_destination_code']) }}
                                                                    -
                                                                    {{ getAirportInfo($ticketItem['arrival_destination_code']) }})
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <div class="grid grid-cols-4 py-2">
                                                                <div class="flex flex-col text-left">
                                                                    <p class="text-md font-bold uppercase" dir="rtl">الاقلاع
                                                                    </p>
                                                                    <p class="text-lg font-bold text-primary">
                                                                        {{ $ticketItem['departure_destination_code'] }}
                                                                    </p>
                                                                    <p
                                                                        class="text-md font-medium text-grey max-w-[80%]">
                                                                        {{ $ticketItem['departure_destination_name'] }}
                                                                    </p>
                                                                </div>
                                                                <div class="flex flex-col text-left">
                                                                    <p class="text-md font-bold uppercase" dir="rtl">موعد الاقلاع</p>
                                                                    {!! fligtTimeFormator($ticketItem['departure_date_time']) !!}
                                                                </div>
                                                                <div class="flex flex-col text-left">
                                                                    <p class="text-md font-bold uppercase" dir="rtl">الوصول</p>
                                                                    <p class="text-lg font-bold text-primary">
                                                                        {{ $ticketItem['arrival_destination_code'] }}
                                                                    </p>
                                                                    <p
                                                                        class="text-md font-medium text-grey max-w-[80%]">
                                                                        {{ $ticketItem['arrival_destination_name'] }}
                                                                    </p>
                                                                </div>
                                                                <div class="flex flex-col text-left">
                                                                    <p class="text-md font-bold uppercase" dir="rtl">موعد الوصول
                                                                    </p>
                                                                    {!! fligtTimeFormator($ticketItem['arrival_date_time']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="">
                                            <div class="grid grid-cols-4 py-2">
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-bold uppercase" dir="rtl">رقم الحجز</p>
                                                    <p class="text-lg font-bold text-primary " >HDK5639</p>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-bold uppercase" dir="rtl">درجة الحجز</p>
                                                    <p class="text-lg font-bold text-primary " >ECONOMY</p>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-bold uppercase" dir="rtl">أمتعة المقصورة</p>
                                                    <p class="text-lg font-bold text-primary">
                                                        {{ $segments['luggage_capacity'] }} KG</p>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-bold uppercase" dir="rtl">الأمتعة المسجلة</p>
                                                    <p class="text-lg font-bold text-primary">
                                                        {{ $segments['check_in_luggage'] }} KG</p>
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

        @if (count($bTransferData) > 0)
            <section class="p-2">
                <div class="">
                    <!-- hotel title section -->
                    <div class="border border-grey bg-dropgrey pb-3 mr-1 border-opacity-20">
                        <div>
                            <div class="w-full ">
                                <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                                    <h3 class="text-lg font-normal uppercase" dir="rtl">تفاصيل النقل</h3>
                                </div>
                            </div>
                            <div class="flex flex-wrap h-full container">
                                <!-- Hotel Name and Details -->
                                <!-- Checkin dates and details -->
                                <!-- Hotel booking details -->
                                <div class="w-full">
                                    @foreach ($bTransferData as $transfer)
                                        <div class="mx-3 my-2">
                                            <div class="grid grid-cols-4 gap-3">
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-md pb-1.5 uppercase" dir="rtl">نوع المركبة</p>
                                                    <p class="text-lg font-bold text-grey max-w-[80%]">
                                                        {{ $transfer['vehicle_type'] }}</p>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-md pb-1.5 uppercase" dir="rtl">نقطة الالتقاء</p>
                                                    <p class="text-lg font-bold text-grey max-w-[80%]">
                                                        {{ $transfer['pickup_location'] }}</p>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-md pb-1.5 uppercase" dir="rtl">نقطة الإنزال</p>
                                                    <p class="text-lg font-bold text-grey">
                                                        {{ $transfer['drop_off_location'] }}</p>
                                                </div>
                                                <div class="flex flex-col text-left">
                                                    <p class="text-md font-md pb-1.5 uppercase" dir="rtl">موعد الالتقاء</p>
                                                    <p class="text-lg font-bold text-grey">
                                                        {{ $transfer['pickup_time'] }}</p>
                                                </div>
                                                @if (!empty($transfer['assistant_name']))
                                                    <div class="flex flex-col text-left">
                                                        <p class="text-md font-md pb-1.5 uppercase" >Assistant Info</p>
                                                        <p class="text-lg font-bold text-grey max-w-[80%]">
                                                            {{ $transfer['assistant_name'] }}</p>
                                                        <p class="text-md font-bold text-grey max-w-[80%]">
                                                            {{ $transfer['assistant_contact_number'] }}</p>
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
                <div class="border border-grey bg-dropgrey pb-3 border-opacity-20">
                    <div>
                        <div class="w-full ">
                            <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                                <h3 class="text-lg font-normal uppercase" dir="rtl">معلومات المسافر</h3>
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
                                                        <div class="font-semibold text-left" dir="rtl">الاسم بالكامل</div>
                                                    </th>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left" dir="rtl">الفئة العمرية</div>
                                                    </th>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left" dir="rtl">رقم التذكرة</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-md divide-y divide-gray-100">
                                                @foreach ($additionalPassengers as $passengers)
                                                    <tr>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <div class="font-lg text-gray-800">
                                                                    {{ $passengers['last_name'] }}/{{ $passengers['first_name'] }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="text-left uppercase text-md">
                                                                {{ $passengers['agecat'] }}</div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            @if (!empty($passengers['ticket_number']))
                                                                <div class="text-left font-medium text-green-500">
                                                                    {{ $passengers['ticket_number'] }}</div>
                                                            @else
                                                                <div class="w-fit	">
                                                                    <p
                                                                        class="label bg-primary text-white text-center px-2 py-1 rounded-md">
                                                                        PENDING</p>
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

        <!-- check if bank accounts is empty -->
        
        @if(!empty($bankDetails))
        <!-- Bank Information -->
        <section class="p-2">
            <div class="">
                <!-- title section -->
                <div class="border border-grey bg-dropgrey pb-3 mr-1 border-opacity-20">
                    <div>
                        <div class="w-full ">
                            <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                                <h3 class="text-lg font-normal uppercase" dir="rtl">معلومات البنك</h3>
                            </div>
                        </div>
                        <div class="flex flex-wrap h-full container m-2">
                            <div class="w-full px-2">
                                <div class="grid grid-cols-2 gap-5">
                                    @foreach($bankDetails as $bank)
                                    <div class="flex flex-wrap flex-row text-left p-3 border border-gray-200">
                                        <div class="basis-full pt-2 leading-normal	">
                                            <p class="text-md font-normal text-grey">Bank: <span class="font-medium">{{$bank->bank_name}}</span></p>
                                            <p class="text-md font-normal text-grey"> Name: <span class="font-medium">{{$bank->account_name}}</span></p>
                                            <p class="text-md font-normal text-grey"> Branch: <span class="font-medium">{{$bank->branch}}</span> </p>
                                            <p class="text-md font-normal text-grey"> Account no: <span class="font-medium">{{$bank->account_number}}</span></p>
                                            <p class="text-md font-normal text-grey"> IBAN: <span class="font-medium">{{$bank->iban_number}}</span></p>
                                        </div>

                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        @endif
        <section class="p-2 terms">
            <div class="">
                <!-- title section -->
                <div class="border border-grey bg-dropgrey pb-3 mr-1 border-opacity-20">
                    <div>
                        <div class="w-full ">
                            <div class="flex items-center justify-between bg-grey text-white px-3 py-2">
                                <h3 class="text-lg font-normal uppercase" dir="rtl">الشروط والأحكام</h3>
                            </div>
                        </div>
                        <div class="flex flex-wrap h-full container m-2">
                            <div class="w-full px-3">
                                <ul class="list-disc list-outside text-sm text-justify">
                                    <li>عند استلام هذا البرنامج ، سيقر العميل ويوافق على الشروط والأحكام الواردة فيه.</li>
                                    <li>كن حاضرًا في المطار قبل 3 ساعات على الأقل من وقت الرحلة والالتزام بشروط الوزن المحددة من قبل شركات الطيران. أي تعديل أو تأخير أو إلغاء لجدول رحلة الطيران يعد مسؤولية شركة الطيران.</li>
                                    <li>في حال تعديل أو إلغاء تذكرة السفر، يُحسب مبلغ لقيمة التعديل أو الإلغاء يحدده الخطوط الجوية، وفي بعض الحالات قد لا تخضع التذكرة للتعديل أو الاسترجاع وفقًا لنظام الخطوط الجوية.</li>
                                    <li>بعض شركات الطيران ذات التكلفة المنخفضة (ويز إير - العربية - فلاي دبي، إلخ) لا يمكن إلغاء التذكرة وسيتم استرجاع المبلغ المدفوع. يمكن إجراء تعديل قبل 24 ساعة من وقت الرحلة مع رسوم إضافية وفقًا لنوع التذكرة وشرط الشركة الجوية.</li>
                                    <li>لا يمكن إلغاء الحجوزات في الفندق المذكور أعلاه أو تعديل تواريخ الوصول والمغادرة، وفقًا للشروط.</li>
                                    <li>أي تعديل في نوع الغرفة قبل أو بعد السفر يكون وفقًا للتوفر المتاح ويخضع لموافقة الفندق أو الشركة التي تمت من خلالها الحجز وسيتم فرض رسوم إضافية.</li>
                                    <li>وقت تسجيل الوصول للفندق، في تاريخ الوصول، هو الساعة 4:00 مساءً، ووقت تسجيل المغادرة من الفندق هو الساعة 12:00 ظهرًا، وفقًا للنظام المعتمد في الفنادق.</li>
                                    <li>الغرفة المزدوجة، وفقًا لنظام الفندق، تتألف من سرير بحجم كبير أو سريرين منفصلين، والغرفة الثلاثية تتألف من سريرين والسرير الثالث هو سرير إضافي (أريكة سرير).</li>
                                    <li>إمكانية ربط الغرف المجاورة ببعضها البعض أو وضع باب بينهما يعتمد على إدارة الفندق وفقًا للتوفر في الفندق. نسخة من جواز السفر للعميل. تحديد الغرفة في أي طابق عندما يستلم العميل الغرفة في الفندق، ولا يمكن تحديدها قبل وصول العميل والمتطلبات الخاصة بملء نماذج الفندق والكعبة، إلخ. قد تكون إطلالة جزئية أو كاملة أو جانبية، وتتفاوت وفقًا لموقع كل غرفة أو جناح في الفندق، المسجد الحرام، المسجد النبوي الشريف، المسجد الأقصى، إلخ. يختلف نوع إطلالة المدينة.</li>
                                    <li>تُطبق الشروط والإجراءات الاحترازية في جميع مراحل الرحلة، بدءًا من المطار - الطائرة - الفندق - وسائل النقل - أو وجهة الرحلة، والعميل مسؤول مباشرة عن تنفيذها.</li>
                                    <li>استعراض إجراءات السفر بوضوح خلال فترة كوفيد 19 قبل تأكيد الحجز من قبل العميل، وأي تعديل أو تغيير في إجراءات السفر أو دخول البلد الذي ليس لشركة الخالدية للعطلات والسياحة أي مسؤولية عنه، ويمكن تقديم المساعدة وفقًا للإمكان
                        
                    </div>
                </div>
                <img src="{{ URL::asset('/assets/images/voucher/seal.png') }}" alt="" srcset=""
                        class="h-2/5 max-w-xs object-contain float-left	bg-blend-multiply	pr-6">
                <img src="{{ URL::asset('/assets/images/voucher/sign.png') }}" alt="" srcset=""
                        class="h-2/5 max-w-xs object-contain float-right	bg-blend-multiply	pr-6">
            </div>
    </div>
    </section>


    </div>


</body>
<script>
    const button = document.getElementById('download-button');
    // get the invoice number from the :data-invoice attribute

    function generatePDF() {
        //scroll to top
        window.scrollTo(0, 0);
        var invoiceId = this.getAttribute('data-invoice');
        console.log(this);
        // Choose the element that your content will be rendered to.
        const element = document.getElementById('voucher');
        var opt = {
            margin: 0.5,
            filename: 'voucher_' + invoiceId + '.pdf',
            image: {
                type: 'jpeg',
                quality: 1
            },
            html2canvas: {
                dpi: 75,
                scale: 2,
                letterRendering: true
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'portrait'
            }
        };
        // Choose the element and save the PDF for your user.
        html2pdf().set(opt).from(element).save();

        // rediret to previous page after the download is done
        // window.location.href = '/bookings/'+invoiceId;

    }

    button.addEventListener('click', generatePDF);
</script>

</html>
