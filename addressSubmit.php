<?php

/**
 * @function getDistance()
 * Calculates the distance between two addresses
 * 
 * @params
 * $addressFrom - Starting point
 * $addressTo - End point
 * $mode - Transport mode
 * $unit - Unit type
 * 
 * @return string - The calculated distance
 * 
 * @author David
 *
 */
function getDistance($addressFrom, $addressTo, $mode, $unit = 'K')
{
    // Google API key
    $apiKey = 'AIzaSyBtJ99NRw1wBanqdNqp7HyKGtGq_LrT2Fw';

    // Change address format
    $formattedAddrFrom = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo = str_replace(' ', '+', $addressTo);
    $mode =  str_replace(' ', '+', $mode);

    // Directions API request
    $directionsUrl = 'https://maps.googleapis.com/maps/api/directions/json?origin=' . $formattedAddrFrom . '&destination=' . $formattedAddrTo . '&mode=' . $mode . '&key=' . $apiKey;
    $directionsData = file_get_contents($directionsUrl);
    $directionsResult = json_decode($directionsData);

    // Check if the API returned valid results
    if ($directionsResult->status == 'OK') {
        $distanceValue = $directionsResult->routes[0]->legs[0]->distance->value;
        $distanceText = $directionsResult->routes[0]->legs[0]->distance->text;
        if ($unit == 'K') {
            return round($distanceValue / 1000, 2) . ' km';
        } elseif ($unit == 'M') {
            return round($distanceValue * 0.621371 / 1000, 2) . ' miles';
        } else {
            return $distanceText;
        }
    } else {
        return 'Error: ' . $directionsResult->status;
    }
}

// Get the two addresses
$addressFrom = 'Newbury Street, Boston, MA, USA';
$addressTo = 'New Jersey Turnpike, Kearny, NJ, USA';
$mode = 'DRIVING'; // Replace with the selected mode from your form

// Get distance
$distance = getDistance($addressFrom, $addressTo, $mode, 'K');

echo $distance;
