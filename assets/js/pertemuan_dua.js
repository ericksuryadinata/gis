
$("#refresh1").on('click', function () {
    var p2_lat = parseFloat($("input[name=p2-lat]").val());
    var p2_long = parseFloat($("input[name=p2-long]").val());
    let p2_zoom = parseInt($("input[name=p2-zoom]").val());
    let image = base_url+'assets/img/facebook.ico';
    console.log(p2_lat, p2_long);
    var p2_new_lat_long = new google.maps.LatLng(p2_lat, p2_long);
    console.log(p2_new_lat_long);
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: p2_zoom,
        center: p2_new_lat_long
    });
    
    var marker = new google.maps.Marker({
        position: p2_new_lat_long,
        map: map,
        title:'now here'
    });
    
    marker.addListener('click', function(e) {
        map.setZoom(19);
        map.setCenter(marker.getPosition());
        var infowindow = new google.maps.InfoWindow({
            content: 'Halo Informatika'
        });
        toggleBounce(marker);
        infowindow.open(map,marker);
    });
});

function initMap(){
    let image = base_url+'assets/img/logoSmall.ico';
    let foto  = base_url+'assets/img/foto.jpeg';
    let isi = '<table><tr><td>Halo Informatika</td></tr><tr><td>NBI : 1461505276</td></tr><tr><td>Nama : Erick Surya Dinata</td></tr><tr><td></tr><tr><img src="'+foto+'"></td></tr></table>';
    var kediri = {lat: -7.822, lng: 112.011};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: kediri,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        mapTypeId: google.maps.MapTypeId.HYBRID
    });

    var marker = new google.maps.Marker({
        position: kediri,
        map: map,
        animation : google.maps.Animation.DROP,
        title:'now here',
        icon:image
    });

    marker.addListener('click', function(e) {
        var infowindow = new google.maps.InfoWindow({
            content: isi,
        });
        if(map.getZoom() == 19){
            map.setZoom(15);
            infowindow.close();
        }else{
            map.setZoom(19);
            console.log(map.getZoom());
            map.setCenter(marker.getPosition());
            toggleBounce(marker);
            infowindow.open(map,marker);
        }
    });
}


function toggleBounce(marker) {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}