<html>
	<head>
		<title>Add Item</title>
	</head>
	<body>
		<?php
			// an import statement so we can use our ConnectionManager class
			include("ConnectionManager.php");
			
			// instantiate our connection to the DB
			$connectionManager = new ConnectionManager();

			// check to make sure we are connected before running queries
			if ($connectionManager->checkConnection() == true) {
				
				// we check to make sure that the supre global variable $_POST contains an entry for "addItem"
				// which is the "name" value of our submit button that triggered this script
				if (isset($_POST['addItem'])) {
					
					// we pull data that was submitted in the form
					$itemName = $_POST['name'];
					$itemPrice = $_POST['price'];
					$category = $_POST['category'];			
										
					// run a query to insert a new item
					$connectionManager->addItem($itemName, $itemPrice, $category);
					
					// Fetch all rows from the items table and render them in a table
					echo '<h2>Items</h2>';
					$result = $connectionManager->getAllItems();
					
					// check to make sure we have results
					if ($result->num_rows > 0) {
						echo '<table>';
						echo '<tr><th>Id</th><th>Name</th><th>Price</th><th>Category</th></tr>';
						// loop through each row returned by the query and add a new row to our table
						while($row = $result->fetch_assoc()) {
							echo '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['price'] . '</td><td>'  . $row['category'] . '</td></tr>';
						}
						echo '</table>';
					}
				}
				
				// close our connection when we are finished
				$connectionManager->endConnection();
			}
		?>
	</body>
</html>