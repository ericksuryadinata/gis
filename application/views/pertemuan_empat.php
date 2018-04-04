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
    <link href="<?php echo base_url('assets/css/front.css');?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/vendor/mdl/material.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.js');?>"></script>
    <script src="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.js')?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo getenv('GMAPS_API_KEY')?>"></script>
    <script>let base_url = '<?php echo base_url();?>';</script>
    <script src="<?php echo base_url('assets/js/pertemuan_empat.js')?>"></script>
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
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_satu'); ?>">PERTEMUAN SATU</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_dua'); ?>">PERTEMUAN DUA</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_tiga'); ?>">PERTEMUAN TIGA</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_empat'); ?>">PERTEMUAN EMPAT</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_lima'); ?>">PERTEMUAN LIMA</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_enam'); ?>">PERTEMUAN ENAM</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_tujuh'); ?>">PERTEMUAN TUJUH</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_delapan'); ?>">PERTEMUAN DELAPAN</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_sembilan'); ?>">PERTEMUAN SEMBILAN</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_sepuluh'); ?>">PERTEMUAN SEPULUH</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_sebelas'); ?>">PERTEMUAN SEBELAS</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_duabelas'); ?>">PERTEMUAN DUABELAS</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_tigabelas'); ?>">PERTEMUAN TIGABELAS</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_empatbelas'); ?>">PERTEMUAN EMPATBELAS</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_limabelas'); ?>">PERTEMUAN LIMABELAS</a>
                <a class="mdl-navigation__link" href="<?php  echo base_url('main/pertemuan_enambelas'); ?>">PERTEMUAN ENAMBELAS</a>
            </nav>
        </div>

        <main class="mdl-layout__content">
            <div class="page-content">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="map-view" id="map"></div>
                        <div>
                            <label for="lat">Lat</label>
                            <input type="text" name="p2-lat">
                            <label for="long">Long</label>
                            <input type="text" name="p2-long">
                            <label for="long">Zoom</label>
                            <input type="text" name="p2-zoom">
                            <input type="submit" value="refresh" id="refresh1">
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>