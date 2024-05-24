<?php
// TESTING
    use Infobip\Configuration;
    use Infobip\Api\SmsApi;
    use Infobip\Model\SmsDestination;
    use Infobip\Model\SmsTextualMessage;
    use Infobip\Model\SmsAdvancedTextualRequest;


    require __DIR__ . "/vendor/autoload.php";

    $number = $_POST["number"];
    $message = $_POST["message"];
    $apiURL = "mmlr94.api.infobip.com";
    $apiKey = "60f4fb61078d7fb812b5c816df4c9bd4-0e0a1474-83b1-4200-a9aa-84440cbc6825";

    $configuration = new Configuration(host: $apiURL, apiKey: $apiKey);
    
    $api = new SmsApi(config : $configuration);
    $destination = new SmsDestination(to : $number);
    $the_message = new SmsTextualMessage(
        destinations: [$destination],
        text : $message,
        from: "Caraga State University - ADMIN"
    );

    // Send
    $request = new SmsAdvancedTextualRequest(messages: [$the_message]);
    // $response = $api->sendSmsMessage($request);

    try {
        $response = $api->sendSmsMessage($request);
        echo "SMS MESSAGE SENT!";
    } catch(Exception $e) {
        echo "Error sending SMS: " . $e->getMessage();
    }

    


?>