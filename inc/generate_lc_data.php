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