<?php
require 'dbconnect.inc.php';
require 'handle_data.php';

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