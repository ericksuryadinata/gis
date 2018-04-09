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
</head>
<body>
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
				<?php 
					foreach($materi as $key=>$value){
				?>
					<div class="mdl-cell mdl-cell--4-col">
                        <div class="card-main__container card-main__img--<?php echo $value->Link;?> mdl-card mdl-shadow--4dp">
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text"><?php echo $value->Bab;?></h2>
                            </div>
                            <div class="mdl-card__supporting-text">
								<?php echo $value->Materi;?>
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <a href="<?php echo base_url('lihat/materi/'.$value->Link);?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Menuju Materi</a>
                            </div>
                        </div>
                    </div>
				<?php
					}
				?>
                </div>
            </div>
        </main>
    </div>
</body>
<script src="<?php echo base_url('assets/vendor/jquery/jquery.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/mdl/material.min.js')?>"></script>
<script>
    let base_url = '<?php echo base_url();?>';
</script>

</html>
