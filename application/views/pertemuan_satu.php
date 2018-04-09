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
	<script src="<?php echo base_url('assets/vendor/jquery/jquery.js');?>"></script>
	<script src="<?php echo base_url('assets/vendor/mdl/material.min.js')?>"></script>
	<script>
		let base_url = '<?php echo base_url();?>';
	</script>
</head>
<body>
    <div class="gis-layout mdl-layout mdl-js-layout mdl-layout--fixed-header">
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
					<div class="gis-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
						<h3>Tentang Materi</h3>
						<p>Disini akan dijelaskan tentang penggunaan Google Maps dengan Codeigniter</p>
						<p>Pembahasan disini akan dijelaskan secara hardcode sesuai dengan code yang ditulis di <code class="mdl-color-text--red-800">folder</code> yang telah didownload</p>
						<h3>Materi yang di cover</h3>
						<ul>
						<?php
							foreach($materi as $key=>$value){
						?>
							<li><?php echo $value->Materi?></li>
						<?php
							}
						?>
						</ul>
						<a href="<?php echo base_url('lihat/materi/pertemuan_dua')?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
						Materi Selanjutnya
						</a>
          			</div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
