<?php
function format_lc_name($lc_name){
	str_replace('Aiesec', '', $lc_name);
	return strtoupper($lc_name);
}

function format_country_name($county){
	switch ($county) {
		case 'China':
			return 'Mainland of China';
			break;
		
		default:
			return $county;
			break;
	}
}

?>