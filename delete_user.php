<?php
$conn = new mysqli("localhost", "root", "", "railsys");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $userId = $_GET["id"];

    $stmt = $conn->prepare("DELETE FROM user WHERE userId = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        header("Location: admin_fetch_user_management.php?success=User deleted successfully!");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>