<?php
require 'dbconnect.inc.php';
for ($i=14241; $i<=17000; $i++) { 
	$result = mysql_query("SELECT `Latest End Date`, `Earliest Start Date` FROM `tn` WHERE `entry_id`='$i'");
	while($row = mysql_fetch_assoc($result)){
		$timestamp = strtotime($row['Latest End Date']);
		$timestamp1 = strtotime($row['Earliest Start Date']);
		mysql_query("UPDATE tn SET `Earliest Start Date`='$timestamp1' WHERE entry_id='$i'");
		mysql_query("UPDATE tn SET `Latest End Date`='$timestamp' WHERE entry_id='$i'");
	}
}
?>