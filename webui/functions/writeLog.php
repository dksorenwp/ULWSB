<?php
function writeLog($type, $message) {
    if (!empty($message)) {
        $config = require(dirname(__FILE__, 2) . '/config/config.php');
        if (!empty($config['log']['localDIR'])) {
            // Define the path to your log directory
            $logDir = $config['log']['localDIR'];

            // Get the current date in the format YYYY-MM-DD
            $currentDate = date('Y-m-d');

            // Define the log file path with the current date
            $logFilePath = $logDir . '/' . $currentDate . '.txt';

            // Open the log file in append mode
            $logFile = fopen($logFilePath, 'a');

            if ($logFile) {
                // Get the current timestamp
                $timestamp = date('Y-m-d H:i:s');

                // Write the message and timestamp to the log file
                fwrite($logFile, "[$timestamp] $type: $message\n");

                // Close the log file
                fclose($logFile);
				
				return true;
            } else {
                // Handle error opening the log file and terminate the script
                die("Error: Unable to open the log file for writing.");
            }
        }
    }
}
