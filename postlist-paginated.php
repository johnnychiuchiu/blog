
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
				
				// number of results to show per page
				$per_page = 5;
				
				// figure out the total pages in the database
				$sql = "SELECT id, datetime, title, content FROM blog_post";
				$result = mysql_query($sql);
				$total_results = mysql_num_rows($result);
				$total_pages = ceil($total_results / $per_page);

				// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
				if (isset($_GET['page']) && is_numeric($_GET['page']))
				{
					$show_page = $_GET['page'];
					
					// make sure the $show_page value is valid
					if ($show_page > 0 && $show_page <= $total_pages)
					{
						$start = ($show_page -1) * $per_page;
						$end = $start + $per_page; 
					}
					else
					{
						// error - show first set of results
						$start = 0;
						$end = $per_page; 
					}		
				}
				else
				{
					// if page isn't set, show first set of results
					$start = 0;
					$end = $per_page; 
				}
				
				// display pagination
								
						    
				      for ($i = $start; $i < $end; $i++){
				      			if ($i == $total_results) { break; }

								echo "<fieldset>";
								echo '<div class="block">';
								echo "標題 :".mysql_result($result, $i, 'title') .'<br>';
								echo "時間 :".mysql_result($result, $i, 'datetime')."<br>";
								if(str_word_count(mysql_result($result, $i, 'content'))<50)
								{
									echo "內容 :".substr(mysql_result($result, $i, 'content'),0,50).'<br>';
								}
								else
								{
									echo "內容 :".substr(mysql_result($result, $i, 'content'),0,50).'......more'.'<br>';
								}
								echo '<font size="1">'.'<span class="pull-left">'.'<a href="edit.php?id=' . mysql_result($result, $i, 'id') . '">繼續閱讀</a>'.'</span>'."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								echo '<span class="pull-right">'.'<a href="delete.php?id=' . mysql_result($result, $i, 'id') . '">Delete</a>'.'</span>'.'</font>';
								echo '</div>';
								echo "</fieldset>"."<br>"."<br>";
																
				    		}
				    	echo "<p><a href='postlist.php'>View All</a> | <b>View Page:</b> ";
						for ($i = 1; $i <= $total_pages; $i++)
						{
							echo "<a href='postlist-paginated.php?page=$i'>$i</a> ";
						}
						echo "</p>";	
						 
				?>	
	

</div>

</body>
</html>

