<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderPost($id, $title, $content, $error)
 {
?>
	 <!DOCTYPE HTML>
	 <html>
	 	<head>
	 		<title>Johnny's Blog</title>
			<link type="text/css" rel="stylesheet" href="css/stylesheet.css" />
			<meta charset="UTF-8">
			<style>		
				#header {
		    		background-color:black;
		    		color:white;
		    		text-align:center;
		    		padding:5px;
				}
			</style>
	 	</head>
	 <body>
		<div id="header">
			<h1>Johnny's Blog</h1>
		</div>
		 <div id="nav">
				<button onclick="location.href = './create.php';">新增文章</button>	
				<button onclick="location.href = './postlist.php';">文章列表</button>
		 </div>
		 <div id="section">
			 <?php 
			 // if there are any errors, display them
				 if ($error != '')
				 {
				 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
				 }
			 ?> 
			 
			 <form action="" method="post">
				 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
				 <div>					
					<strong>標題: *</strong><br><input type="text" name="title" size="50" value="<?php echo $title; ?>" disabled><br>
					<strong>文章內容: *</strong><br>
					 	<textarea name="content" rows="46" cols="50" disabled=""><?php echo $content; ?></textarea>
				 </div>
			 </form>
			 <?php
				include('db_conn.php');
					$sql = "SELECT commentid, postid, comment, time FROM comment_test WHERE postid=$id";
					$result = mysql_query($sql);		    
						if (mysql_num_rows($result) > 0) {
							// output data of each row
							while ($row = mysql_fetch_array($result)) {
								echo $row["comment"]."&nbsp;".$row["time"]."<br>";								
							}
						}
						else
						{
							echo "<br>";
						} 
			?>	

			<form name="form1" action="" method="post">
				<strong>留言:</strong><br>
					<textarea name="comment" rows="2" cols="30" value=""></textarea> 		
				<input type="submit" name="submit" value="送出"/>
			</form> 
			 <button onclick="location.href = './postlist.php';">返回</button> 
		 </div>
	 </body>
	 </html> 


<?php
 }



 // connect to the database
 include('db_conn.php');
 
  // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 	{
 // query db
 		$id = $_GET['id'];
 		$result = mysql_query("SELECT * FROM blog_post WHERE id=$id")
 		or die(mysql_error()); 
 		$row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 		if($row)
 		{
 
 // get data from db
 			$title = $row['title'];
 			$content = $row['content'];
 
 // show form
 			renderPost($id, $title, $content, '');
 		}
 		else
 // if no match, display result
 		{
 		echo "No results!";
 		}
 	}
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 	{
 	echo 'Error!';
 	}
 
?>

<?php 
 
 
 // connect to the database
 include('db_conn.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 {  
 	if (isset($_GET['id']) && is_numeric($_GET['id']))
 	{
 		$id = $_GET['id'];
 	}
 // get form data, making sure it is valid
 	$comment = $_POST["comment"]; 	

 	 		
 // save the data to the database
 	mysql_query("INSERT comment_test SET comment='$comment', postid=$id")
 	or die(mysql_error()); 
 		$url="edit.php?id=".$id;
 // once saved, redirect back to the view page
 		header("Location: $url"); 
 }
?>