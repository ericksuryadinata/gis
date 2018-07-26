$("#p11-refresh").on('click', function () {
    var p11_panjang = parseFloat($("input[name=p11-panjang]").val());
    var p2_luas = parseFloat($("input[name=p11-luas]").val());
});

function initMap(){
	let lokasi = new google.maps.LatLng(-7.2713980361721555, 112.73541477254776);
    // let lokasi = {lat: -7.271392714896101, lng: 112.73542550138382};
    //let lokasi = {lat: -7.2742175, lng: 112.719087};
    let map = new google.maps.Map(document.getElementById('map'), {
        zoom: 22,
        center: lokasi,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    let koordinatRumahku = [
        new google.maps.LatLng(-7.2713980361721555, 112.73541477254776),
        new google.maps.LatLng(-7.271394045215119, 112.73537319830803),
        new google.maps.LatLng(-7.271318217024526, 112.73537990383056),
        new google.maps.LatLng(-7.271319547343773, 112.73541879586128),
	];
	
	let arrayKoordinatRumahku = [
        {lat : -7.2713980361721555,lng: 112.73541477254776},
        {lat :-7.271394045215119,lng: 112.73537319830803},
        {lat :-7.271318217024526,lng: 112.73537990383056},
        {lat :-7.271319547343773,lng: 112.73541879586128},
    ];
    
    let polygon = new google.maps.Polygon({
		// paths : arrayKoordinatRumahku,
        strokeColor: 'green',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: 'yellow',
        fillOpacity: 0.35
    });
    
    polygon.setMap(map);

    let polyLine = new google.maps.Polyline({
		// paths : arrayKoordinatRumahku,
        geodesic:true,
        strokeColor:'#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2,
    });

	polyLine.setMap(map);
	console.log(koordinatRumahku);

	// document.getElementById('p11-panjang').value = new google.maps.geometry.spherical.computeLength(koordinatRumahku);
	// $("#p11-panjang").parent().addClass('is-dirty');
	// document.getElementById('p11-luas').value = new google.maps.geometry.spherical.computeArea(arrayKoordinatRumahku);
	// $("#p11-luas").parent().addClass('is-dirty');
	google.maps.event.addListener(map,'click',function(event){
		let garis = polyLine.getPath();
		garis.push(event.latLng);
		console.log(event.latLng);
		let gpath = polygon.getPath();
		gpath.push(event.latLng);
		console.log(garis.getArray());
		let hasil = google.maps.geometry.spherical.computeLength(garis.getArray());
		document.getElementById('p11-panjang').value = hasil.toFixed(2);
		$("#p11-panjang").parent().addClass('is-dirty');

		if(gpath.getLength() > 2){
			document.getElementById('p11-luas').value = google.maps.geometry.spherical.computeArea(gpath.getArray());
			$("#p11-luas").parent().addClass('is-dirty');
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
