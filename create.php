<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderPost($title, $content, $error)
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
			<button type="button">新增文章</button>	
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
			 
			 <form name="form1" action="" method="post">
				 <strong>標題: *</strong><br><input type="text" name="title" size="50" value="<?php echo $title; ?>" /><br>
				 <strong>文章內容: *</strong><br>
				 	<textarea name="content" rows="46" cols="50" value="<?php echo $content; ?>"></textarea> 
				 <p>* required</p>
				 <input type="submit" name="submit" value="送出"/>
			 </form> 
		 </div>
	 </body>
	 </html>
<?php 
 }
 
 // connect to the database
 include('db_conn.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 	$title = $_POST["title"];
 	$content = $_POST["content"];
 
 // check to make sure both fields are entered
 	if ($title == '' || $content == '')
 	{
 // generate error message
 		$error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 		renderPost($title, $content, $error);
 	}
 	else
 	{
 // save the data to the database
 		mysql_query("INSERT blog_post SET title='$title', content='$content'")
 		or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 		header("Location: postlist.php"); 
 	}
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderPost('','','');
 }
?>
