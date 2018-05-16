let isPusatUkmClicked = isPusatKotaClicked = isWilayahClicked = isPusatUkmEditClicked = isPusatKotaEditClicked = isWilayahEditClicked = false;

function CenterControl(controlDiv, map, center) {
	// We set up a variable for this since we're adding event listeners
	// later.
	let control = this;

	// Set the center property upon construction
	control.center_ = center;
	controlDiv.style.clear = 'both';

	// Set CSS for the control border
	let goCenterUI = document.createElement('div');
	goCenterUI.id = 'goCenterUI';
	goCenterUI.title = 'Direct to my house';
	controlDiv.appendChild(goCenterUI);

	// Set CSS for the control interior
	let goCenterText = document.createElement('div');
	goCenterText.id = 'goCenterText';
	goCenterText.innerHTML = 'My House';
	goCenterUI.appendChild(goCenterText);

	// Set CSS for the setCenter control border
	let setCenterUI = document.createElement('div');
	setCenterUI.id = 'setCenterUI';
	setCenterUI.title = 'Set this to be my house';
	controlDiv.appendChild(setCenterUI);

	// Set CSS for the control interior
	let setCenterText = document.createElement('div');
	setCenterText.id = 'setCenterText';
	setCenterText.innerHTML = 'Set Center';
	setCenterUI.appendChild(setCenterText);

	// Set CSS for the setCenter control border
	let getOutUI = document.createElement('div');
	getOutUI.id = 'getOutUI';
	getOutUI.title = 'Get me out from my house';
	controlDiv.appendChild(getOutUI);

	// set CSS for the control interior
	let getOutText = document.createElement('div');
	getOutText.id = 'getOutText';
	getOutText.innerHTML = 'get Out';
	getOutUI.appendChild(getOutText);

	// Set up the click event listener for 'Center Map': Set the center of
	// the map
	// to the current center of the control.
	goCenterUI.addEventListener('click', function() {
		let currentCenter = control.getCenter();
		map.setCenter(currentCenter);
		map.setZoom(22);
		map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
	});

	// Set up the click event listener for 'Set Center': Set the center of
	// the control to the current center of the map.
	setCenterUI.addEventListener('click', function() {
		let newCenter = map.getCenter();
		control.setCenter(newCenter);
	});

	// Listener to get this out from the house
	getOutUI.addEventListener('click',function(){
		let now = control.getCenter();
		map.setCenter(now);
		map.setZoom(10);
		map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
	});
}

/**
 * Define a property to hold the center state.
 * @private
 */
CenterControl.prototype.center_ = null;

/**
 * Gets the map center.
 * @return {?google.maps.LatLng}
 */
CenterControl.prototype.getCenter = function() {
	return this.center_;
};

/**
 * Sets the map center.
 * @param {?google.maps.LatLng} center
 */
CenterControl.prototype.setCenter = function(center) {
	this.center_ = center;
};


function initMap(destination, lokasiFromDatabase){
	let iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
	let lokasi = {lat: -7.2713980361721555, lng: 112.73541477254776};
	let lokasiPusatKota, lokasiPusatUkm, markerPusatKota, markerPusatUkm;
	let infowindow = new google.maps.InfoWindow();
    let map = new google.maps.Map(document.getElementById(destination), {
        zoom: 10,
        center: lokasi,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			mapTypeIds: ['roadmap','satellite', 'terrain','labels'],
			position: google.maps.ControlPosition.BOTTOM_CENTER
		},
		zoomControl: true,
		zoomControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		scaleControl: true,
		streetViewControl: true,
		streetViewControlOptions: {
			position: google.maps.ControlPosition.LEFT_BOTTOM
		},
		fullscreenControl: true
	});

	// Create the DIV to hold the control and call the CenterControl()
	// constructor
	// passing in this DIV.
	let centerControlDiv = document.createElement('div');
	let centerControl = new CenterControl(centerControlDiv, map, lokasi);

	centerControlDiv.index = 1;
	centerControlDiv.style['padding-top'] = '10px';
	map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);

	console.log(lokasiFromDatabase);
	let koordinatFromDatabase = [];
	for (let pos = 0; pos < lokasiFromDatabase.length; pos++) {
		koordinatFromDatabase.push([]);
		lokasi = lokasiFromDatabase[pos].plain_wilayah.replace('MULTIPOINT(','');
		/**
		 * untuk yang pake mysql versi 5.7, karena astext deprecated,
		 * dan komposisi ST_AsWKT atau ST_AsText untuk multipoint berbeda
		 * dengan yang versi 5.7 kebawah
		 */
		lokasi = lokasi.replace(/\(/g,"");
		lokasi = lokasi.replace(/\)/g,"");
		lokasi = lokasi.split(',');
		lokasiPusatKota = lokasiFromDatabase[pos].pusat_kota.replace('POINT(','');
		lokasiPusatKota = lokasiPusatKota.replace(')','');
		lokasiPusatKota = lokasiPusatKota.split(' ');

		lokasiPusatUkm = lokasiFromDatabase[pos].pusat_ukm.replace('POINT(','');
		lokasiPusatUkm = lokasiPusatUkm.replace(')','');
		lokasiPusatUkm = lokasiPusatUkm.split(' ');

		markerPusatKota = new google.maps.Marker({
			position  : new google.maps.LatLng(parseFloat(lokasiPusatKota[0]),parseFloat(lokasiPusatKota[1])),
			map       : map,
			icon : iconBase + 'capital_big_highlight.png',
		});

		markerPusatUkm = new google.maps.Marker({
			position  : new google.maps.LatLng(parseFloat(lokasiPusatUkm[0]),parseFloat(lokasiPusatUkm[1])),
			map       : map,
			icon : iconBase + 'placemark_circle.png',
		});

		(function (markerPusatKota, pos) {  
			google.maps.event.addListener(markerPusatKota, 'click', function (e) {
					infowindow.setContent(lokasiFromDatabase[pos].nama_kabupaten);
					infowindow.open(map, markerPusatKota);
					map.setCenter(markerPusatKota.getPosition());
			});
		})(markerPusatKota, pos);

		(function (markerPusatUkm, pos) {  
			google.maps.event.addListener(markerPusatUkm, 'click', function (e) {
					infowindow.setContent('Wilayah : '+lokasiFromDatabase[pos].nama_kabupaten);
					infowindow.open(map, markerPusatUkm);
					map.setCenter(markerPusatUkm.getPosition());
			});
		})(markerPusatUkm, pos);

		for (let index = 0; index < lokasi.length; index++) {
			let kumpulanPoint = lokasi[index].split(' ');
			koordinatFromDatabase[pos].push(new google.maps.LatLng(parseFloat(kumpulanPoint[0]),parseFloat(kumpulanPoint[1])));
		}
	}
	console.log(koordinatFromDatabase);
    $.each(koordinatFromDatabase, function (i, v) {

		let polygon = new google.maps.Polygon({
			paths: v,
			strokeColor : getRandomColor(),
			strokeOpacity: 0.8,
			strokeWeight: 1,
			fillColor: getRandomColor()
		});
		polygon.setMap(map);
	});
}

function toggleBounce(marker) {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

function getRandomColor() {
	let letters = '0123456789ABCDEF';
	let color = '#';
	for (let i = 0; i < 6; i++) {
	  color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}

function initTable(target, data){
	let html = '';
	let targetID = document.getElementById(target);
	while (targetID.firstChild) {
		targetID.removeChild(targetID.firstChild);
	}
	data.forEach(value => {
		html+= '<tr>';
		html+= "<td><a href='javascript:void(0)' class='mdl-button mdl-js-button mdl-button--raised mdl-button--colored edit-data show-modal-edit' id='edit-data' data-id='"+value.id+"'>Edit</a> <a href='javascript:void(0)' class='mdl-button mdl-js-button mdl-button--raised mdl-button--colored delete-data' id='delete-data' data-id='"+value.id+"'>Delete</a></td>'";
		html+= "<td>"+value.kode_kabupaten+"</td>";
		html+= "<td>"+value.nama_kabupaten+"</td>";
		html+= "<td>"+value.plain_wilayah+"</td>";
		html+= "<td>"+value.pusat_kota+"</td>";
		html+= "<td>"+value.pusat_ukm+"</td>";
		html+= "<td>"+value.nama_bupati+"</td>";
		html+= "<td>"+value.jumlah_penduduk+"</td>";
		html+= "<td>"+value.jumlah_ukm+"</td>";
		html+= "</tr>";
	});
	targetID.innerHTML += html;
}

$(document).ready(function () {
	initMap('map',lokasiFromDatabase);
	let dialogTambah = document.querySelector('.dialog-tambah');
	let dialogEdit = document.querySelector('.dialog-edit');
	let modalTambah = document.querySelector('.show-modal-tambah');
	let modalEdit = document.querySelectorAll('.show-modal-edit');
	
	if (! dialogTambah.showModal) {
		dialogPolyfill.registerDialog(dialogTambah);
	}
	
	if(! dialogEdit.showModal){
		dialogPolyfill.registerDialog(dialogEdit);
	}

	$(".show-modal-tambah").on('click',function () {
		let lokasiTambah = {lat: -7.271392714896101, lng: 112.73542550138382};
		let mapTambah = new google.maps.Map(document.getElementById('add-map'), {
			zoom: 8,
			center: lokasiTambah,
			draggableCursor: 'default',
			draggingCursor: 'pointer',
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		google.maps.event.addListener(mapTambah,'click', function(event){
			let locationClicked = event.latLng;
			let markerTambah = new google.maps.Marker({
				position : locationClicked,
				map : mapTambah
			});
			
			if(isPusatKotaClicked == true){
				$("[name='P8-pusat-kota']").parent().addClass('is-dirty');
				$("[name='P8-pusat-kota']").text(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				$("[name='P8-pusat-kota']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				isPusatKotaClicked = false;
			}

			if(isPusatUkmClicked == true){
				$("[name='P8-pusat-ukm']").parent().addClass('is-dirty');
				$("[name='P8-pusat-ukm']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				isPusatUkmClicked = false;
			}

			if(isWilayahClicked == true){
				if($("[name='P8-wilayah']").val() != ''){
					$("[name='P8-wilayah']").parent().addClass('is-dirty');
					$("[name='P8-wilayah']").val($("[name='P8-wilayah']").val()+","+locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				}else{
					$("[name='P8-wilayah']").parent().addClass('is-dirty');
					$("[name='P8-wilayah']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				}
			}
		})
		dialogTambah.showModal();
	});
	
    dialogTambah.querySelector('.close-tambah').addEventListener('click', function() {
    	dialogTambah.close();
	});
	

	$("#table-body-data").on('click','.show-modal-edit', function () {
		let id = $(this).data("id");
		$.ajax({
			type: "POST",
			url: base_url+'lihat/editMapP8',
			data: {'id':id},
			dataType: "JSON",
			success: function (response) {
				response = response[0];
				let lokasiPusatKota = response.pusat_kota.replace('POINT(','');
				lokasiPusatKota = lokasiPusatKota.replace(')','');
				let lokasiPusatUkm = response.pusat_ukm.replace('POINT(','');
				lokasiPusatUkm = lokasiPusatUkm.replace(')','');
				let lokasiWilayah = response.plain_wilayah.replace('MULTIPOINT(','');
				/**
				 * untuk yang pake mysql versi 5.7, karena astext deprecated,
				 * dan komposisi ST_AsWKT atau ST_AsText untuk multipoint berbeda
				 * dengan yang versi 5.7 kebawah
				 */
				lokasiWilayah = lokasiWilayah.replace(/\(/g,"");
				lokasiWilayah = lokasiWilayah.replace(/\)/g,"");
				$("[name='P8-id-edit']").val(response.id);
				$("[name='P8-kode-kabupaten-edit']").val(response.kode_kabupaten);
				$("[name='P8-kode-kabupaten-edit']").parent().addClass('is-dirty');
				$("[name='P8-nama-kabupaten-edit']").val(response.nama_kabupaten);
				$("[name='P8-nama-kabupaten-edit']").parent().addClass('is-dirty');
				$("[name='P8-nama-bupati-edit']").val(response.nama_bupati);
				$("[name='P8-nama-bupati-edit']").parent().addClass('is-dirty');
				$("[name='P8-jumlah-penduduk-edit']").val(response.jumlah_penduduk);
				$("[name='P8-jumlah-penduduk-edit']").parent().addClass('is-dirty');
				$("[name='P8-jumlah-ukm-edit']").val(response.jumlah_ukm);
				$("[name='P8-jumlah-ukm-edit']").parent().addClass('is-dirty');
				$("[name='P8-pusat-kota-edit']").val(lokasiPusatKota);
				$("[name='P8-pusat-kota-edit']").parent().addClass('is-dirty');
				$("[name='P8-pusat-ukm-edit']").val(lokasiPusatUkm);
				$("[name='P8-pusat-ukm-edit']").parent().addClass('is-dirty');
				$("[name='P8-wilayah-edit']").val(lokasiWilayah);
				$("[name='P8-wilayah-edit']").parent().addClass('is-dirty');
				lokasiPusatKota = lokasiPusatKota.split(' ');
				let isEditMode = false;
				let lokasiEdit = {lat: parseFloat(lokasiPusatKota[0]), lng: parseFloat(lokasiPusatKota[1])};
				let mapEdit = new google.maps.Map(document.getElementById('edit-map'), {
					zoom: 8,
					center: lokasiEdit,
					draggableCursor: 'default',
					draggingCursor: 'pointer',
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});

				google.maps.event.addListener(mapEdit,'click', function(event){
					let locationEditClicked = event.latLng;
					console.log(isPusatKotaEditClicked,isPusatUkmEditClicked,isWilayahEditClicked);
					let markerEdit = new google.maps.Marker({
						position : locationEditClicked,
						map : mapEdit
					});
					
					if(isPusatKotaEditClicked == true){
						$("[name='P8-pusat-kota-edit']").parent().addClass('is-dirty');
						$("[name='P8-pusat-kota-edit']").text(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
						$("[name='P8-pusat-kota-edit']").val(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
						isPusatKotaEditClicked = false;
					}

					if(isPusatUkmEditClicked == true){
						$("[name='P8-pusat-ukm-edit']").parent().addClass('is-dirty');
						$("[name='P8-pusat-ukm-edit']").val(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
						isPusatUkmEditClicked = false;
					}

					if(isWilayahEditClicked == true){
						if($("[name='P8-wilayah-edit']").val() != ''){
							if(isEditMode == false){
								$("[name='P8-wilayah-edit']").parent().addClass('is-dirty');
								$("[name='P8-wilayah-edit']").val('');	
								isEditMode = true;
								$("[name='P8-wilayah-edit']").val(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
							}else{
								$("[name='P8-wilayah-edit']").parent().addClass('is-dirty');
								$("[name='P8-wilayah-edit']").val($("[name='P8-wilayah-edit']").val()+","+locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
							}
						}else{
							$("[name='P8-wilayah-edit']").parent().addClass('is-dirty');
							$("[name='P8-wilayah-edit']").val(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
						}
					}
				});
			}
		});
		dialogEdit.showModal();
	});
	// 

	dialogEdit.querySelector('.close-edit').addEventListener('click', function () {  
		dialogEdit.close();
	})

	$("[name='P8-pusat-kota']").on('click', function () {
		if(isPusatKotaClicked == false){
			isPusatKotaClicked = true;
		}
	});

	$("[name='P8-pusat-ukm']").on('click', function () {
		if(isPusatUkmClicked == false){
			isPusatUkmClicked = true;
		}
	});

	$("[name='P8-wilayah']").on('click', function () {
		if(isWilayahClicked == false){
			isWilayahClicked = true;
		}
	});

	$("[name='P8-pusat-kota-edit']").on('click', function () {
		if(isPusatKotaEditClicked == false){
			isPusatKotaEditClicked = true;
		}
	});

	$("[name='P8-pusat-ukm-edit']").on('click', function () {
		if(isPusatUkmEditClicked == false){
			isPusatUkmEditClicked = true;
		}
	});

	$("[name='P8-wilayah-edit']").on('click', function () {
		if(isWilayahEditClicked == false){
			isWilayahEditClicked = true;
		}
	});

	$("#simpan-data").on('click', function () {
        $.ajax({
            type: "POST",
            url: base_url+'lihat/saveMapP8',
            data: $("#form-tambah-data").serialize(),
            dataType: "JSON",
            success: function (response) {
				dialogTambah.close();
                if(response.status == true){
                    swal({
                        title:'Success',
                        text:'Data Tersimpan',
                        type:'success', 
                        showCancelButton:false,
                        showConfirmButton:false, 
                        allowOutsideClick:false, 
                        timer:1500
                    }).then(function(){
						let lokasiFromDatabase = response.data;
						console.log(lokasiFromDatabase);
						initTable('table-body-data',lokasiFromDatabase);
						initMap('map',lokasiFromDatabase);
						isPusatUkmClicked = isPusatKotaClicked = isWilayahClicked = isPusatUkmEditClicked = isPusatKotaEditClicked = isWilayahEditClicked = false;
                    });
                }else{
                    swal('error','Data tidak boleh kosong','error');
                }
            }
        });
	});

	$("#simpan-edit-data").on('click', function () {
        $.ajax({
            type: "POST",
            url: base_url+'lihat/updateMapP8',
            data: $("#form-edit-data").serialize(),
            dataType: "JSON",
            success: function (response) {
                if(response.status == true){
					dialogEdit.close();
                    swal({
                        title:'Success',
                        text:'Data Tersimpan',
                        type:'success', 
                        showCancelButton:false,
                        showConfirmButton:false, 
                        allowOutsideClick:false, 
                        timer:1500
                    }).then(function(){
						let lokasiFromDatabase = response.data;
						initTable('table-body-data',lokasiFromDatabase);
						initMap('map',lokasiFromDatabase);
						isPusatUkmClicked = isPusatKotaClicked = isWilayahClicked = isPusatUkmEditClicked = isPusatKotaEditClicked = isWilayahEditClicked = false;
                    });
                }else{
                    swal('error','Data tidak boleh kosong','error');
                }
            }
        });
	});
	
	$("#table-body-data").on('click','.delete-data', function () {
        let id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: base_url+'lihat/deleteMapP8',
            data: {'id':id},
            dataType: "JSON",
            success: function (response) {
                if(response.status == true){
                    swal({
                        title:'Success',
                        text:'Data Terhapus',
                        type:'success', 
                        showCancelButton:false,
                        showConfirmButton:false, 
                        allowOutsideClick:false, 
                        timer:1500
                    }).then(function(){
						let lokasiFromDatabase = response.data;
						console.log(lokasiFromDatabase);
						initTable('table-body-data',lokasiFromDatabase);
                        initMap('map',lokasiFromDatabase);
                    });
                }
            }
        });
	});

	$("#cari-data").on('click', function () {
		$.ajax({
			type: "POST",
			url: base_url+'lihat/searchMapP8',
			data: {'id':$("[name=field-cari]").val()},
			dataType: "JSON",
			success: function (response) {
				initMap('map',response);
			}
		});
	});

	$("#field-cari-data").keyup(function (event) {
		event.preventDefault();
		if(event.which === 13){
			console.log($("[name=field-cari]").val());
			$("#cari-data").trigger('click');
		}
	});

});
