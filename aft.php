<?php
  require 'header.php';
  require 'inc/handle_data.php';
?>



	<div class="container-full">
  <div class="col-md-2">
    
<!-- Form -->
  <form class="form" role="form" id="aft-header-form" method="POST">
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
      <select name="field-of-work" class="form-control aft-form">
        <option value="unset">Select Field of Work</option>
      <?php
        $result3 = mysql_query("SELECT DISTINCT `fow` from `field_of_work`");
        while($row = mysql_fetch_assoc($result3)){
          echo '<option value="'.$row['fow'].'"';
          if($fow == $row['fow']){
            echo 'selected';
          }
          echo '>'.$row['fow'].'</option>';
        }
      ?>
      </select>
    </div>
    <?php
    if($fow != 'unset'){
    ?>
    <div class="form-group">
      <select name="primary-secondary" class="form-control aft-form">
        <option value="primary" <?php if($search_scope == 'unset' || $search_scope == 'primary'){echo ' selected';} ?> >Primary</option>
        <option value="primary-secondary" <?php if($search_scope == 'primary-secondary'){echo 'selected';} ?> >Primary + Secondary</option>
      </select>
    </div>
    <div class="form-group">
      <select name="background" class="form-control aft-form">
        <option value="unset">Select Background</option>
        <?php
          $result4 = mysql_query("SELECT DISTINCT `sub_background` from `field_of_work` WHERE `fow`='$fow'");
          while($row = mysql_fetch_assoc($result4)){
            echo '<option value="'.$row['sub_background'].'"';
            if($background == $row['sub_background']){
              echo 'selected';
          }
          echo '>'.$row['sub_background'].'</option>';
        }
        ?>
      </select>
    </div>
    <?php
    } 
    } elseif ($x_type == 'Global Community Development'){
    ?>
    <div class="form-group">
      <select name="master-issue" class="form-control aft-form">
        <option value="unset">Select Master Issue</option>
        <?php
        $result3 = mysql_query("SELECT DISTINCT `master issue` from `issues`");
        while($row = mysql_fetch_assoc($result3)){
          echo '<option value="'.$row['master issue'].'"';
          if($master_issue == $row['master issue']){
            echo 'selected';
          }
          echo '>'.$row['master issue'].'</option>';
        }
      ?>   
      </select>
    </div>      
    <?php
    if($master_issue != 'unset'){
    ?>
    <div class="form-group">
      <select name="sub-issue" class="form-control aft-form">
        <option value="unset">Select Sub Issue</option>
        <?php
        $result3 = mysql_query("SELECT DISTINCT `sub issue` from `issues` WHERE `master issue`='$master_issue'");
        while($row = mysql_fetch_assoc($result3)){
          echo '<option value="'.$row['sub issue'].'"';
          if($sub_issue == $row['sub issue']){
            echo 'selected';
          }
          echo '>'.$row['sub issue'].'</option>';
        }
      ?>   
      </select>
    </div>      
    <?php  
    }
    }
    ?>
    <div class="form-group">
      <select name="duration" class="form-control aft-form">
        <option value="unset">Select Duration</option>
        <option value="1" <?php if($duration == '1'){echo 'selected';} ?> >4-8 Weeks</option>
        <option value="2" <?php if($duration == '2'){echo 'selected';} ?> >8-12 Weeks</option> 
        <option value="3" <?php if($duration == '3'){echo 'selected';} ?> >12-24 Weeks</option>  
        <option value="4" <?php if($duration == '4'){echo 'selected';} ?> >24-52 Weeks</option>
        <option value="5" <?php if($duration == '5'){echo 'selected';} ?> >Over 52 Weeks</option>
      </select>
    </div>
    <div class="form-group">
      <select name="region" class="form-control aft-form">
        <option value="world">Select Map</option>
        <option value="002" <?php if($region == '002'){echo 'selected';} ?> >Africa</option>
        <option value="150" <?php if($region == '150'){echo 'selected';} ?> >Europe</option> 
        <option value="019" <?php if($region == '019'){echo 'selected';} ?> >Americas</option>  
        <option value="142" <?php if($region == '142'){echo 'selected';} ?> >Asia</option>
        <option value="009" <?php if($region == '009'){echo 'selected';} ?> >Oceania</option>
      </select>
    </div>
    <div class="form-group">
      <input type="text" name="startdate" id="startdate" placeholder="Start Date" value="<?php if($startdate !='unset'){echo $startdate;} ?>">
    </div>
      <div class="form-group">
      <input type="text" id="enddate" name="enddate" placeholder="End Date" value="<?php if($enddate !='unset'){echo $enddate;} ?>">
    </div>
  </form>

  </div>
  <div class="col-md-10">

<script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
     google.load('visualization', '1', {packages: ['geochart']});

    function drawVisualization() {
    
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Country');
          data.addColumn('number', 'Value');
          data.addColumn('string', 'Display');
    
          data.addRows([
<?php
  $result1 = mysql_query("SELECT * from country");
  $list_of_countries = mysql_fetch_assoc($result1);
  while($row = mysql_fetch_assoc($result1)) {
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
    $query = "SELECT COUNT(entry_id) AS entries FROM `$type`".$where_query;
    $result2 = mysql_query($query);
    $ep_data = mysql_fetch_assoc($result2);
    $count = $ep_data['entries'];
    if($count != 0) {
        $country_display_name = format_country_name($country);
        echo "['$country', $count, '$country_display_name'],";
    }
    
  }
?>
          ]);
    
          var geochart = new google.visualization.GeoChart(
              document.getElementById('visualization'));
    
          var formatter = new google.visualization.PatternFormat('{1}');  
          formatter.format(data, [0, 2]);
    
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1]);  

           var options = {
<?php
  if($region != 'world'){
    echo "region : '$region'";
  }
?>
        };
    
          geochart.draw(view, options);


          google.visualization.events.addListener(geochart, 'select', function() {
          var selection = geochart.getSelection()[0];
          var label = data.getValue(selection.row, 0);
          getlclist(label);
          });
        }
    

    google.setOnLoadCallback(drawVisualization);


    </script>

    <div id="visualization" style="width: 100%;"></div>
    </div>


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



  <button class="topten btn">View Top 20</button>

<!-- AJAX Pre Loader -->
<div id="loading">
  <img src = "img/loading.gif"></img>
</div>
<?php
	require 'footer.php';
?>