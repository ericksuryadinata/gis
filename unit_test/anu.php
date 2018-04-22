<?php
	function createArrayMultipoint($arrayMultipoint){
		$value = '';
		for($i = 0; $i < count($arrayMultipoint); $i++){
			$_multipoint =explode(',',$arrayMultipoint[$i]);
			if($i == (count($arrayMultipoint) - 1)){
				$value .= $_multipoint[0].' '.$_multipoint[1];
			}else{
				$value .= $_multipoint[0].' '.$_multipoint[1].',';
			}
			
		}
		return $value;
	}

	$array = ['-7.257472,112.752088','-7.96662,112.632632','-7.848016,112.017829'];
	$hasil = createArrayMultipoint($array);
	$hasil = 'MULTIPOINT('.$hasil.')';
	var_dump($hasil);
?>
