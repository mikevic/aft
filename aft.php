<?php
  require 'header.php';

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
?>

	<form class="form-inline" role="form" id="aft-header-form" method="POST">
	  <div class="form-group">
	    <select class="form-control aft-form" name="table_type">
	    	<option value="ep" <?php if($type == 'ep'){echo 'selected';}?> >EPs</option>
	    	<option value="tn"  <?php if($type == 'tn'){echo 'selected';}?> >TNs</option>
	    </select>
	  </div>
	  <div class="form-group">
	  	<select name="primary-background" class="form-control aft-form">
        <option value="">Select primary background</option>
			<?php
				$result3 = mysql_query("SELECT DISTINCT `primary background` from `backgrounds`");
				while($row = mysql_fetch_assoc($result3)){
					echo '<option value="'.$row['primary background'].'"';
          if($primary_bg == $row['primary background']){
            echo 'selected';
          }
          echo '>'.$row['primary background'].'</option>';
				}
			?>
	  	</select>
	  </div>
    <?php
    if($primary_bg != 'unset'){
    ?>
    <div class="form-group">
      <select name="secondary-background" class="form-control aft-form">
        <option value="">Select primary background</option>
        <?php
          $result4 = mysql_query("SELECT `secondary background` from `backgrounds` WHERE `primary background`='$primary_bg'");
          while($row = mysql_fetch_assoc($result4)){
            echo '<option value="'.$row['secondary background'].'"';
            if($secondary_bg == $row['secondary background']){
              echo 'selected';
            }
            echo '>'.$row['secondary background'].'</option>';
          }
        ?>
      </select>
    </div>
    <?php
    }
    ?>
	</form>
	<div class="container-full">
<script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
     google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', '<?php echo $type_diplay ?>'],


<?php
  $result1 = mysql_query("SELECT * from country");
  $list_of_countries = mysql_fetch_assoc($result1);
  while($row = mysql_fetch_assoc($result1)) {
    $country = $row['nicename'];
    $where_query = " WHERE `MC`='$country'";
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
    if($count != 0) {
      echo "['$country', $count],";
    }
  }
?>

        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        google.visualization.events.addListener(chart, 'select', function() {
        var selection = chart.getSelection()[0];
        var label = data.getValue(selection.row, 0);
        alert(label+' : AFT Popup');
        });
      };

    </script>

    <div id="chart_div" style="width: 100%;"></div>
</div>

<?php
	require 'footer.php';
?>