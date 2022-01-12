<html>
	<head>
		<title>Item Result</title>
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
		<h1>Item Retrieved:</h1>
		<?php
			include("ConnectionManager.php");

			$connectionManager = new ConnectionManager();

			if ($connectionManager->checkConnection() == true) {
				if (isset($_POST['getItem'])) {
					
					$name = $_POST['name'];
					$connectionManager->getItems($name);
				}
				
				$connectionManager->endConnection();
			}
			?>
	</body>
</html>
