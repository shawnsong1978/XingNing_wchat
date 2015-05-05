<?php
/**
  * wechat php test
  */

define("APP_ID","wx6cc5ffcf064fa1e5");
define("APP_SECRET","4193908a9a898a9ee658ef30c39b3de6");
echo "1";
if(exists_token())
{	echo "3";
	if(exprise_token())
	{
		$token = get_accessToken();
		unlink("token.txt");
		file_put_contents("token.txt",$token);
	}
	else
	{
	   	$token = file_get_contents("token.txt");
	}
}
else
{
	echo "2";
    $token = get_accessToken();
    file_put_contents("token.txt",$token);
}
var_dump($token);

function exists_token()
{
    if(file_exists("token.txt"))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function exprise_token()
{
    $ctime = filectime("token.txt");
    if(time() - $ctime >= 7000)
    {
        return true;
    }
    else
    {
        return false;
    }
}
function get_accessToken()
{
    
    
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
	return $token_access;
}

?>
