
<!DOCTYPE html>
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
	<button href="#">文章列表</button>
</div>

<div id="section">
	
		<?php
				// include ("db_conn.php");

				// $servername = "localhost";
				// $username = "root";
				// $password = "";
				// $dbname = "blog";				
				// // Create connection
				// $conn = new mysqli($servername, $username, $password, $dbname);				
				// if ($conn->connect_error) {
	   //  			die("Connection failed: " . $conn->connect_error);
				// } 
				// echo "<br>"."Connected successfully";				
				// $dbhandle=mysql_connect("localhost","root","") or die ("連線失敗");
				// $selected = mysql_select_db("blog",$dbhandle) 
  		// 		or die("Could not select db");
				// mysql_set_charset('utf8',$dbhandle);
				include('db_conn.php');
				
				$sql = "SELECT id, datetime, title, content FROM blog_post";
				$result = mysql_query($sql);		    
				       if (mysql_num_rows($result) > 0) {
				       	// output data of each row
							while ($row = mysql_fetch_array($result)) {
								echo "<fieldset>";
								echo '<div class="block">';
								echo "標題 :".$row["title"].'<br>';
								echo "時間 :".$row["datetime"]."<br>";
								if(str_word_count($row["content"])<50)
								{
									echo "內容 :".substr($row["content"],0,50).'<br>';
								}
								else
								{
									echo "內容 :".substr($row["content"],0,50).'......more'.'<br>';
								}
								echo '<font size="1">'.'<span class="pull-left">'.'<a href="edit.php?id=' . $row['id'] . '">繼續閱讀</a>'.'</span>'."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								echo '<span class="pull-right">'.'<a href="delete.php?id=' . $row['id'] . '">Delete</a>'.'</span>'.'</font>';
								echo '</div>';
								echo "</fieldset>"."<br>"."<br>";
																
				    		}
						} else {
				    		echo "none";
				    	}				    									
						echo "<a href='postlist-paginated.php'>View Paginated</a>";						
				?>	
	

</div>

</body>
</html>

