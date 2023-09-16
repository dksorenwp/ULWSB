<?php
function logout() {
	require_once(dirname(__FILE__, 2) . '/functions/systemLog.php');
    session_destroy(); // Destroy the session
	systemLog("action", "user logout from webgui.");
    header("Location: index.php"); // Redirect to index.php
    exit();
}
