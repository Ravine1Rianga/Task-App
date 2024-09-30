<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskapp_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch users in ascending order by name
$query = "SELECT * FROM users ORDER BY name ASC";
$result = $conn->query($query);

// Check if users exist and display them in a numbered list
if ($result->num_rows > 0) {
    echo "<ol>"; // Start an ordered list

    // Loop through each user and display their name
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['name']) . "</li>";  // Display the user name inside <li>
    }

    echo "</ol>"; // Close the ordered list
} else {
    echo "No users found.";
}

// Close the database connection
$conn->close();
?>
