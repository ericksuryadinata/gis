<?php
$data = array('sending_respon'=>array(array('globalstatus'=>10,'globalstatustext'=>'success','datapacket'=>array(array('packet'=>array('number'=>'6281351673282','sending_id'=>42126,'sendingstatus'=>10,'sendingstatustext'=>'success'))))));
$hx = json_encode($data);
//echo $hx.'<br>';
// $yx = json_decode($hx);
// echo $yx.'<br>';
echo $hx;
?>