<?php
function webhookDiscord($type, $message) {
    if (!empty($message)) {
        $config = json_decode(file_get_contents(dirname(__FILE__, 2) . '/config/config.json'), true);
        if (!empty($config['log']['webhook']['discord']['url'])) {
            if ($config['log']['webhook']['discord']['embeds']) {
                // Use embeds
							
switch ($type) {
	
	 case "Action":
        $color = "6810891";
        break;
    case "Warning":
        $color = "16776960";
        break;
	 case "Error":
        $color = "16711680";
        break;
}
				
				
				
                                $data = array(
                    "embeds" => array(
                        array(
                            "title" => $type,
                            "type" => $config['log']['webhook']['discord']['embedsStyle']['type'],
                            "description" => $message,
                            "timestamp" => date(DateTime::ISO8601),
                            "color" => $color,
                            "thumbnail" => array(
                                "url" => $config['log']['webhook']['discord']['embedsStyle']['thumbnail']
                            ),
                            "author" => array(
                                "name" => $config['log']['webhook']['discord']['embedsStyle']['authorName'],
                                "url" =>  $config['log']['webhook']['discord']['embedsStyle']['authorURL'],
                                "icon_url" => $config['log']['webhook']['discord']['embedsStyle']['authorIcon']
                            )
                        )
                    )
                );
            } else {
                // Do not use embeds
                $data = array("content" => $type.": ".$message);
			}


                // Convert data to JSON format
                $jsonData = json_encode($data);

                // Initialize cURL session
                $ch = curl_init($config['log']['webhook']['discord']['url']);

                // Set cURL options
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Content-Type: application/json",
                    "Content-Length: " . strlen($jsonData)
                ));

                // Execute cURL session and get the response
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    die("Error: " . curl_error($ch));
                } else {
                    return true;
                }

                // Close cURL session
                curl_close($ch);
            
        } else {
            // Handle error opening the log file and terminate the script
            die("Error: Webhook for discord is not set.");
        }
    }
}
