<?php
require 'functions.inc.php';
require 'dbconnect.inc.php';
require 'handle_data.php';

$query2 = "SELECT DISTINCT `LC` from `$type` WHERE `MC`='$country'";
$result1 = mysql_query($query2);
$count_list = array();
while($row = mysql_fetch_assoc($result1)) {
    $lc = $row['LC'];
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
    if($count != 0){
	    $count_array = array(
			'lc' => $lc,
			'count' => $count
			);
	    array_push($count_list, $count_array);
	}
}
usort($count_list, function($a, $b) {
    return $b['count'] - $a['count'];
});
?>
<table class="table table-striped">
	<tr>
		<th>LC</th>
		<th>Available Forms</th>
		<th></th>
	</tr>
	<?php
	foreach ($count_list as $row) {
		echo '<tr>';
		echo '<td>'.format_lc_name($row['lc']).'</td>';
		echo '<td>'.$row['count'].'</td>';
		echo '<td><a href="#" id="'.$row['lc'].'" class="lc_raw_data"><img src="img/raw_data.png" width="16px"></a></td>';
		echo '</tr>';
	}

	?>
</table>
<script type="text/javascript">
	$(".lc_raw_data").click(function(){
		var ID = $(this).attr("id");
		var url = "inc/display_lc_raw_data.php"; // the script where you handle the form input.
		$("#aft-header-form").append( "<input type=\"hidden\" value=\""+ID+" \" id=\"setlc\" name=\"lc\" />" );
	    $.ajax({
           type: "POST",
           url: url,
           data: $("#aft-header-form").serialize(), // serializes the form's elements.
           success: function(data)
           {
           	   $(".modal-header2").html('LC Data for ');
               $(".modal-body2").html(data);
               $("#myModal").modal('hide');
               $("#myModal2").modal('show');
           }
         });

    return false; // avoid to execute the actual submit of the form.
	});
</script>
<?php
?>