<?php
// filepath: /c:/xampp/htdocs/railsystemNexRail/auth.php
session_start();

function checkLogin() {
    if (!isset($_SESSION['userId'])) {
        // Redirect to login page if userId is not set in the session
        header("Location: login.php");
        exit();
    }
}
?>