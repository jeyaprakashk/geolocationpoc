<!DOCTYPE html>
<html>
<head>
	<script src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCcWlh0nyut5RwehxJvbhPkpWXisANelsM" type="text/javascript"></script>
</head>
<body>

<p>Localização</p>
<p id="demo"></p>
<p>Endereço</p>
<p id="address"></p>

</body>
</html>

<script>
	var x = document.getElementById("demo");
	var y = document.getElementById("address");
	
	getLocation();
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else { 
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}

	function showPosition(position) {
		x.innerHTML = "Latitude: " + position.coords.latitude + 
		"<br>Longitude: " + position.coords.longitude;
		
		displayLocation(position.coords.latitude, position.coords.longitude);
	}
	
	function displayLocation(latitude,longitude){
		var geocoder;
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(latitude, longitude);
		
		geocoder.geocode(
			{'latLng': latlng}, 
			function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						var add= results[0].formatted_address ;
						var  value=add.split(",");

						count=value.length;
						country=value[count-1];
						state=value[count-2];
						city=value[count-3];
						y.innerHTML = "Cidade: " + add;
					}
					else  {
						y.innerHTML = "Endereço não encontrado.";
					}
				}
				else {
					y.innerHTML = "Erro: " + status;
				}
			}
		);
	}

</script>