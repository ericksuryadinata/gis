<?php
$row['h'] = 'Sumber Sari';
$exp = explode(' ',$row['h']); //$exp[0] = 'Sumber' $exp[1] = 'Sari'
$singkat = '';
$data = [];

foreach($exp as $ambil){
	$singkat .= substr($ambil,0,1); //$singkat = SS
	array_push($data,$singkat); //kalo array push disini hasilnya 
}

print_r($data); // disini akan jadi array('S','S') kalo array_push di foreach

array_push($data,$singkat); // kalau gak pake hasilnya disini
print_r($data); // hasil array ('SS')
?>
