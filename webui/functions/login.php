<?php
function login() {
	require_once(dirname(__FILE__, 2) . '/functions/systemLog.php');
    $config = json_decode(file_get_contents(dirname(__FILE__, 2) . '/config/config.json'), true);

if (isset($_POST['password'])) {
    if (password_verify($_POST['password'], $config['webuiPassword'])) {
        $_SESSION['loggedin'] = true; // Set the session variable to true
		systemLog("action", "user login on webgui.");
        return true;
    } else {
		systemLog("warning", "user try to login on webui with wong password!");
        return false;		
    }
}
}
?>
