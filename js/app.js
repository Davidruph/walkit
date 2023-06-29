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
      travelMode: google.maps.TravelMode[transport_mode],
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
        var transportModeValue =
          document.getElementById("transport_mode").value;

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

        //display route
        displayDirection.setDirections(result);
        document.getElementById("results").style.display = "block";
        document.getElementById("maps").style.display = "block";
        $(function () {
          $("#saved_km").val(result.routes[0].legs[0].distance.text + "s");
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

        var transportModeValue =
          document.getElementById("transport_mode").value;

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
