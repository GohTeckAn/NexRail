<?php
$conn = new mysqli("localhost", "root", "", "railsys");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM user");
echo "<h3>User Management</h3>";
echo "<a href='create_user.php'>Create New User</a><br><br>";
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['userId'] . "</td>";
    echo "<td>" . $row['userName'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>";
    echo "<a href='edit_user.php?id=" . $row['userId'] . "' class='btn btn-edit'>Edit</a>";
    echo "<a href='delete_user.php?id=" . $row['userId'] . "' class='btn btn-delete' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
?>
