

$("#refresh1").on('click', function () {
    var latitude1 = $("input[name=lat1]").val();
    var longitude1 = $("input[name=long1]").val();
    console.log(typeof(latitude1), typeof(longitude1));
    var newLatlng1 = new google.maps.LatLng(latitude1, longitude1);
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: newLatlng1
    });
    var marker = new google.maps.Marker({
        position: newLatlng1,
        map: map
    });
});

$("#refresh2").on('click', function () {
    let latitude2 = $("input[name=lat2]").val();
    let longitude2 = $("input[name=long2]").val();    
    var newLatlng2 = new google.maps.LatLng(latitude2, longitude2);
    var map = new google.maps.Map(document.getElementById('map1'), {
        zoom: 16,
        center: newLatlng2
    });
    var marker = new google.maps.Marker({
        position: newLatlng2,
        map: map
    });
});


function initMap(){
    var kediri = {lat: -7.822, lng: 112.011};
    var surabaya = {lat: -7.2575, lng: 112.7521};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: kediri
    });

    var map1 = new google.maps.Map(document.getElementById('map1'), {
        zoom: 16,
        center: surabaya
    });

    var marker = new google.maps.Marker({
        position: kediri,
        map: map
    });

    var marker1 = new google.maps.Marker({
        position: surabaya,
        map: map1
    });
}