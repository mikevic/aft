<?php
require 'dbconnect.inc.php';
require 'handle_data.php';
?>
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
?>