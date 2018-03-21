
$("#refresh1").on('click', function () {
    var p2_lat = parseFloat($("input[name=p2-lat]").val());
    var p2_long = parseFloat($("input[name=p2-long]").val());
    let p2_zoom = parseInt($("input[name=p2-zoom]").val());
    console.log(p2_lat, p2_long);
    var p2_new_lat_long = new google.maps.LatLng(p2_lat, p2_long);
    console.log(p2_new_lat_long);
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: p2_zoom,
        center: new google.maps.LatLng(p2_lat, p2_long)
    });
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(p2_lat, p2_long),
        map: map,
        title:'now here'
    });
});

function initMap(){
    var kediri = {lat: -7.822, lng: 112.011};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: kediri
    });

    var marker = new google.maps.Marker({
        position: kediri,
        map: map,
        title:'now here'
    });
}