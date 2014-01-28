<?php
//Handling Table Type
if(isset($_POST['table_type']) && !empty($_POST['table_type'])){
	$type = $_POST['table_type'];
} else {
	$type = 'ep';
}
if($type == 'ep'){
	$type_diplay = "EPs";
} else {
	$type_diplay = "TNs";
}

//Handling Exchange Type
if(isset($_POST['xtype']) && !empty($_POST['xtype'])){
	$x_type = $_POST['xtype'];
} else {
	$x_type = 'unset';
}

if($x_type == 'Global Internship'){

	//Handling Primary Background
	if(isset($_POST['primary-background']) && !empty($_POST['primary-background'])){
		$primary_bg = $_POST['primary-background'];
	} else {
		$primary_bg = 'unset';
	}

	//Handling Secondary Background
	if(isset($_POST['secondary-background']) && !empty($_POST['secondary-background'])){
	$secondary_bg = $_POST['secondary-background'];
	} else {
	$secondary_bg = 'unset';
	}

} else {
	$primary_bg = 'unset';
	$secondary_bg = 'unset';
}

//Handling Country
if(isset($_POST['country']) && !empty($_POST['country'])){
	$country = $_POST['country'];
} else {
	$country = 'unset';
}

//Handling LC
if(isset($_POST['lc']) && !empty($_POST['lc'])){
	$lc = $_POST['lc'];
} else {
	$lc = 'unset';
}

?>