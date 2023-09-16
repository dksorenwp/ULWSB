<?php
function systemLog($type, $message) {


$type = ucfirst($type);
$message = ucfirst($message);


    $config = require(dirname(__FILE__, 2) . '/config/config.php');





    if (isset($message)) {
	if ($config['log']['level'][strtolower($type)] == 1) {
		
		
        $returnTrue = false;
        
        if ($config['log']['enable']) {
			    require_once(dirname(__FILE__, 2) . '/functions/writeLog.php');
            if ($config['log']['local'] && writeLog($type, $message)) {
                $returnTrue = true;
            }
        }

        if ($config['log']['webhook']['discord']['enable']) {
			    require_once(dirname(__FILE__, 2) . '/functions/webhookDiscord.php');
            if (!empty($config['log']['webhook']['discord']['url']) && webhookDiscord($type, $message)) {
                $returnTrue = true;
            }
        }

        return $returnTrue;
	}
    } else {
        return false;
    }
}
?>
