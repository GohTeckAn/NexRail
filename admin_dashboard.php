<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "railsys");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM user");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexRail Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }
        nav {
            width: 200px;
            background: #333;
            height: 100vh;
            padding: 20px 10px;
            position: fixed;
            display: flex;
            flex-direction: column;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            margin: 10px 0;
        }
        nav ul li button {
            color: white;
            background: none;
            border: none;
            text-align: left;
            width: 100%;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }
        nav ul li button:hover {
            background: #444;
        }
        main {
            margin-left: 220px;
            padding: 20px;
            flex-grow: 1;
        }
        #dynamic-content {
            background: #444;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #666;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><button onclick="loadContent('overview')">Overview</button></li>
            <li><button onclick="loadContent('user_management')">User Management</button></li>
            <li><button onclick="loadContent('train_schedule')">Train Schedule</button></li>
            <li><button onclick="loadContent('feedback')">Feedback</button></li>
        </ul>
    </nav>
    <main>
        <div id="dynamic-content">
            <h2>Welcome, Admin</h2>
            <p>Select an option from the sidebar to view data.</p>
            <p>The Latest Ticket Price <a href="price.php"Click Here>Price</a></p>
        </div>
    </main>

    <script>
        function loadContent(section) {
            let url = '';
            if (section === 'overview') {
                url = 'admin_fetch_overview.php';
            } else if (section === 'user_management') {
                url = 'admin_fetch_user_management.php';
            } else if (section === 'train_schedule') {
                url = 'admin_fetch_train_schedule.php';
            } else if (section === 'feedback') {
                url = 'admin_fetch_feedback.php'; 
            }

            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('dynamic-content').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
