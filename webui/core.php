<?php
// Start the session
session_start();

// Include the configuration file
$config = json_decode(file_get_contents(dirname(__FILE__, 1) . '/config/config.json'), true);

// Include necessary functions
require_once(dirname(__FILE__, 1) . '/functions/login.php');
require_once(dirname(__FILE__, 1) . '/functions/logout.php');
require_once(dirname(__FILE__, 1) . '/functions/loginPage.php');
require_once(dirname(__FILE__, 1) . '/functions/systemLog.php');
	
// Check if the user is not logged in
if (!login()) {
    // If the user is not logged in and no session is active, show the login page
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        loginPage();
        exit();
    }
}

// Check if the 'logout' parameter is in the URL
if (isset($_GET['logout'])) {
    // If 'logout' is present, log the user out
    logout();
}
?>


