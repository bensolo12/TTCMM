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

marker=new google.maps.Marker({
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

	//latInput.value = event.latLng.lat();
	//lngInput.value = event.latLng.lng();

	//var position = marker.getPosition();
    //console.log(position.lat(), position.lng());
	console.log(marker.getDraggable());

	//console.log(marker.getPosition().lat());
  	//console.log(marker.getPosition().lng());
	}
);