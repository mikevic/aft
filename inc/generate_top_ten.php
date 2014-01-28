<?php
require 'dbconnect.inc.php';

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

$count_list = array();
$result1 = mysql_query("SELECT * from country");
$list_of_countries = mysql_fetch_assoc($result1);
while($row = mysql_fetch_assoc($result1)) {
    $country = $row['nicename'];
    $where_query = " WHERE `MC`='$country'";
    if($x_type != 'unset'){
      $where_query .= " AND `Exchange Type` LIKE '%$x_type%'";
    }
    if($primary_bg != 'unset'){
      $where_query .= " AND `primary background` LIKE '%$primary_bg%'";
    }
    if($secondary_bg != 'unset'){
      $where_query .= " AND `secondary background` LIKE '%$secondary_bg%'";
    }
    $query = "SELECT COUNT(entry_id) AS entries FROM `$type`".$where_query;
    $result2 = mysql_query($query);
    $ep_data = mysql_fetch_assoc($result2);
    $count = $ep_data['entries'];
    $count_array = array(
    	'country' => $country,
    	'count' => $count
    	);
   	array_push($count_list, $count_array);
}

usort($count_list, function($a, $b) {
    return $b['count'] - $a['count'];
});
?>
<table class="table table-striped">
	<tr>
		<th>Country</th>
		<th>Available Forms</th>
	</tr>
	<?php
		for ($i=0; $i < 10 ; $i++) { 
			echo '<tr>';
			echo '<td>'.$count_list[$i]['country'].'</td>';
			echo '<td>'.$count_list[$i]['count'].'</td>';
			echo '</tr>';
		}

	?>
</table>