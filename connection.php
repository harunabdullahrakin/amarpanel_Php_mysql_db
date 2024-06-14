<?php

$dbhost = "sql.freedb.tech";
$dbuser = "freedb_rakin";
$dbpass = "pM*NHqJMXqK%6MY";
$dbname = "freedb_rakinf";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
