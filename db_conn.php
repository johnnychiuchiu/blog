<?php
$dbhandle=mysql_connect("localhost","root","") or die ("連線失敗");

$selected = mysql_select_db("blog",$dbhandle) 
  or die("Could not select db");

mysql_set_charset('utf8',$dbhandle);
?>