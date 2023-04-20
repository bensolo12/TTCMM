$('#formCreateReport').submit(function(event){
	formData = $('#formCreateReport').serialize();
    event.preventDefault();

	$.ajax({
		type: "POST",
		url: "../PHP/createReportDB.php",
		data: formData+ "&lat="+marker.getPosition().lat()+"&lng="+marker.getPosition().lng()+"&phpFunction=create",
	    success: function(msg){
			$("#divMessage").html(msg);
			alert(msg);
	    },
		error: function(msg){
			console.log(msg);
	    }
	});
});

let latInput = document.getElementById('lat');
let lngInput = document.getElementById('lng');

var mapCenter=new google.maps.LatLng(51.887912272257076,-2.0869772550118904);
var mapOptions={
	zoom: 18,
	center: mapCenter,
	mapTypeId: google.maps.MapTypeId.HYBRID
};
var container=document.getElementById('map-canvas');
var map=new google.maps.Map(container, mapOptions);

var marker=new google.maps.Marker({
	position: mapCenter,
	map:map,
	title: 'Issue Location',
	draggable: true
});
var contentString = '<h1>Issue Location</h1>' + 'Please place this marker the location of the issue';

marker.addListener('click', function(){
	infoWindow.open(map, marker);
});

var infoWindow= new google.maps.InfoWindow({
	content:contentString
});

marker.addListener('dragend', function(event){
	var newLat = event.latLng.lat();
	var newLng = event.latLng.lng();
	latInput.value = newLat;
	lngInput.value = newLng;
	}
);

google.maps.event.addListener(marker, 'dragend', function(event){
	console.log(marker.getPosition().lat());
  console.log(marker.getPosition().lng());
});
