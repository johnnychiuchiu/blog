

<!DOCTYPE html>
<html>
<head>
	<title>Johnny's Blog</title>
	<link type="text/css" rel="stylesheet" href="css/stylesheet.css" />
	<meta charset="UTF-8">
	<style>
		table, th, td {
		    border: 1px solid black;
		    border-collapse: collapse;
		}
		th, td {
		    padding: 15px;
		}
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
	<table width="100%">
	    <thead>
	        <tr>
	        	<th>id</th>
	        	<th>datetime</th>
	        	<th>title</th>
	       		<th>content</th>
	       		<th></th>
	       		<th></th>
	        </tr>
		</thead>
		<tbody>	       	        
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
				include('db_conn.php');
				
				$sql = "SELECT id, datetime, title, content FROM blog_post";
				$result = mysql_query($sql);		    
				       if (mysql_num_rows($result) > 0) {
				       	// output data of each row
							while ($row = mysql_fetch_array($result)) {
								echo "<tr>";
								echo "<td>".$row["id"]."</td>";
								echo "<td>".$row["datetime"]."</td>";
								echo "<td>".$row["title"]."</td>";
								echo "<td>".substr($row["content"],0,50).".........."."</td>";
								echo '<td><a href="edit.php?id=' . $row['id'] . '">繼續閱讀</a></td>';
								echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
								echo "</tr>";
				    		}
						} else {
				    		echo "<td>"."</td>"."<td>"."</td>"."<td>"."</td>";
				    	}
				?>	
		</tbody>
	</table>
</div>

</body>
</html>

