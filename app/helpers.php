<?php

function formatDate($dateString, $format = 'M d, Y')
{
    return \Carbon\Carbon::parse($dateString)->format($format);
}

function getDayOnly($dateString,$format = 'M d, Y')
{
    return \Carbon\Carbon::parse($dateString)->format('d');
}

function getMonthYear($dateString,$format = 'M d, Y')
{
    return \Carbon\Carbon::parse($dateString)->format('F, Y');
}

function getDayDate($dateString,$format = 'M d, Y')
{
    return \Carbon\Carbon::parse($dateString)->format('D, d M');
}

function getYearOnly($dateString,$format = 'M d, Y')
{
    return \Carbon\Carbon::parse($dateString)->format('Y');
}
function formatStayDuration($checkInDate, $checkOutDate)
{
    // Create Carbon instances from the date strings
    $checkIn = \Carbon\Carbon::parse($checkInDate);
    $checkOut = \Carbon\Carbon::parse($checkOutDate);

    // Calculate the number of days and nights
    $numberOfDays = $checkIn->diffInDays($checkOut);
    $numberOfNights = $numberOfDays - 1;

    // Format the stay duration as "X Days / Y Nights"
    $formattedDuration = $numberOfDays . ' Days / ' . $numberOfNights . ' Nights';

    return $formattedDuration;
}

function sortSegment($array)
{
    
    // Convert the Collection object to an array using the toArray() method
   

    $array = json_decode(json_encode($array), true);

    $result = array();
    
    $commonFields=['code','check_in_luggage','luggage_capacity','arrival_destination_code','departure_destination_code','flight_number'];

    foreach ($array as $item) {
        $key = 'iata_code';
    
        if (!array_key_exists($key, $result)) {
            $result[$key] = array();
            // Include common data for each group
            foreach ($commonFields as $field) {
                // Check if $item is an array before accessing its index
                if (is_array($item)) {
                    $result[$key][$field] = $item[$field];
                }
            }
        }
    
        // Add the item to the group
        $result[$key]['items'][] = $item;
    }

    return $result;
}

function getAirportInfo($iata_code)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://airport-info.p.rapidapi.com/airport?iata=".$iata_code,  
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: airport-info.p.rapidapi.com",
            "X-RapidAPI-Key: c972b37973mshbfa72e97c29c9a5p1bc2fejsn78b1e7abd46e"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $response = json_decode($response, true);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        // split the location string into an array of strings
        $location = explode(',', $response['location']);
        return $location[0] ?? $response['city'] ?? $iata_code;
    }
}

function fligtTimeFormator($ufTime)
{
    $date = new DateTime($ufTime);
    // Format the time as "04:20 AM"
    $time = $date->format('h:i A');

    // Format the date as "2023, Sept 19"
    $dateFormatted = $date->format('Y, M d');

    // Output the resulting time and date
    $response = '<p class="text-lg font-bold text-primary">'.$time.'</p>
    <p class="text-md font-medium text-grey max-w-[80%]">'.$dateFormatted.'</p>';
   
    return $response;
}