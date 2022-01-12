<?php
	/*
		A helper class that creates and manages a connection to the database
	*/
	class ConnectionManager {
		
		// The connection that we run queries on
		private mysqli $connection;
		
		// Constructor where we pass in the host, username, password, database name
		function __construct() {
			$this->connection = new mysqli('localhost', 'root', '', 'MyDB');
		}
		
		// We should always call this before running queries
		public function checkConnection() {
			if ($this->connection->connect_error) {
				die("Connection failed: " . this->$connection->connect_error);
			} else {
				return true;
			}
		}
		
		// Fetch all rows from the items table
		public function getAllItems() {
			$sql = "SELECT * FROM items";
			$result = $this->connection->query($sql);

			return $result;
		}
		
		// Fetch a row from items table by a given name
		public function getItems(string $name) {
			$sql = 'SELECT * FROM items WHERE name = "' . $name . '"';
			echo "<p><b>SQL Executed:</b> " . $sql . "</p><br>";
			if ($this->connection->multi_query($sql)) {
				do {
					if ($result = $this->connection->store_result()) {
						while ($row = $result->fetch_row()) {
							for ($i = 0; $i < count($row); $i++) {
								echo $row[$i];
							}
							echo "<br>";
						}
						$result->free();
					}
					if ($this->connection->more_results()) {
						echo "<br>";
					}
				} while ($this->connection->next_result());
			}
		}
		
		public function addItem(string $itemName, string $itemPrice, string $itemCategory) {
			$sql = "INSERT INTO items (name, price, category) VALUES ('" . $itemName . "', '" . $itemPrice . "', '" . $itemCategory . "')";
			$this->connection->query($sql);
		}
		
		/*
			Add your functions for adding an item, getting all items, and querying for an item by name
		*/
		
		public function endConnection() {
			$this->connection->close();
		}
	}
?>