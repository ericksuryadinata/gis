<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Geografis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/front.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/mdl/material.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('node_modules/dialog-polyfill/dialog-polyfill.css')?>">
    <link href="<?php echo base_url('assets/css/front.css');?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/vendor/mdl/material.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.js');?>"></script>
    <script src="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.js')?>"></script>
    <script src="<?php echo base_url('node_modules/dialog-polyfill/dialog-polyfill.js')?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo getenv('GMAPS_API_KEY')?>"></script>
    <script>
        let base_url = '<?php echo base_url();?>';
        let lokasiFromDatabase  = <?php echo json_encode($lokasi)?>;
    </script>
    <script src="<?php echo base_url('assets/js/pertemuan_lima.js')?>"></script>
</head>
<body onload="initMap()">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title">SISTEM INFORMASI GEOGRAFIS</span>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="<?php  echo base_url(); ?>">SISTEM INFORMASI GEOGRAFIS</a>
            <?php 
				foreach($materi as $key=>$value){
			?>
				<a class="mdl-navigation__link" href="<?php echo base_url('lihat/materi/'.$value->Link); ?>"><?php echo $value->Bab?></a>
			<?php
				}
			?>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="map-view" id="map"></div>
                    </div>
                </div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                        <button type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored" id="tambah-data"><i class="material-icons">add</i></button>
                        <form id="form-tambah-data" hidden>
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--2-col">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" type="text" id="p5-kode-lokasi" name="p5-kode-lokasi">
                                        <label class="mdl-textfield__label" for="Latitude">Kode Lokasi</label>
                                    </div>
                                </div>
                                <div class="mdl-cell mdl-cell--2-col">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" type="text" id="p5-nama-lokasi" name="p5-nama-lokasi">
                                        <label class="mdl-textfield__label" for="Latitude">Nama Lokasi</label>
                                    </div>
                                </div>
                                <div class="mdl-cell mdl-cell--2-col">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" type="text" id="p5-lat" name="p5-lat">
                                        <label class="mdl-textfield__label" for="Latitude">Latitude</label>
                                    </div>
                                </div>
                                <div class="mdl-cell mdl-cell--2-col">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" type="text" id="p5-long" name="p5-long">
                                        <label class="mdl-textfield__label" for="Longitude">Longitude</label>
                                    </div>                  
                                </div>
                                <div class="mdl-cell mdl-cell--2-col mdl-textfield">
                                    <input value="tambah" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="simpan-data">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                            <thead>
                                <tr>
                                    <th>kode lokasi</th>
                                    <th>nama lokasi</th>
                                    <th>lokasi</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($lokasi as $key=>$lokasi){
                                        echo "<tr>";
                                        echo "<td>".$lokasi['kode_lokasi']."</td>";
                                        echo "<td>".$lokasi['nama_lokasi']."</td>";
                                        echo "<td>".$lokasi['plain_lokasi']."</td>";
                                        echo '<td><a href="javascript:void(0)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored edit-data" id="edit-data" data-id='.$lokasi['id'].'>Edit</a>
                                        <a href="javascript:void(0)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored delete-data" id="delete-data" data-id='.$lokasi['id'].'>Delete</a></td>';
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <form id="form-edit-data" hidden>
                            <div class="mdl-grid">
                                <h4>Edit Data</h4>
                            </div>
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--2-col">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" type="text" id="p5-kode-lokasi" name="p5-kode-lokasi-edit">
                                        <label class="mdl-textfield__label" for="Latitude">Kode Lokasi</label>
                                    </div>
                                </div>
                                <div class="mdl-cell mdl-cell--2-col">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" type="text" id="p5-nama-lokasi" name="p5-nama-lokasi-edit">
                                        <label class="mdl-textfield__label" for="Latitude">Nama Lokasi</label>
                                    </div>
                                </div>
                                <div class="mdl-cell mdl-cell--2-col">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" type="text" id="p5-lat" name="p5-lat-edit">
                                        <label class="mdl-textfield__label" for="Latitude">Latitude</label>
                                    </div>
                                </div>
                                <div class="mdl-cell mdl-cell--2-col">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <input class="mdl-textfield__input" type="text" id="p5-long" name="p5-long-edit">
                                        <label class="mdl-textfield__label" for="Longitude">Longitude</label>
                                    </div>                  
                                </div>
                                <input type="text" name="p5-id-edit" hidden>
                                <div class="mdl-cell mdl-cell--1-col mdl-textfield">
                                    <input value="update" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="update-data">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
