<?php
  require 'header.php';
  require 'inc/handle_data.php';
?>
	<div class="container-full">
  <div class="col-md-2">
    
<!-- Form -->
  <form class="form" role="form" id="aft-header-form" method="POST">
    <div class="form-group">
      <select class="form-control aft-form selectpicker" name="table_type" data-style="btn-success" id="tabletype">
        <option value="ep" <?php if($type == 'ep'){echo 'selected';}?> >EPs</option>
        <option value="tn"  <?php if($type == 'tn'){echo 'selected';}?> >TNs</option>
      </select>
    </div>
    <div class="form-group">
      <select name="xtype" class="form-control aft-form selectpicker" data-style="btn-success" id="xtype">
        <option value="unset">Select X Type</option>
        <option value="Global Internship" <?php if($x_type == 'Global Internship'){echo 'selected';} ?> >Global Internship</option>
        <option value="Global Community Development" <?php if($x_type == 'Global Community Development'){echo 'selected';} ?> >Global Community Development</option>
      </select>
    </div>
    <?php 
    if($x_type == 'Global Internship'){
    ?>
    <div class="form-group">
      <select name="field-of-work[]" class="form-control aft-form selectpicker" id="fow" data-style="btn-warning" multiple title="Select Primary Field of Work">
        <option value="unset">Select Field of Work</option>
      <?php
        $result3 = mysql_query("SELECT DISTINCT `fow` from `field_of_work`");
        while($row = mysql_fetch_assoc($result3)){
          echo '<option value="'.$row['fow'].'"';
          if(is_selected($row['fow'], $fow) == true){
            echo ' selected="selected"';
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
      <select name="primary-secondary" class="form-control aft-form selectpicker" data-style="btn-warning" id="primarysecondary">
        <option value="primary" <?php if($search_scope == 'unset' || $search_scope == 'primary'){echo ' selected';} ?> >Primary</option>
        <option value="primary-secondary" <?php if($search_scope == 'primary-secondary'){echo 'selected';} ?> >Primary + Secondary</option>
      </select>
    </div>
    <div class="form-group">
      <select name="background[]" class="form-control aft-form selectpicker" data-style="btn-warning" multiple id="background" data-style="btn-warning" title="Select Background">
        <option value="unset">Select Background</option>
        <?php
          $or_code = generate_form_or_code($fow, 'fow');
          $result4 = mysql_query("SELECT DISTINCT `sub_background` from `field_of_work` WHERE ($or_code)");
          while($row = mysql_fetch_assoc($result4)){
            echo '<option value="'.$row['sub_background'].'"';
            if(is_selected($row['sub_background'], $background) == true){
              echo 'selected="selected"';
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
      <select name="master-issue[]" class="form-control aft-form selectpicker" multiple id="masterissue" data-style="btn-primary" title="Pick Master Issue">
        <option value="unset">Select Master Issue</option>
        <?php
        $result3 = mysql_query("SELECT DISTINCT `master issue` from `issues`");
        while($row = mysql_fetch_assoc($result3)){
          echo '<option value="'.$row['master issue'].'"';
          if(is_selected($row['master issue'], $master_issue)==true){
            echo 'selected="selected"';
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
      <select name="sub-issue[]" class="form-control aft-form" id="subissue" multiple data-style="btn-primary" title="Pick Sub Issues">
        <option value="unset">Select Sub Issue</option>
        <?php
        $or_code = generate_form_or_code($master_issue, 'master issue');
        $result3 = mysql_query("SELECT DISTINCT `sub issue` from `issues` WHERE ($or_code)");
        while($row = mysql_fetch_assoc($result3)){
          echo '<option value="'.$row['sub issue'].'"';
          if(is_selected($row['sub issue'], $sub_issue)==true){
            echo 'selected="selected"';
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
      <select name="skills[]" class="form-control aft-form selectpicker" id="skills" data-style="btn-inverse" data-live-search="true" multiple title="Select Skills">
        <option value="unset">Select Skills</option>
        <?php
          $result4 = mysql_query("SELECT * from `skill`");
          while ($row = mysql_fetch_assoc($result4)) {
            echo '<optgroup label="'.$row['skill_name'].'">';
            $parent_id = $row['skill_id'];
            $result5 = mysql_query("SELECT * from `sub_skills` WHERE parent_id=$parent_id");
            while ($sub_row = mysql_fetch_assoc($result5)) {
              echo '<option value="'.$sub_row['skill_name'].'"';
              if(is_selected($sub_row['skill_name'], $skills) == true){
                echo 'selected="selected"';
              }
              echo '">'.$sub_row['skill_name'].'</option>';
            }

          }
        ?>
      </select>
    </div>
    <div class="form-group">
      <select name="duration" class="form-control aft-form selectpicker" id="duration" data-style="btn-inverse">
        <option value="unset">Select Duration</option>
        <option value="1" <?php if($duration == '1'){echo 'selected';} ?> >4-8 Weeks</option>
        <option value="2" <?php if($duration == '2'){echo 'selected';} ?> >8-12 Weeks</option> 
        <option value="3" <?php if($duration == '3'){echo 'selected';} ?> >12-24 Weeks</option>  
        <option value="4" <?php if($duration == '4'){echo 'selected';} ?> >24-52 Weeks</option>
        <option value="5" <?php if($duration == '5'){echo 'selected';} ?> >Over 52 Weeks</option>
      </select>
    </div>
    <div class="form-group">
      <select name="region" class="form-control aft-form selectpicker" id="region" data-style="btn-inverse">
        <option value="world">Select Map</option>
        <option value="002" <?php if($region == '002'){echo 'selected';} ?> >Africa</option>
        <option value="150" <?php if($region == '150'){echo 'selected';} ?> >Europe</option> 
        <option value="019" <?php if($region == '019'){echo 'selected';} ?> >Americas</option>  
        <option value="142" <?php if($region == '142'){echo 'selected';} ?> >Asia</option>
        <option value="009" <?php if($region == '009'){echo 'selected';} ?> >Oceania</option>
        <option value="029" <?php if($region == '009'){echo 'selected';} ?> >Caribbean</option>
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
    require 'inc/process_data.php';
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


<div class="topten">
  <button id="topten" class="btn">View Top 20</button>
  <button id="export" class="btn">Export</button>
</div>

<!-- AJAX Pre Loader -->
<div id="loading">
  <img src = "img/loading.gif"></img>
</div>
<?php
	require 'footer.php';
?>