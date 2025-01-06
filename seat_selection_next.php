<?php
session_start();
if (!isset($_SESSION['userId'])) {
    // Redirect to login page if userId is not set in the session
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trainService = $_POST['trainService'];
    $departureTime = $_POST['departureTime'];
    $arrivalTime = $_POST['arrivalTime'];
    $pax = $_POST['pax'];
    $userId = $_SESSION['userId']; // Retrieve user ID from session

    // Extract trainNo from trainService
    list($trainName, $trainNo) = explode(' - ', $trainService);

    // Database connection
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "railsys";

    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Query to get available seats for the selected train
    $seatQuery = "SELECT seatNumber FROM seat WHERE trainNo = ? AND status = 'available'";
    $stmt = $conn->prepare($seatQuery);
    $stmt->bind_param("i", $trainNo);
    $stmt->execute();
    $result = $stmt->get_result();

    $availableSeats = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $availableSeats[] = $row['seatNumber'];
        }
    }

    // Query to get the fare for the selected train
    $fareQuery = "SELECT p.amount AS fare FROM train t JOIN price p ON t.priceId = p.priceId WHERE t.trainNo = ?";
    $stmt = $conn->prepare($fareQuery);
    $stmt->bind_param("i", $trainNo);
    $stmt->execute();
    $fareResult = $stmt->get_result();
    $fare = 0;
    if ($fareResult->num_rows > 0) {
        $fareRow = $fareResult->fetch_assoc();
        $fare = $fareRow['fare'];
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/seat.css">
    <style>
        .container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: #444;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.container h2 {
    margin-top: 0;
    color: white; /* Ensure the heading is white */
}

.available-seats, .selected-seats {
    margin-top: 20px;
}

.available-seats h3, .selected-seats h3 {
    margin-bottom: 10px;
    color: white; /* Ensure the subheadings are white */
}

.available-seats button, .selected-seats button {
    margin: 5px;
    padding: 15px 20px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
}

.available-seats button:hover, .selected-seats button:hover {
    background-color: #45a049;
}

.available-seats button.selected {
    background-color: #FFD700; /* Gold color for selected seats */
    color: black;
}

.selected-seats div {
    display: inline-block;
    margin: 5px;
    padding: 15px 20px;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
    font-size: 16px;
}

.booking-button {
    background-color: #ccc;
    color: white;
    border: none;
    padding: 15px 20px;
    cursor: not-allowed;
    border-radius: 5px;
    font-size: 16px;
    display: block; /* Ensure it is displayed */
}

.booking-button.enabled {
    background-color: #4CAF50;
    cursor: pointer;
}

.cancel-button {
    background-color: #f44336; /* Red color */
    color: white;
    border: none;
    padding: 15px 20px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
}

.cancel-button:hover {
    background-color: #e53935;
}
    </style>
</head>
<body>
<div class="header">
        <div class="brand"><a href="index.php" style="text-decoration: none; color: inherit;">NexRail</div>
        <div class="nav-links">
            <a href="schedule.php">Train Schedule</a>
            <a href="notification.php">Notification</a>
            <a href="arrival_depart.php">Arrival/Depart</a>
            <span class="current-page">Seat Selection</span>
            <a href="customersupport.php">Customer Support</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="hamburger" onclick="toggleDropdown()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="dropdown" id="dropdown">
            <a href="schedule.php">Train Schedule</a>
            <a href="notification.php">Notification</a>
            <a href="arrival_depart.php">Arrival/Depart</a>
            <span class="current-page">Seat Selection</span>
            <a href="customersupport.php">Customer Support</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
    <h2>Seat Selection for <?php echo $trainService; ?></h2>
    <div class="available-seats">
        <h3>Available Seats</h3>
        <div id="availableSeats">
            <?php foreach ($availableSeats as $seat): ?>
                <button onclick="selectSeat(this)"><?php echo $seat; ?></button>
            <?php endforeach; ?>
        </div>
        <button class="cancel-button" onclick="cancelSelection()">Cancel</button>
    </div>
    <div class="selected-seats">
        <h3>Selected Seats</h3>
        <div id="selectedSeats"></div>
        <h3>Total Fare: RM <span id="totalFare"><?php echo number_format($fare * $pax, 2); ?></span></h3>
        <button class="booking-button disabled" onclick="proceedToBooking()">Proceed to Booking</button>
    </div>

    <script>
        let selectedSeats = [];
        let paxCount = <?php echo $pax; ?>;
        let fare = <?php echo $fare; ?>;
        let userId = <?php echo json_encode($userId); ?>;
        console.log('User ID: ', userId);

        function selectSeat(button) {
            if (button.classList.contains('selected')) {
                button.classList.remove('selected');
                selectedSeats = selectedSeats.filter(seat => seat !== button.textContent);
            } else {
                if (selectedSeats.length < paxCount) {
                    button.classList.add('selected');
                    selectedSeats.push(button.textContent);
                }
            }
            updateSelectedSeats();
        }

        function updateSelectedSeats() {
            const selectedSeatsContainer = document.getElementById('selectedSeats');
            selectedSeatsContainer.innerHTML = '';
            selectedSeats.forEach(seat => {
                const seatElement = document.createElement('div');
                seatElement.textContent = seat;
                selectedSeatsContainer.appendChild(seatElement);
            });
            const bookingButton = document.querySelector('.booking-button');
            const totalFareElement = document.getElementById('totalFare');
            const totalFare = selectedSeats.length * fare;
            totalFareElement.textContent = totalFare.toFixed(2);
            console.log('Selected Seats:', selectedSeats);
            console.log('Pax Count:', paxCount);
            if (selectedSeats.length >= paxCount) {
                bookingButton.classList.add('enabled');
                bookingButton.classList.remove('disabled');
                bookingButton.style.cursor = 'pointer';
            } else {
                bookingButton.classList.remove('enabled');
                bookingButton.classList.add('disabled');
                bookingButton.style.cursor = 'not-allowed';
            }
        }

        function cancelSelection() {
            window.location.href = 'seat_selection.php';
        }

        function proceedToBooking() {
            console.log('Proceed to Booking Clicked');
            console.log('Selected Seats:', selectedSeats);
            console.log('Pax Count:', paxCount);
            if (selectedSeats.length >= paxCount) {
                // Update seat status to 'occupied' in the database
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "update_seat_status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert('Booking successful!');
                        window.location.href = 'index.php';
                    }
                };
                xhr.send("trainNo=<?php echo $trainNo; ?>&seats=" + JSON.stringify(selectedSeats) + "&userId=" + userId);
            } else {
                console.log('Not enough seats selected');
            }
        }
    </script>
</body>
</html>