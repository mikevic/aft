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

function generate_or_code($selection, $field_name, $search='false'){
	$counter = 1;
	$query = '';
	foreach ($selection as $option) {
		if($counter != 1){
			$query .= ' OR ';
		}
		if($search == 'search'){
			$option = '%'.$option.'%';
		}
		$query .= '`'.$field_name.'`'.' LIKE '.'\''.$option.'\'';
		$counter = $counter + 1;
	}
	return $query;
}

function generate_form_or_code($selection, $field_name, $search='false'){
	$counter = 1;
	$query = '';
	foreach ($selection as $option) {
		if($counter != 1){
			$query .= ' OR ';
		}
		if($search == 'search'){
			$option = '%'.$option.'%';
		}
		$query .= '`'.$field_name.'`'.' = '.'\''.$option.'\'';
		$counter = $counter + 1;
	}
	return $query;	
}

function is_selected($option, $selection){
	$selected = false;
	if($selection == 'unset'){
		return $selected;
	} else {
		foreach ($selection as $select_part) {
			if($option == $select_part){
				$selected = true;
			}
		}
		return $selected;
	}
}

function generate_multi_select_js($tag){
	$js = '<script>';
	$js .= '$(document).ready(function() { ';
	$js .= 'var $'.$tag.' = $(\'#'.$tag.'\').data(\'selectpicker\').$newElement;';
	$js .= '$'.$tag.'.on(\'hidden.bs.dropdown\', function() {';
	$js .= '$("#aft-header-form").submit();';
	$js .= '});});</script>';
	return $js;
}

function echocsv($fields)
{
    $separator = '';
    $csv = '';
    foreach ($fields as $field) {
        if (preg_match('/\\r|\\n|,|"/', $field)) {
            $field = '"' . str_replace('"', '""', $field) . '"';
        }
        $csv .= $separator . $field;
        $separator = ',';
    }
    $csv .= "\r\n";
    return $csv;
}

?>