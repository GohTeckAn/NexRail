<?php
$conn = new mysqli("localhost", "root", "", "railsys");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function fetch_feedback() {
    global $conn; 

    $stmt = $conn->prepare("SELECT * FROM customer_support");
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

// Fetch all feedback
$feedbacks = fetch_feedback();

echo "<h3>Customer Feedback</h3>";
echo "<a href='create_announce.php'>Create Annoucement</a><br><br>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Customer Email</th><th>Customer Name</th><th>Issue</th><th>Contact Details</th><th>Submitted At</th></tr>";

while ($row = $feedbacks->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["customer_id"] . "</td>";
    echo "<td>" . $row["customer_name"] . "</td>";
    echo "<td>" . $row["issue"] . "</td>";
    echo "<td>" . $row["contact_details"] . "</td>";
    echo "<td>" . $row["submitted_at"] . "</td>"; 
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>
