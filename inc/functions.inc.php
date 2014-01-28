<?php
function format_lc_name($lc_name){
	str_replace('Aiesec', '', $lc_name);
	return strtoupper($lc_name);
}

?>