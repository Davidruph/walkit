// map options

var latitudelongtitude = { lat: 55.3781, lng: -3.436 }; // for united kingdom
var mapOptions = {
  center: latitudelongtitude,
  zoom: 7,
  mapTypeId: google.maps.MapTypeId.ROADMAP,
};

//create map

var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

//create a direction service object

var serviceDirection = new google.maps.DirectionsService();

//create a direction renderer objectto dosplay route

var displayDirection = new google.maps.DirectionsRenderer();

//bind directions renderer to the map
displayDirection.setMap(map);

//function
function calcRoute() {
  var fromVal = document.getElementById("from").value;
  var toVal = document.getElementById("to").value;
  var transport_mode = document.getElementById("transport_mode").value;
  var calculateButton = document.querySelector(".calc-btn");
  var co2eTable = {
    moped_motorcycle: 75,
    small_car: 96,
    big_car: 192,
    suv: 350,
    pickup_truck: 375,
  };

  if (fromVal.length === 0) {
    Swal.fire("Ooops Sorry!", "Pls enter an Origin to continue!", "error");
  } else if (toVal.length === 0) {
    Swal.fire("Ooops Sorry!", "Pls enter a Destination to continue!", "error");
  } else if (transport_mode.length === 0) {
    Swal.fire(
      "Ooops Sorry!",
      "Pls select a transport mode to continue!",
      "error"
    );
  } else {
    calculateButton.disabled = true;
    calculateButton.innerHTML = "Calculating...";

    var unit = "metric";
    var request = {
      origin: fromVal,
      destination: toVal,
      travelMode: google.maps.TravelMode.WALKING,
      unitSystem:
        unit === "metric"
          ? google.maps.UnitSystem.METRIC
          : google.maps.UnitSystem.IMPERIAL,
    };

    //pass the request to the route method
    serviceDirection.route(request, (result, status) => {
      if (status == google.maps.DirectionsStatus.OK) {
        calculateButton.disabled = false;
        calculateButton.innerHTML = '<i class="fa fa-route"></i> Calculate';
        // Get the transport mode value
        var co2ePerKm = co2eTable[transport_mode];
        var distanceKm = result.routes[0].legs[0].distance.value / 1000;

        // Calculate the CO2e saved
        var co2eSaved = distanceKm * co2ePerKm;
        // Determine the unit for CO2e display
        var co2eUnit = "grams";
        if (co2eSaved > 1000) {
          co2eSaved /= 1000;
          co2eUnit = "kilograms";
        }

        var transportModeValue = "WALKING";

        // Create a variable to hold the transport mode text
        var transportModeText = "";

        // Assign the appropriate transport mode text based on the transport mode value
        switch (transportModeValue) {
          case "DRIVING":
            transportModeText = "Driving";
            break;
          case "WALKING":
            transportModeText = "Walking";
            break;
          case "BICYCLING":
            transportModeText = "Bicycling";
            break;
          case "TRANSIT":
            transportModeText = "Transit";
            break;
          default:
            transportModeText = "Unknown";
            break;
        }
        //get distance and time

        const output_result = document.querySelector("#output");
        output_result.innerHTML =
          "<b>Great job, you saved " +
          result.routes[0].legs[0].distance.text +
          "s of " +
          transportModeText +
          " to " +
          document.getElementById("from").value +
          "</b>.<br /><b>The " +
          transportModeText +
          " duration is </b><i class='fa fa-stopwatch'></i> : " +
          result.routes[0].legs[0].duration.text +
          ".";

        const grams_saved = document.querySelector("#grams_saved");
        grams_saved.innerHTML =
          "<div><p>You also saved <br /> <h4 class='title'>" +
          co2eSaved.toFixed(2) +
          " " +
          co2eUnit +
          " of CO2e </h4> with this trip.</p></div>";

        //display route
        displayDirection.setDirections(result);
        document.getElementById("results").style.display = "block";
        document.getElementById("maps").style.display = "block";
        $(function () {
          $("#saved_km").val(result.routes[0].legs[0].distance.text + "s");
          $("#saved_carbon").val(co2eSaved.toFixed(2) + " " + co2eUnit);
          $("#log").trigger("click");
        });
      } else {
        //delete route from map
        calculateButton.disabled = false;
        calculateButton.innerHTML = '<i class="fa fa-route"></i> Calculate';
        const output_result = document.querySelector("#output");
        document.getElementById("results").style.display = "block";

        displayDirection.setDirections({ routes: [] });

        //center map in spain
        map.setCenter(latitudelongtitude);

        var transportModeValue = "WALKING";

        // Create a variable to hold the transport mode text
        var transportModeText = "";

        // Assign the appropriate transport mode text based on the transport mode value
        switch (transportModeValue) {
          case "DRIVING":
            transportModeText = "Driving";
            break;
          case "WALKING":
            transportModeText = "Walking";
            break;
          case "BICYCLING":
            transportModeText = "Bicycling";
            break;
          case "TRANSIT":
            transportModeText = "Transit";
            break;
          default:
            transportModeText = "Unknown";
            break;
        }
        //show eeror message
        output_result.innerHTML =
          "<div class='alert-danger'><i class='fa fa-exclamation-triangle'></i> Failed to retrieve " +
          transportModeText +
          " distance or " +
          transportModeText +
          " is not available for this route. Please try a different mode of transportation or check your origin and destination. Error: " +
          status +
          "</div>";
      }
    });
  }
}

//var autocomplete;
autocomplete1 = new google.maps.places.Autocomplete(
  document.getElementById("from"),
  { types: ["geocode"] }
);
google.maps.event.addListener(autocomplete1, "place_changed", function () {
  fillInAddress();
});

autocomplete2 = new google.maps.places.Autocomplete(
  document.getElementById("to"),
  { types: ["geocode"] }
);
google.maps.event.addListener(autocomplete2, "place_changed", function () {
  fillInAddress();
});

function fillInAddress() {
  // Get the place details from the autocomplete object.
  //const place = autocomplete.getPlace();
}
