<?php
$con = mysql_connect("localhost","root","kirandreira");
if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}

if (mysql_query("CREATE DATABASE bahikhata",$con))
  {
  echo "Database created";
  }
else
  {
  echo "Error creating database: " . mysql_error();
  }

// Create event and transaction table
mysql_select_db("bahikhata", $con);
$sql_event = "CREATE TABLE event
(
EventId int NOT NULL,
Name varchar(500),
Venue varchar(100),
Date date,
PRIMARY KEY (EventId)
)";

$sql_transaction = "CREATE TABLE transaction
(
TransactionId int NOT NULL, 
User bigint,
EventId int,
Liability int,
Expense int,
PRIMARY KEY (TransactionId),
FOREIGN KEY (EventId) REFERENCES event(EventId)
)";
// create event table
if(mysql_query($sql_event, $con))
	{
	echo "event table created";		
	}
else
	{
	echo "Error creating event table: "	.mysql_error();
	}
// create trancsaction table
if(mysql_query($sql_transaction, $con))
	{
	echo "transaction table created";		
	}
else
	{
	echo "Error creating transaction table: ".mysql_error();
	}
mysql_close($con);
?>
