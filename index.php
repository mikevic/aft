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
        });
      };

    </script>

    <div id="chart_div" style="width: 100%;"></div>
 
    </div> <!-- /container -->
    <button class="btn btn-large show btn-primary"><h2>Welcome to the Available Form Tracker!</h2></button>
    <button class="btn btn-large show2 btn-success"><h4>Currently Indexing 14235 EPs and 16532 TNs</h4></button>
    <a href="aft.php"><button class="btn btn-large show3 btn-warning"><h4>Take me to the AFT! >></h4></button></a>
    <button class="btn btn-large show4"><h4>Last DB Sync : 30.01.2014</h4></button>
    <?php
  require 'footer.php';
?>

