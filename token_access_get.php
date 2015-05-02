<?php
/**
  * wechat php test
  */

define("APP_ID","wx6cc5ffcf064fa1e5");
define("APP_SECRET","4193908a9a898a9ee658ef30c39b3de6");
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APP_ID."&secret=".APP_SECRET;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_TIMEOUT,10);
$output = curl_exec($ch);
curl_close($ch);
$obj = json_decode($output,true);
$token_access = $obj["access_token"];
echo $token_access;

?>
