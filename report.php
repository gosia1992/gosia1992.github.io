<?php

// connect to the database
$servername = "localhost"; // update with your database server name
$username = "digitalmedialab"; // update with your database username
$password = ""; // update with your database password
$dbname = "my_digitalmedialab"; // update with your database name
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// get the search query
$search_query = $_POST['search_query'];

// escape special characters in the search query to prevent SQL injection
$search_query = mysqli_real_escape_string($conn, $search_query);

// construct the SQL query to search the feedback table
$sql = "SELECT * FROM feedback WHERE name LIKE '%$search_query%' OR email LIKE '%$search_query%' OR message LIKE '%$search_query%'";

// execute the SQL query and store the results in a variable
$result = mysqli_query($conn, $sql);

// check if any results were found
if (mysqli_num_rows($result) > 0) {
	// display the results in an HTML table
	echo '<table>';
	echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th></tr>';
	while ($row = mysqli_fetch_assoc($result)) {
		echo '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['email'] . '</td><td>' . $row['message'] . '</td></tr>';
	}
	echo '</table>';
} else {
	// display a message if no results were found
	echo 'No results found.';
}

// close the database connection
mysqli_close($conn);

?>
