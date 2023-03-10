$.ajax({
    type: 'POST',
    url: '../PHP/mapJson.php',
    data: {functionName: 'json'},
    dataType: 'json',
    success: function(response) {
      var lat = response.latitude;
      var lng = response.longitude;
      createMap(lat, lng);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
  
  function createMap(lat, lng) {
    var mapCenter = new google.maps.LatLng(lat, lng);
    var mapOptions = {
      zoom: 12,
      center: mapCenter,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var container = document.getElementById('map-container');
    var map = new google.maps.Map(container, mapOptions);
    var marker = new google.maps.Marker({
      position: mapCenter,
      map: map
    });
  }
  




/* fetch("../Views/viewReport.php", {
    method: "POST",
    body: "id=" + id + "&phpFunction=fetch",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    }
  })
  .then(response => response.json())
  .then(dataJson => {
    var mapCenter = new google.maps.LatLng(dataJson['Lat'], dataJson['Lng']); //longitude and lattittude the map opens at
    var mapOptions = {
      zoom: 18,
      center: mapCenter,
      mapTypeId: google.maps.MapTypeId.HYBRID //allows map options such as Hybrid, Roadmap and Satalite
    };
    var container = document.getElementById('bikeMap');
    var map = new google.maps.Map(container, mapOptions);
    // Showing a marker in the google map
    var marker = new google.maps.Marker({
      position: mapCenter,
      map: map,
      title: 'Problem Location', //shows when you hover over the marker
      //icon: 'unknown.png'//allows for a custom marker icon
      draggable: false
    });
    var contentString = '<h1>Your Bike</h1>' + 'The last known location of your bike'; //content string for the infowindow
    //determines where the infowindow should be
    marker.addListener('click', function() {
      infoWindow.open(map, marker); //adds an event listener to the marker
    });
    //this creates the info window and fetches the text from the var
    var infoWindow = new google.maps.InfoWindow({
      content: contentString
    });
  })
  .catch(error => console.error(error)); */