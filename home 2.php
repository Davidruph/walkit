<?php

/**
 * @function getDistance()
 * Calculates the distance between two address
 * 
 * @params
 * $addressFrom - Starting point
 * $addressTo - End point
 * $unit - Unit type
 * 
 * @author CodexWorld
 * @url https://www.codexworld.com
 *
 */


function getDistance($addressFrom, $addressTo, $unit = '')
{
  // Google API key
  $apiKey = 'AIzaSyBtJ99NRw1wBanqdNqp7HyKGtGq_LrT2Fw';

  // Change address format
  $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
  $formattedAddrTo     = str_replace(' ', '+', $addressTo);

  // Geocoding API request with start address
  $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrFrom . '&sensor=false&key=' . $apiKey);
  $outputFrom = json_decode($geocodeFrom);
  if (!empty($outputFrom->error_message)) {
    return $outputFrom->error_message;
  }

  // Geocoding API request with end address
  $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $apiKey);
  $outputTo = json_decode($geocodeTo);
  if (!empty($outputTo->error_message)) {
    return $outputTo->error_message;
  }

  // Get latitude and longitude from the geodata
  $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
  $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
  $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
  $longitudeTo    = $outputTo->results[0]->geometry->location->lng;

  // Calculate distance between latitude and longitude
  $theta    = $longitudeFrom - $longitudeTo;
  $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
  $dist    = acos($dist);
  $dist    = rad2deg($dist);
  $miles    = $dist * 60 * 1.1515;

  // Convert unit and return distance
  $unit = strtoupper($unit);
  if ($unit == "K") {
    return round($miles * 1.609344, 2) . ' km';
  } elseif ($unit == "M") {
    return round($miles * 1609.344, 2) . ' meters';
  } else {
    return round($miles, 2) . ' miles';
  }
}

if (isset($_POST['submit'])) {
  //get the two address
  $addressFrom = $_POST['addressFrom'];
  $addressTo   = $_POST['addressTo'];

  // Get distance in km
  $distance = getDistance($addressFrom, $addressTo, "K");

  //echo $distance;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecodemy WalkIT™ - Home</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="js/index.js"></script>
  <style>
    .hidden,
    .loader {
      display: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center mt-2">
      <div class="col-lg-6">
        <h2 class="text-center text-dark mb-3">Demo</h2>
        <div class="w-100 shadow trans card">
          <form id="address-form" action="index.php" method="post" autocomplete="off">
            <div class=" form-group mt-4 mr-4 ml-4">
              <label for="From">From</label>
              <input type="text" class="form-control" name="addressFrom" id="address-from" required autocomplete="off">
            </div>

            <div class=" form-group mt-4 mr-4 ml-4">
              <label for="To">To</label>
              <input type="text" class="form-control" name="addressTo" id="address-to" required autocomplete="off">
            </div>

            <div class="form-group mr-4 ml-4">
              <input type="submit" class="btn btn-dark calculate w-100 mt-2 mb-3" name="submit" value="Calculate">
            </div>
          </form>
        </div>
      </div>

      <?php
      if (!empty($distance)) {
      ?>
        <div class="col-lg-6">
          <h2 class="text-center text-dark mb-3">Results</h2>
          <!-- <div class="loader">
         <img src="img/spinner-icon-gif-10.jpg" class="img-fluid mt-3 mb-3" height="80" width="80" alt="" style="display: block;margin: 0 auto;"></div> -->


          <div class="w-100 shadow card">
            <div class="text-left mr-3 ml-3 mt-3 mb-3">
              <p> The Distance From &nbsp; <b>"<?= $addressFrom ?? '' ?>"</b> &nbsp; To &nbsp; <b>"<?= $addressTo ?? '' ?>"</b> &nbsp; Is &nbsp; <b><?= $distance ?? '' ?>.</b></p>
            </div>
          </div>
        <?php
      }
        ?>


        </div>
    </div>
  </div>

  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtJ99NRw1wBanqdNqp7HyKGtGq_LrT2Fw&callback=initAutocomplete&libraries=places&v=weekly" async></script>


</body>

</html>