<?php

namespace Thorongil\Pushbullet;

/**
 * Client for pushing a message and title to the pushbullet API
 */
class Client 
{
  /**
   * @var \GuzzleHttp\Client $api
   */
  private $api;
  
  /**
   * @var string
   */
  private $key;  
  
  /**
   * @var string
   */
  private static $endpoint = "https://api.pushbullet.com/v2/pushes";

  public function __construct(\GuzzleHttp\Client $api, $key) 
  {
    $this->key = $key;
    $this->api = $api;
  }

  /**
   * Push to pushbullet API
   *
   * @param string $title
   * @param string $msg
   * @return boolean
   */
  public function push($title, $msg) 
  {
    $body = [
      "type"  => "note",
      "title" => $title,
      "body"  => $msg
    ];
    
    try {
      $this->api->post(
        $this::$endpoint,
        [
          "json" => $body,
          "headers" => [
            "Content-Type" => "application/json",
            "Access-Token" => $this->key
          ]
        ]
      );
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
}