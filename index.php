<?php

require_once "Request.php";
require_once "Email.php";

/**
 * Max number of request retries
 */
const MAX_RETRIES = 3;

/**
 * Delay in seconds between request retries
 */
const RETRY_DELAY = 30;

/**
 * DateTime string when the first request failed
 * @var string
 */
$downSince;

/**
 * Email address to be sent an alert in the event that the website is down
 * @var string
 */
$notificationRecipient = "email_address_goes_here";

for ($i=0; $i < MAX_RETRIES; $i++) {
    $request = new Request();
    if ($request->httpStatusCode() == 200) {
        break;
    }
    $downSince = (new DateTime())->format('m/d/Y H:i:s');
    if ($i === MAX_RETRIES - 1) {
        new Email($notificationRecipient, "Down since ".$downSince.".");
    }
    sleep(RETRY_DELAY);
}
