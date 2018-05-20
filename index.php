<?php

define('ROOT', __DIR__);

require_once "vendor/autoload.php";
require "config/config.php";

use bmstanley\Request;
use bmstanley\EmailService as Email;

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
 *
 * @var string
 */
$startTime;

if (PHP_VERSION_ID < 70100) {
    echo "Your current PHP version is not high enough. Please upgrade to PHP 7.1 or higher.";
    exit;
}

foreach ($config['request']['url'] as $url) {
    $startTime = (new \DateTime())->format('m/d/Y H:i:s');
    for ($i = 0; $i < MAX_RETRIES; $i++) {
        $request = new Request($url);
        if ($request->httpStatusCode() == 200) {
            break;
        }
        if ($i === MAX_RETRIES - 1) {
            new Email($config, $config['email']['recipients'], $request->url . " has been down since " . $startTime . ".");
        }
        sleep(RETRY_DELAY);
    }
}
