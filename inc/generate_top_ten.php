<?php
require 'dbconnect.inc.php';
require 'handle_data.php';

$count_list = array();
$result1 = mysql_query("SELECT * from country");
$list_of_countries = mysql_fetch_assoc($result1);
while($row = mysql_fetch_assoc($result1)) {
    $country = $row['nicename'];
    $country = $row['nicename'];
    $where_query = " WHERE `MC`='$country'";
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
          $where_query .= " AND `EP Background in primary field of work` LIKE '%$background%'";
        } else {
          $where_query .= " AND (`EP Background in primary field of work` LIKE '%$background%' OR `EP Background in secondary field of work` LIKE '%$background%')";
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
		for ($i=0; $i < 20 ; $i++) { 
			echo '<tr>';
			echo '<td>'.$count_list[$i]['country'].'</td>';
			echo '<td>'.$count_list[$i]['count'].'</td>';
			echo '</tr>';
		}

	?>
</table>