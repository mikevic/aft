<?php
  require 'header.php';
  require 'inc/handle_data.php';
?>

	<form class="form-inline" role="form" id="aft-header-form" method="POST">
    <div class="form-group">
	    <select class="form-control aft-form" name="table_type">
	    	<option value="ep" <?php if($type == 'ep'){echo 'selected';}?> >EPs</option>
	    	<option value="tn"  <?php if($type == 'tn'){echo 'selected';}?> >TNs</option>
	    </select>
	  </div>
    <div class="form-group">
      <select name="xtype" class="form-control aft-form">
        <option value="unset">Select X Type</option>
        <option value="Global Internship" <?php if($x_type == 'Global Internship'){echo 'selected';} ?> >Global Internship</option>
        <option value="Global Community Development" <?php if($x_type == 'Global Community Development'){echo 'selected';} ?> >Global Community Development</option>
      </select>
    </div>
    <?php 
    if($x_type == 'Global Internship'){
    ?>
	  <div class="form-group">
	  	<select name="primary-background" class="form-control aft-form">
        <option value="unset">Select primary background</option>
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
        <option value="unset">Select primary background</option>
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
      <?php
      }
      ?>
    </div>
    <?php
    }
    ?>

	</form>
  <button class="topten btn">View Top 10</button>
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
        getlclist(label);
        });
      };

    </script>

    <div id="chart_div" style="width: 100%;"></div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header2">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body2">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
	require 'footer.php';
?>