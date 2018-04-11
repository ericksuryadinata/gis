function initMap(){
    let lokasi = {lat: -7.271392714896101, lng: 112.73542550138382};
    let map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: lokasi,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    let koordinatFromDatabase = [];
    $.each(lokasiFromDatabase, function (i, v) { 
        koordinatFromDatabase.push([]);
        lokasi = v.plain_lokasi.replace(' ',', ');
        lokasi = lokasi.replace('POINT(','');
        lokasi = lokasi.replace(')','');
        lokasi = lokasi.split(',');
        koordinatFromDatabase[i].push(lokasi[0],lokasi[1]);
    });
    $.each(koordinatFromDatabase, function (i, v) { 
        var lokasiMaps = new google.maps.LatLng(parseFloat(v[0]),parseFloat(v[1]));
        let marker = new google.maps.Marker({
            position  : lokasiMaps,
            map       : map
        });  
    });
}

function toggleBounce(marker) {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

$(document).ready(function () {
    $("#tambah-data").on('click', function () {
        $("#form-tambah-data").attr("hidden",false);
        $("#form-edit-data").attr("hidden",true);
    });

    $("#simpan-data").on('click', function () {
        $.ajax({
            type: "POST",
            url: base_url+'lihat/saveMapP5',
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
                        location.reload();
                    });
                }else{
                    swal('error','Data tidak boleh kosong','error');
                }
            }
        });
    });

    $(".edit-data").on('click', function () {
        $("#form-edit-data").attr("hidden",false);
        $("#form-tambah-data").attr("hidden",true);
        id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: base_url+'lihat/editMapP5',
            data: {'id':id},
            dataType: "JSON",
            success: function (response) {
                response = response[0];
                $("[name='p5-id-edit']").val(response.id);
                $("[name='p5-kode-lokasi-edit']").val(response.kode_lokasi);
                $("[name='p5-kode-lokasi-edit']").parent().addClass('is-dirty');
                $("[name='p5-nama-lokasi-edit']").val(response.nama_lokasi);
                $("[name='p5-nama-lokasi-edit']").parent().addClass('is-dirty');
                lokasi = response.plain_lokasi.replace('POINT(','');
                lokasi = lokasi.replace(')','');
                lokasi = lokasi.split(' ');
                $("[name='p5-lat-edit']").val(lokasi[0]);
                $("[name='p5-lat-edit']").parent().addClass('is-dirty');
                $("[name='p5-long-edit']").val(lokasi[1]);
                $("[name='p5-long-edit']").parent().addClass('is-dirty');
            }
        });
    });

    $("#update-data").on('click', function () {
        $.ajax({
            type: "POST",
            url: base_url+'lihat/updateMapP5',
            data: $("#form-edit-data").serialize(),
            dataType: "JSON",
            success: function (response) {
                if(response.status == true){
                    swal({
                        title:'Success',
                        text:'Data Terupdate',
                        type:'success', 
                        showCancelButton:false,
                        showConfirmButton:false, 
                        allowOutsideClick:false, 
                        timer:1500
                    }).then(function(){
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
            url: base_url+'lihat/deleteMapP5',
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
