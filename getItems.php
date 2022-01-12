<html>
	<head>
		<title>Items</title>
		<style>
			table { border: 1px solid black; }
			th, td { 
				padding: 15px; 
				border: ipx solid black;
				text-align: left;
			}
		</style>
	</head>
	<body>
		<h1>Items List</h1>
		<?php
			// an import statement so we can use our ConnectionManager class
			include("ConnectionManager.php"); 

			// instantiate our connection to the DB
			$connectionManager = new ConnectionManager();

			// always check if we're successfully connected before running queries
			if ($connectionManager->checkConnection() == true) {
				$result = $connectionManager->getAllItems();
				
				// check to make sure we have results
				if ($result->num_rows > 0) {
					echo '<table>';
					echo '<tr><th>Id</th><th>Name</th><th>Price</th><th>Category</th></tr>';
					
					// pull the actual rows from our results
					while($row = $result->fetch_assoc()) {
						echo '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['price'] . '</td><td>'  . $row['category'] . '</td></tr>';
					}
					echo '</table>';
				}
				
				// clear our connection when done with it
				$connectionManager->endConnection();
			}
			?>
	</body>
</html>
