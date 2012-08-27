<?php
$con = mysql_connect("localhost","root","kirandreira");
if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}

mysql_select_db("bahikhata", $con);

$sql_count = "select count(EventId) from transaction where User = ".$_POST["user"];
$result = mysql_query($sql_count,$con);
$sql_event = "select EventId from transaction where User = ".$_POST["user"];

//echo $sql_count."\n";

if ($result){
	$event_count = intval(mysql_result($result,0, 'count(EventId)'));
	//echo $event_count;
}
else {
	echo "Error". mysql_error(). "\n";
}
$result = mysql_query($sql_event,$con);
$html = "<div id = 'my_events' num = '".$event_count."'>";
//echo $html;
for ($i = 0; $i < $event_count; $i++){
	$event_id = mysql_result($result, $i, 'EventId');
	$result2 = mysql_query("select * from event where EventId = ".$event_id, $con);
	$event_name = mysql_result($result2, 0, 'Name');
	$event_venue = mysql_result($result2, 0, 'Venue');
	$event_date = mysql_result($result2, 0, 'Date');
	$user_result = mysql_query("select User, Liability, Expense from transaction where EventId = ".$event_id);
	$user_count = intval(mysql_result(mysql_query("select count(User) from transaction where EventId = ".$event_id),0, 'count(User)'));
	
	//echo $user_count."\n";
	$html = $html."<div id = 'event_".$i."'   class='eventHolder' ><div onclick='expandEventNameHolder(this)'  ><div id = 'name'><h2>".$event_name."</h2></div><div id = 'id_".$i."' class='hidden'>".$event_id."</div><div id = 'venue'>Venue:".$event_venue."</div><div id = 'date'>Date:".$event_date."</div></div><div class='eventNameHolder' ><table><tr><td>Name</td><td>Liability</td><td>Expenses</td></tr>";
	for ($j = 0; $j < $user_count; $j++){
		$user = mysql_result($user_result, $j, 0);
		$liability = mysql_result($user_result, $j,1);
		$expense = mysql_result($user_result, $j,2);
		
		$html = $html . "<tr><td>".$user."</td><td>".$liability."</td><td>".$expense."</td></tr>";
	}
	$html = $html . "</table>        	
        	    <div id='expupdater'>
        	        <label for = 'expense'>Your Expense:</label>
                    <input type = 'number' name = 'expense' id = 'expense_".$i."'/>    </br>
                    <button class='google-button google-button-red' id = '".$i."'onclick='recalcnow(this)'>Recalculate</button>
        	   
        	</div></div></div>";
}


$html = $html."</div>";

echo $html;

function get_name($id){
    $url = "https://graph.facebook.com/".$id;
    $user = json_decode(file_get_contents($url));
    //echo $user->name;
    return $user->name; 
    
}
?>
