<?php
include ("db_conn.php");
$title = $_POST["title"];
$content = $_POST["content"];
if ($title == '' || $content == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 echo "<a>"."<alert>".$error."</alert>"."</a>";
 }
 else
 {
	$sql="INSERT INTO blog_post (title, content) VALUES ('$title','$content')";
	$result=mysql_query($sql);
	header('Location: postlist.php');
 }
?>


