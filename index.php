<?php
  require 'header.php';
?>
    <div class="container-full">

      <!-- Main component for a primary marketing message or call to action -->
 
 <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
     google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'EPs', 'TNs'],


<?php
  $result1 = mysql_query("SELECT * from country");
  $list_of_countries = mysql_fetch_assoc($result1);
  while($row = mysql_fetch_assoc($result1)) {
    $epcount = 0;
    $tncount = 0;
    $country = $row['nicename'];
    $result2 = mysql_query("SELECT COUNT(entry_id) AS entries FROM ep WHERE `MC`='$country'");
    $result3 = mysql_query("SELECT COUNT(entry_id) AS entries FROM tn WHERE `MC`='$country'");
    $ep_data = mysql_fetch_assoc($result2);
    $epcount = $ep_data['entries'];
    $tn_data = mysql_fetch_assoc($result3);
    $tncount = $tn_data['entries'];
    if($epcount != 0 || $tncount != 0) {
      echo "['$country', $epcount, $tncount],";
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
 
    </div> <!-- /container -->
<?php
  require 'footer.php';
?>

