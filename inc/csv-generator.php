<?php
require 'dbconnect.inc.php';
require 'functions.inc.php';
require 'handle_data.php';

$result1 = mysql_query("SELECT * from country");
$list_of_countries = mysql_fetch_assoc($result1);

$filename = md5(time());
//Open File to stream data to 
$fp = fopen('../files/'.$filename.'.csv', 'w');

//Pass Variable so script knows when to insert the header row
$pass = 0;
while($row = mysql_fetch_assoc($result1)) {
    $country = $row['nicename'];
    $where_query = " WHERE `MC`='$country'";
    require 'process_data.php';
    $query = "SELECT * FROM `$type`".$where_query;
    $result2 = mysql_query($query);
    if(mysql_num_rows($result2)!=0){
    	while ($data_row = mysql_fetch_assoc($result2)) {
    		if($pass == 0){
    			$write = echocsv(array_keys($data_row));
    			fwrite($fp, $write);
    			$pass = 1;
    		}
    		$write = echocsv($data_row);
    		fwrite($fp, $write);
    	}
    }
}
echo 'Export Complete! Click <a href="http://live.myaiesec.net/aft/files/'.$filename.'.csv" target="_blank">here</a> to download your export dump!';
?>