<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GIS MAP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/front.css');?>" rel="stylesheet">
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo getenv('GMAPS_API_KEY')?>&callback=initMap">
    </script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="<?php echo base_url('main')?>">Back to Menu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
        <div class="space-div"></div>
        <h3 class="text-center">Peta Kediri 2018</h3>
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
</body>
<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url('assets/vendor/jquery/jquery.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
<script>
    let base_url = '<?php echo base_url();?>';
</script>
<!-- Custom scripts for this template -->
<script src="<?php echo base_url('assets/js/pertemuan_kedua.js');?>"></script>

</html>