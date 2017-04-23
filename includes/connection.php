<?php
error_reporting(0);
require("constants.php");
 
//1. create database connection
$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
if(!$connection) {
die ("Database connection failed" . mysql_error());
}
//2. select database to use

$db_select = mysql_select_db(DB_NAME,$connection);
if(!$db_select){
die("Database selection Failed".mysql_error());
}
?>