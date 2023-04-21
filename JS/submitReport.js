$('#formCreateReport').submit(function(event){
    event.preventDefault();

    if ($('#problemDescription').val().trim() != '') {
        var formData = new FormData(this);
        formData.append('lat', marker1.getPosition().lat());
        formData.append('lng', marker1.getPosition().lng());
        formData.append('phpFunction', 'create');

        $.ajax({
            type: "POST",
            url: "../PHP/createReportDB.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(msg){
                $("#divMessage").html(msg);	
                alert(msg);
            },
            error: function(msg){
                console.log(msg);
            }
        });
    }
});

let latInput = document.getElementById('lat');
let lngInput = document.getElementById('lng');

var mapCenter1 = new google.maps.LatLng(51.887912272257076,-2.0869772550118904);
var mapOptions1 = {
    zoom: 16,
    center: mapCenter1,
    mapTypeId: google.maps.MapTypeId.ROADMAP
};
var container1 = document.getElementById('map-canvas1');
var map1 = new google.maps.Map(container1, mapOptions1);

var mapCenter2 = new google.maps.LatLng(51.887912272257076,-2.0869772550118904);
var mapOptions2 = {
    zoom: 16,
    center: mapCenter2,
    mapTypeId: google.maps.MapTypeId.ROADMAP
};
var container2 = document.getElementById('map-canvas2');
var map2 = new google.maps.Map(container2, mapOptions2);

var marker1 = new google.maps.Marker({
    position: mapCenter1,
    map: map1,
    title: 'Issue Location',
    draggable: true
});

var marker2 = new google.maps.Marker({
    position: marker1.getPosition(),
    map: map2,
    title: 'Issue Location',
    draggable: false
});

var contentString = '<h1>Issue Location</h1>' + 'Please place this marker the location of the issue';

marker1.addListener('click', function(){
    infoWindow.open(map1, marker1);
});

var infoWindow= new google.maps.InfoWindow({
    content: contentString
});

marker1.addListener('dragend', function(event){
    latInput.value = event.latLng.lat();
    lngInput.value = event.latLng.lng();

	marker2.setPosition(marker1.getPosition());
	map2.setCenter(marker2.getPosition());

});
