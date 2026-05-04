<?php 
/*
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

foreach($db as $key => $value){

define(strtoupper($key), $value);
}
*/
$connection = mysqli_connect('localhost','root','', 'electricsol'); //this function connect to the database
//
//if($connection){
//
//echo "we are connected";
//
//}