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
	$master_issue = 'unset';
	$sub_issue = 'unset';

	//Handling FOW Selection
	if(isset($_POST['field-of-work']) && !empty($_POST['field-of-work'])){
		$fow = $_POST['field-of-work'];
	} else {
		$fow = 'unset';
	}

	//Handling Primary & Secondary Backgrounds
	if(isset($_POST['primary-secondary']) && !empty($_POST['primary-secondary'])){
		$search_scope = $_POST['primary-secondary'];
	} else {
		$search_scope = 'unset';
	}

	//Handling Backgrounds
	if(isset($_POST['background']) && !empty($_POST['background'])){
		$background = $_POST['background'];
	} else {
		$background = 'unset';
	}
} elseif ($x_type == 'Global Community Development'){
	$fow = 'unset';
	$search_scope = 'unset';

	//Handling Master Issue
	if(isset($_POST['master-issue']) && !empty($_POST['master-issue'])){
		$master_issue = $_POST['master-issue'];
	} else {
		$master_issue = 'unset';
	}

	//Handling Master Issue
	if(isset($_POST['sub-issue']) && !empty($_POST['sub-issue'])){
		$sub_issue = $_POST['sub-issue'];
	} else {
		$sub_issue = 'unset';
	}
} else {
	$fow = 'unset';
	$search_scope = 'unset';
	$master_issue = 'unset';
	$sub_issue = 'unset';
	$background = 'unset';
}

//Handling Skills
if(isset($_POST['skills']) && !empty($_POST['skills'])){
	$skills = $_POST['skills'];
} else {
	$skills = 'unset';
}

//Handling Country
if(isset($_POST['country']) && !empty($_POST['country'])){
	$country = strtoupper($_POST['country']);
} else {
	$country = 'unset';
}

//Handling LC
if(isset($_POST['lc']) && !empty($_POST['lc'])){
	$lc = $_POST['lc'];
} else {
	$lc = 'unset';
}

//Handling Duration
if(isset($_POST['duration']) && !empty($_POST['duration'])){
	$duration = $_POST['duration'];
} else {
	$duration = 'unset';
}

//Handling Region
if(isset($_POST['region']) && !empty($_POST['region'])){
	$region = $_POST['region'];
} else {
	$region = 'world';
}

//Handling Start Date
if(isset($_POST['startdate']) && !empty($_POST['startdate'])){
	$startdate = $_POST['startdate'];
} else {
	$startdate = 'unset';
}

//Handling End Date
if(isset($_POST['enddate']) && !empty($_POST['enddate'])){
	$enddate = $_POST['enddate'];
} else {
	$enddate = 'unset';
}

?>