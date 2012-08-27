<?php
$con = mysql_connect("localhost","root","kirandreira");
if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}

mysql_select_db("bahikhata", $con);

// create an entry in the event table


$event_id = intval(mysql_result(mysql_query("select max(EventId) from event", $con), 0, 'max(EventId)'));
#echo $event_id."\n";

$event_id = $event_id + 1;

$sql = "Insert into event values ('".strval($event_id)."','".$_POST["name"]."','". $_POST["venue"]."','".$_POST["date"]."')";
#echo "**".$sql."**\n";

if (mysql_query($sql, $con)){
#	echo "created event\n";
	$user_list = explode('&',$_POST["userlist"]);

	foreach ( $user_list as $userid ){
		$transaction_id = intval(mysql_result(mysql_query("select max(TransactionId) from transaction",$con),0,'max(TransactionId)'));
#		echo $transaction_id."\n";
		$transaction_id = $transaction_id + 1;
	
		$sql = "Insert into transaction values ('".strval($transaction_id)."','".$userid."','".$event_id."',". "'0', '0'".");";
		
		
		if (mysql_query($sql,$con)){
#			echo "<p>User".$userid."Successfully Created</p>";
		}
		else {
#			echo "<p>Couldn't create user ".$userid."</p>";
		}
	}
	echo "successfully created the event";
}
else {
	echo "couldn't create event" . mysql_error()."\n";
}


?>
