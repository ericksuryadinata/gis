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
    let lokasi = {lat: -7.271392714896101, lng: 112.73542550138382};
    //let lokasi = {lat: -7.2742175, lng: 112.719087};
    let map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: lokasi,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    // let koordinatRumahku = [
    //     new google.maps.LatLng(-7.2713980361721555, 112.73541477254776),
    //     new google.maps.LatLng(-7.271394045215119, 112.73537319830803),
    //     new google.maps.LatLng(-7.271318217024526, 112.73537990383056),
    //     new google.maps.LatLng(-7.271319547343773, 112.73541879586128),
    // ];
    
    // let lokasiRumahku = {lat: -7.271343493089482, lng: 112.73539331487564};
    // let pesanRumahku = 'Hai ini rumahku';
    // let rumahku = new google.maps.Polygon({
    //     paths: koordinatRumahku,
    //     strokeColor: 'green',
    //     strokeOpacity: 0.8,
    //     strokeWeight: 2,
    //     fillColor: 'yellow',
    //     fillOpacity: 0.35
    // });
    
    // rumahku.setMap(map);

    // let markerRumahku = new google.maps.Marker({
    //     position: lokasiRumahku,
    //     map: map,
    //     animation : google.maps.Animation.DROP,
    //     title:'now here',
    // });

    // markerRumahku.addListener('click', function(e) {
    //     var infowindow = new google.maps.InfoWindow({
    //         content: pesanRumahku,
    //     });
    //     map.setCenter(markerRumahku.getPosition());
    //     toggleBounce(markerRumahku);
    //     infowindow.open(map,markerRumahku);
    // });

    // rumahku.infoWindow = new google.maps.InfoWindow({
    //     content: pesanRumahku,
    // });
    
    // google.maps.event.addListener(rumahku,'mouseover',function(event){
    //     var posisi = event.latLng;
    //     rumahku.infoWindow.setPosition(posisi);
    //     rumahku.infoWindow.open(map);
    // });

    // google.maps.event.addListener(rumahku, 'mouseout', function() {
    //     rumahku.infoWindow.close();
    // });

    // let koordinatLine = [
    //     new google.maps.LatLng(-7.2742175, 112.719087),
    //     new google.maps.LatLng(-7.98189400,112.6265029),
    //     new google.maps.LatLng(-7.62860999, 112.2006989 ),
    //     new google.maps.LatLng(-7.2742175, 112.719087)
    // ];
    // let polyLine = new google.maps.Polyline({
    //     paths: koordinatLine,
    //     geodesic:true,
    //     strokeColor:'#FF0000',
    //     strokeOpacity: 1.0,
    //     strokeWeight: 2,
    // });

    // polyLine.setMap(map);
    
    var pilkota = {
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.10,
        map: map,
        center: lokasi,
        radius: 20000
      };

    var kota = new google.maps.Circle(pilkota);
    google.maps.event.addListener(map, 'click', 
        function(event) {
            let position  = event.latLng;
            swal('Lokasi',position.lat()+', '+position.lng(),'warning');
            let markerMaps = new google.maps.Marker({
                position  : event.latLng,
                map       : map,
            });

            markerMaps.addListener('click', function(e) {
                console.log(e.latLng);
                var infowindow = new google.maps.InfoWindow({
                    content: isi,
                });
                map.setCenter(markerMaps.getPosition());
                toggleBounce(markerMaps);
                infowindow.open(map,markerMaps);
            });
        }
    );
}

function toggleBounce(marker) {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}