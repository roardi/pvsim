<?php
error_reporting(1);
$host ='localhost';
$username ='root';
$password ='';
$db ='media_buds';
$con = mysqli_connect($host,$username,$password,$db);
if(!$con){
	die('Could not connect: ' . mysql_error());
}
//$db_selected = mysqli_select_db('buds', $con );
//if (!$db_selected) {
    //die ('Can\'t use facebook : ' . mysqli_error());
//}
?>