<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Geography Information Systems</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.css');?>">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/front.css');?>" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Pertemuan Pertama
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Membuat API key</h5>
                        <p class="card-text">Memasukkan API KEY kedalam google maps API</p>
                        <a href="<?php echo base_url('main/pertemuan_pertama')?>" class="btn btn-primary">GO !!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Pertemuan Kedua
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Wait a minutes</h5>
                        <p class="card-text">The definition not ready yet</p>
                        <a href="<?php echo base_url('main/pertemuan_kedua')?>" class="btn btn-primary">GO !!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url('assets/vendor/jquery/jquery.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/extensions/pdfmake/pdfmake.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/extensions/pdfmake/vfs_fonts.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.js ');?>"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
<script>
    let base_url = '<?php echo base_url();?>';
</script>
<!-- Custom scripts for this template -->
<script src="<?php echo base_url('assets/js/loader.js');?>"></script>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<script src="<?php echo base_url('assets/js/sc.js');?>"></script>

</html>