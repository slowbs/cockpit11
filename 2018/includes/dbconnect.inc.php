<?php

mysql_connect($hostname, $user, $password) or die("ติดต่อฐานข้อมูลไม่ได้"); //ติดต่อฐานข้อมูล
mysql_select_db($dbname) or die("เลือกฐานข้อมูลไม่ได้");//เลือกฐานข้อมูล
mysql_query("SET NAMES utf8");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");

?>

