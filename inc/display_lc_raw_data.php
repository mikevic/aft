<?php
require 'dbconnect.inc.php';
require 'handle_data.php';

$count_list = array();
$where_query = " WHERE `LC`='$lc'";
if($x_type != 'unset'){
$where_query .= " AND `Exchange Type` LIKE '%$x_type%'";
}
if($fow != 'unset'){
  if($search_scope != 'primary-secondary'){
    $where_query .= " AND `primary fow` LIKE '%$fow%'";
  } else {
    $where_query .= " AND (`primary fow` LIKE '%$fow%' OR `secondary fow` LIKE '%$fow%')";
  }
  if($background != 'unset'){
    if($search_scope != 'primary-secondary'){
      $where_query .= " AND `Background in primary field of work` LIKE '%$background%'";
    } else {
      $where_query .= " AND (`Background in primary field of work` LIKE '%$background%' OR `Background in secondary field of work` LIKE '%$background%')";
    }
  }
}
if($master_issue != 'unset'){
$where_query .= " AND `Master Issues` LIKE '%$master_issue%'";
}
if($sub_issue != 'unset'){
$where_query .= " AND `Sub Issues` LIKE '%$sub_issue%'";
}
if($duration != 'unset'){
switch ($duration) {
case '1':
   $duration_start = 2419200;
   $duration_end = 4838400;
  break;

case '2':
   $duration_start = 4838400;
   $duration_end = 7257600;
  break;

case '3':
   $duration_start = 7257600;
   $duration_end = 14515200;
  break;

case '4':
   $duration_start = 14515200;
   $duration_end = 31449600;
  break;

case '5':
   $duration_start = 31449600;
   $duration_end = 1391006006;
  break;

default:
  # code...
  break;
}
$where_query .= " AND ((`Latest End Date` -  `Earliest Start Date`) > $duration_start AND (`Latest End Date` - `Earliest Start Date`) < $duration_end)";
}
    if($startdate != 'unset' && $enddate != 'unset'){
      $sd_ts = strtotime($startdate);
      $ed_ts = strtotime($enddate);
      $where_query .= " AND (`Earliest Start Date` > $sd_ts AND `Latest End Date` < $ed_ts)";
    }
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