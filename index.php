<?php

require_once(__DIR__.'/vendor/autoload.php');

/**
 * Load environment variables
 */
try {
  (new Dotenv\Dotenv(__DIR__))->load();
} catch (Exception $e) {
  header('HTTP/1.0 500 Internal Server Error');
  exit('Invalid or missing .env file');
}

/**
 * Check allowed IP's
 */
$ips = explode(',', getenv('ALLOWED_IPS'));
$ip  = $_SERVER['REMOTE_ADDR'];
if (
  !empty($ips) && 
  !in_array($ip, $ips)
) {
  header('HTTP/1.0 403 Forbidden');
  exit();
}

/**
 * Initiate HTTP client
 */
$guzzle = new GuzzleHttp\Client();

/**
 * Send message to pushbullet
 */
$api = new Thorongil\Pushbullet\Client($guzzle, getenv('API_KEY'));
$api->push(
  getenv('MSG_TITLE'),
  getenv('MSG_TEXT')
);
