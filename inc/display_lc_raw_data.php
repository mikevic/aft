<?php
require 'dbconnect.inc.php';
require 'handle_data.php';
require 'functions.inc.php';

$count_list = array();
$where_query = " WHERE `LC`='$lc'";
require 'process_data.php';
$query = "SELECT * FROM `$type`".$where_query;
$result = mysql_query($query);
?>
<table class="table table-striped">
<?php
if($type == 'ep'){
?>
	<tr>
		<th>EP Name</th>
		<th>EP ID</th>
		<th>EP Raise Data</th>
		<th>Link</th>
	</tr>

<?php
	while($row = mysql_fetch_assoc($result)){
		echo '<tr>';
		echo '<td>'.$row['Name'].'</td>';
		echo '<td>'.$row['EP ID'].'</td>';
		echo '<td>'.$row['EP Raise Date'].'</td>';
		echo '<td><a href="'.$row['Link'].'" target="_blank"><img src="img/raw_data.png" width="16px"></a>';
		echo '</tr>';
	}
} else {
?>
	<tr>
		<th>Name</th>
		<th>TN ID</th>
		<th>TN Raise Data</th>
		<th>Link</th>
	</tr>
<?php

	while($row = mysql_fetch_assoc($result)){
		echo '<tr>';
		echo '<td>'.$row['Organization Name'].'</td>';
		echo '<td>'.$row['TN Code'].'</td>';
		echo '<td>'.$row['TN Raise Date'].'</td>';
		echo '<td><a href="'.$row['Link'].'" target="_blank"><img src="img/raw_data.png" width="16px"></a>';
		echo '</tr>';
		
	}
}
?>
</table>