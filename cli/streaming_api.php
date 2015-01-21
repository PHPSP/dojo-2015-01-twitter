<?php

require __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'tmhOAuthExample.php';
$tmhOAuth = new tmhOAuthExample();

$tweets = [];

function my_streaming_callback($data, $length, $metrics) {
  $file = __DIR__.'/metrics.txt';
  
  $stdClass = json_decode($data);

  //$tweets[$stdClass->user->screen_name] = $stdClass->text;
  if($stdClass->text!=""){
     $file = file_put_contents('tweets.txt', $stdClass->user->screen_name . ' = ' . str_replace(PHP_EOL, ' ',$stdClass->text) .PHP_EOL, FILE_APPEND);
  }
  //print_r($tweets);
}

$code = $tmhOAuth->streaming_request(
  'GET',
  'https://stream.twitter.com/1.1/statuses/filter.json',
  array('track' => 'WinDigiTourTix'),
  'my_streaming_callback'
);

$tmhOAuth->render_response();