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
	<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo getenv('GMAPS_API_KEY')?>"></script>
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
						<div class="gis-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
							<h3>Tentang Materi</h3>
							<p>Pada bab ini akan dijelaskan dengan penggunaan Javascript API KEY</p>
							<p>Pembahasan disini akan dijelaskan secara hardcode sesuai dengan code yang ditulis di <code class="mdl-color-text--red-800">folder</code> yang telah didownload</p>
							<h3>Penggunaan Awal</h3>
							<a href="<?php echo base_url('lihat/materi/pertemuan_tiga')?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
							Materi Selanjutnya
							</a>
          				</div>
                        <div class="map-view" id="map"></div>
						<div class="mdl-grid">
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p2-lat" name="p2-lat">
									<label class="mdl-textfield__label" for="Latitude">Latitude</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p2-long" name="p2-long">
									<label class="mdl-textfield__label" for="Longitude">Longitude</label>
								</div>                  
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p2-zoom" name="p2-zoom">
									<label class="mdl-textfield__label" for="Longitude">Zoom</label>
								</div>                  
							</div>
							<div class="mdl-cell mdl-cell--2-col mdl-textfield">
								<a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="p2-refresh">Refresh</a>
							</div>
						</div>
					</div>
                </div>
            </div>
        </main>
    </div>
</body>
<script src="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.js')?>"></script>
<script>
	let base_url = '<?php echo base_url();?>';
</script>
<script src="<?php echo base_url('assets/js/pertemuan_dua.js')?>"></script>
</html>
