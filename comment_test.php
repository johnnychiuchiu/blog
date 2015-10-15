<?php
	include('db_conn.php');
		$sql = "SELECT commentid, id, comment, time FROM comment_test";
		$result = mysql_query($sql);		    
			if (mysql_num_rows($result) > 0) {
				// output data of each row
				while ($row = mysql_fetch_array($result)) {
					echo $row["comment"]."&nbsp;".$row["time"]."<br>";								
				}
			} 
?>	

<form name="form1" action="" method="post">
	<strong>留言:</strong><br>
		<textarea name="comment" rows="2" cols="30" value=""></textarea> 		
	<input type="submit" name="submit" value="送出"/>
</form> 

<?php 
 
 
 // connect to the database
 include('db_conn.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 	$comment = $_POST["comment"]; 		
 // save the data to the database
 	mysql_query("INSERT comment_test SET comment='$comment'")
 	or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 		header("Location: comment_test.php"); 
 }
 