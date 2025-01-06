<?php
$conn = new mysqli("localhost", "root", "", "railsys");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $userId = $_GET["id"];

    $stmt = $conn->prepare("SELECT * FROM user WHERE userId = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["user_id"];
    $username = $_POST["username"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $username, $email, $userId);

    if ($stmt->execute()) {
        header("Location: admin_fetch_user_management.php?success=User updated successfully!");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

    <h2>Edit User</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="userId" value="<?php echo $user['userId']; ?>">

        <label for="username">Username:</label>
        <input type="text" name="userName" value="<?php echo $user['userName']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

        <button type="submit">Update User</button>
    </form>

</body>
</html>