<!--  
 * User: Sameer Gurung
 * Email: email@sameergurung.com.np
 * Website: www.sameergurung.com.np
 * Date: 8/4/15
 * Time: 1:15 PM
 -->

<!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete Address Form</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0;
        padding: 0;
      }

    </style>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

var options = {
  types: ['geocode']
};


function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      options);
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;        
    }
  }

}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

    </script>

    <style>
      #locationField, #controls {
        position: relative;
        width: 480px;
      }
      #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99%;
      }
      .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
      }
      #address {
        border: 1px solid #000090;
        background-color: #f0f0ff;
        width: 480px;
        padding-right: 2px;
      }
      #address td {
        font-size: 10pt;
      }
      .field {
        width: 99%;
      }
      .slimField {
        width: 80px;
      }
      .wideField {
        width: 200px;
      }
      #locationField {
        height: 20px;
        margin-bottom: 2px;
      }
    </style>
  </head>

  <body onload="initialize()">
    <br>
    <div class="col-md-8 col-md-offset-2">
    	
    		<div id="locationField">
      		<input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text"></input>
    		</div>
    	<br>
    	<form action="submit.php" method="POST" >	    
      	
	        <label>Street address</label>
		        
	    	<input id="street_number" name="street_number" disabled="true"></input>
	  		        	
			<input  id="route" name="route" disabled="true"></input>
			<br>
		        
	        <label>City</label>			      
	      	<input class="field" id="locality" name="locality" disabled="true"></input>
	      	<br>

	      	<label>State</label>
	      	<input class="field" name="administrative_area_level_1" 
	      	id="administrative_area_level_1" disabled="true"></input>

	      	<label>Zip code</label>
		      <input class="field" id="postal_code" name="postal_code" 
		              disabled="true"></input>
	        
		    <label>Country</label>
		        <input class="field" name="country" 
		              id="country" disabled="true"></input>
		    <div class="form-group">
		    <br>
		    	<button type="submit" class="btn btn-primary">Submit</button>
		    </div>          	
	    	
    	</form>
    </div>
	
    
  </body>
</html>