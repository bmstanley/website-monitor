<?php

require_once "BaseClass.php";
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

if (PHP_VERSION_ID < 70100) {
    echo "Your current PHP version is not high enough. Please upgrade to PHP 7.1 or higher.";
    exit;
}

$config = include("config/config.php");

foreach ($config['request']['url'] as $url) {
    for ($i=0; $i < MAX_RETRIES; $i++) {
        $request = new Request($url);
        if ($request->httpStatusCode() == 200) {
            break;
        }
        $downSince = (new DateTime())->format('m/d/Y H:i:s');
        if ($i === MAX_RETRIES - 1) {
            new Email($config['email']['recipients'], $request->url." has been down since ".$downSince.".");
        }
        sleep(RETRY_DELAY);
    }
}
