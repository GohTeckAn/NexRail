<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "railsys";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// First, let's see what's in the admin table
$result = $conn->query("SELECT * FROM admin");
echo "Current admin records:<br>";
while($row = $result->fetch_assoc()) {
    echo "Email: " . $row['email'] . "<br>";
    echo "Password hash: " . $row['password'] . "<br>";
    echo "Permission: " . $row['permission'] . "<br><br>";
}

// Now let's create a new admin with a known password hash
$email = "teckangoh@gmail.com";
$password = "123456";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$permission = "admin";

// Delete existing admin with this email if exists
$stmt = $conn->prepare("DELETE FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

// Insert new admin
$stmt = $conn->prepare("INSERT INTO admin (permission, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $permission, $email, $hashedPassword);
$stmt->execute();

echo "New admin created with:<br>";
echo "Email: " . $email . "<br>";
echo "Password hash: " . $hashedPassword . "<br>";
echo "Try logging in with:<br>";
echo "Email: teckangoh@gmail.com<br>";
echo "Password: 123456";
?>
