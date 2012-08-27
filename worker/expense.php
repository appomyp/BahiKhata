<?php
$con = mysql_connect("localhost","root","kirandreira");
if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}

mysql_select_db("bahikhata", $con);

$sql = "update transaction set Expense = ".$_POST['expense']." where EventId = ".$_POST['eventid']." and User = ".$_POST['user'];
 //echo "1";

if(mysql_query($sql,$con)){
    echo "Expense Updated";
}
else{
    echo "Error :" . mysql_error()."\n";
    echo $sql;
}
$result = mysql_query("select sum(Expense), count(Expense) from transaction where EventId = '".$_POST["eventid"]."'",$con);

$total_expense = intval(mysql_result($result,0,'sum(Expense)'));
$num_users = intval(mysql_result($result,0,'count(Expense)'));

//echo "2";

echo $total_expense."\n";
echo $num_users."\n";


$expense_per_user = $total_expense / $num_users;

echo $expense_per_user;

$sql = "update transaction 
            set Liability = ".intval($expense_per_user)." - Expense
            where EventId = ".$_POST["eventid"];
            

if(mysql_query($sql,$con)){
    echo "Liability Updated";
}
else{
    echo "Error :" . mysql_error()."\n";
    echo $sql;
}
?>
