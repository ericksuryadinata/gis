let isPusatUkmClicked = isPusatKotaClicked = isWilayahClicked = isPusatUkmEditClicked = isPusatKotaEditClicked = isWilayahEditClicked = false;

function initMap(destination, lokasiFromDatabase){
	let lokasi = {lat: -7.271392714896101, lng: 112.73542550138382};
	let lokasiPusatKota, lokasiPusatUkm;
    let map = new google.maps.Map(document.getElementById(destination), {
        zoom: 8,
        center: lokasi,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	console.log(lokasiFromDatabase);
	let koordinatFromDatabase = [];
    $.each(lokasiFromDatabase, function (i, v) { 
        koordinatFromDatabase.push([]);
        lokasi = v.plain_wilayah.replace('MULTIPOINT(','');
        lokasi = lokasi.replace(')','');
		lokasi = lokasi.split(',');
		lokasiPusatKota = v.pusat_kota.replace('POINT(','');
		lokasiPusatKota = lokasiPusatKota.replace(')','');
		lokasiPusatKota = lokasiPusatKota.split(' ');

		let markerPusatKota = new google.maps.Marker({
			position  : new google.maps.LatLng(parseFloat(lokasiPusatKota[0]),parseFloat(lokasiPusatKota[1])),
			map       : map,
			draggable : true
		});
		// koordinatFromDatabase[i].push(lokasi);
		for (let index = 0; index < lokasi.length; index++) {
			let kumpulanPoint = lokasi[index].split(' ');
			koordinatFromDatabase[i].push(new google.maps.LatLng(parseFloat(kumpulanPoint[0]),parseFloat(kumpulanPoint[1])));
		}

	});

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
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++) {
	  color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}

function createTerritory(event){

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

    modalTambah.addEventListener('click', function() {
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
			let marketTambah = new google.maps.Marker({
				position : locationClicked,
				map : mapTambah
			});
			if(isPusatKotaClicked == true){
				$("[name='p6-pusat-kota']").parent().addClass('is-dirty');
				$("[name='p6-pusat-kota']").text(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				$("[name='p6-pusat-kota']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				isPusatKotaClicked = false;
			}

			if(isPusatUkmClicked == true){
				$("[name='p6-pusat-ukm']").parent().addClass('is-dirty');
				$("[name='p6-pusat-ukm']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				isPusatUkmClicked = false;
			}

			if(isWilayahClicked == true){
				if($("[name='p6-wilayah']").val() != ''){
					$("[name='p6-wilayah']").parent().addClass('is-dirty');
					$("[name='p6-wilayah']").val($("[name='p6-wilayah']").val()+","+locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				}else{
					$("[name='p6-wilayah']").parent().addClass('is-dirty');
					$("[name='p6-wilayah']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
				}
			}
		})
		dialogTambah.showModal();

	});
	
    dialogTambah.querySelector('.close-tambah').addEventListener('click', function() {
    	dialogTambah.close();
	});
	
	modalEdit.forEach(function (modal) {  
		modal.addEventListener('click', function() {
			let id = $(this).data("id");
			$.ajax({
				type: "POST",
				url: base_url+'lihat/editMapP6',
				data: {'id':id},
				dataType: "JSON",
				success: function (response) {
					initMap('edit-map',response);
					response = response[0];
					let lokasiPusatKota = response.pusat_kota.replace('POINT(','');
					lokasiPusatKota = lokasiPusatKota.replace(')','');
					let lokasiPusatUkm = response.pusat_ukm.replace('POINT(','');
					lokasiPusatUkm = lokasiPusatUkm.replace(')','');
					let lokasiWilayah = response.plain_wilayah.replace('MULTIPOINT(','');
					lokasiWilayah = lokasiWilayah.replace(')','');
					$("[name='p6-id-edit']").val(response.id);
					$("[name='p6-kode-kabupaten-edit']").val(response.kode_kabupaten);
					$("[name='p6-kode-kabupaten-edit']").parent().addClass('is-dirty');
					$("[name='p6-nama-kabupaten-edit']").val(response.nama_kabupaten);
					$("[name='p6-nama-kabupaten-edit']").parent().addClass('is-dirty');
					$("[name='p6-nama-bupati-edit']").val(response.nama_bupati);
					$("[name='p6-nama-bupati-edit']").parent().addClass('is-dirty');
					$("[name='p6-jumlah-penduduk-edit']").val(response.jumlah_penduduk);
					$("[name='p6-jumlah-penduduk-edit']").parent().addClass('is-dirty');
					$("[name='p6-jumlah-ukm-edit']").val(response.jumlah_ukm);
					$("[name='p6-jumlah-ukm-edit']").parent().addClass('is-dirty');
					$("[name='p6-pusat-kota-edit']").val(lokasiPusatKota);
					$("[name='p6-pusat-kota-edit']").parent().addClass('is-dirty');
					$("[name='p6-pusat-ukm-edit']").val(lokasiPusatUkm);
					$("[name='p6-pusat-ukm-edit']").parent().addClass('is-dirty');
					$("[name='p6-wilayah-edit']").val(lokasiWilayah);
					$("[name='p6-wilayah-edit']").parent().addClass('is-dirty');
				}
			});
			dialogEdit.showModal();
		});
	});

	dialogEdit.querySelector('.close-edit').addEventListener('click', function () {  
		dialogEdit.close();
	})

	$("[name='p6-pusat-kota']").on('click', function () {
		if(isPusatKotaClicked == false){
			isPusatKotaClicked = true;
		}
	});

	$("[name='p6-pusat-ukm']").on('click', function () {
		if(isPusatUkmClicked == false){
			isPusatUkmClicked = true;
		}
	});

	$("[name='p6-wilayah']").on('click', function () {
		if(isWilayahClicked == false){
			isWilayahClicked = true;
		}
	});

	$("#simpan-data").on('click', function () {
        $.ajax({
            type: "POST",
            url: base_url+'lihat/saveMapP6',
            data: $("#form-tambah-data").serialize(),
            dataType: "JSON",
            success: function (response) {
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
						dialogTambah.close();
                        location.reload();
                    });
                }else{
                    swal('error','Data tidak boleh kosong','error');
                }
            }
        });
	});
	
	$(".delete-data").on('click', function () {
        let id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: base_url+'lihat/deleteMapP6',
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
                        location.reload();
                    });
                }
            }
        });
	});

});
