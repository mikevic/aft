<?php
require 'dbconnect.inc.php';
require 'handle_data.php';

$count_list = array();
$where_query = " WHERE `LC`='$lc'";
if($x_type != 'unset'){
  $where_query .= " AND `Exchange Type` LIKE '%$x_type%'";
}
if($primary_bg != 'unset'){
  $where_query .= " AND `primary background` LIKE '%$primary_bg%'";
}
if($secondary_bg != 'unset'){
  $where_query .= " AND `secondary background` LIKE '%$secondary_bg%'";
}
$query = "SELECT * FROM `$type`".$where_query;
$result = mysql_query($query);
if($type == 'ep'){
?>
<table class="table table-striped">
	<tr>
		<th>EP Name</th>
		<th>EP ID</th>
		<th>EP Raise Data</th>
		<th>Link</th>
	</tr>

<?php
	while($row = mysql_fetch_assoc($result)){
		echo '<tr>';
		echo '<td>'.$row['First Name and Last Name of EP'].'</td>';
		echo '<td>'.$row['EP ID'].'</td>';
		echo '<td>'.$row['EP Raised Date'].'</td>';
		echo '<td><a href="'.$row['EP Link'].'" target="_blank"><img src="img/raw_data.png" width="16px"></a>';
		echo '</tr>';
	}
} else {
	while($row = mysql_fetch_assoc($result)){
		
	}
}
?>
</table>