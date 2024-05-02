<?php
    use Infobip\Configuration;
    use Infobip\Api\SmsApi;
    use Infobip\Model\SmsDestination;
    use Infobip\Model\SmsTextualMessage;
    use Infobip\Model\SmsAdvancedTextualRequest;


    require __DIR__ . "/vendor/autoload.php";

    $number = 09063804889;
    $message = "This is my first message, just testing!";

    

?>