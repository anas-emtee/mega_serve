/*$('#menu-hider, .close-menu, .menu-hide').on('click',function(){
    $('.menu-box').removeClass('menu-box-active');
    $('#menu-hider').removeClass('menu-hider-active');
    return false;
});*/
$(document).ready(function(){      
    'use strict'	
			    
	function showLocation(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        console.log(position);
        var mylatLng = {lat: latitude, lng: longitude}
        var latlongvalue = latitude+"X"+longitude;
        var addressValue = "Not Found";
        //alert(latlongvalue);

        var geocoder = new google.maps.Geocoder();
        console.log(position.coords);
        geocoder.geocode({
            'latLng': mylatLng
        }, function(results, status) {
            //alert(status);
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                //alert(results[0].formatted_address);
                addressValue = results[0].formatted_address;
                //alert(addressValue);
                $.post("app_setlocation.php",
                  {
                    action: "set_location",
                    location: latlongvalue,
                    address: addressValue
                  },
                  function(data, status){
                    console.log("Data: " + data + "\nStatus: " + status);
                  }
                );
                //document.getElementById('adr').value = results[0].formatted_address;
              }
            }
        });
    }
    function errorHandler(err) {
        if(err.code == 1) {
           alert("Error: Access is denied!");
        } else if( err.code == 2) {
           alert("Error: Position is unavailable!");
        }
    }
    function getLocation(){
        if(navigator.geolocation){
           // timeout at 60000 milliseconds (60 seconds)
           var options = {timeout:60000};
           navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
        } else{
           alert("Sorry, browser does not support geolocation!");
        }
    }
    setInterval(getLocation(), 60000);
    //getLocation();
});

