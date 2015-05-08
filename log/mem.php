<?php

define("APP_ID","wx6cc5ffcf064fa1e5");
define("APP_SECRET","4193908a9a898a9ee658ef30c39b3de6");


function setMemCached ($key,$value)
{
    $connect = new Memcached;  //声明一个新的memcached链接
    $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
    $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
    $connect->addServer('e0b3a1284387446e.m.cnbjalicm12pub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
    $connect->setSaslAuthData('e0b3a1284387446e', 'a12345678A');
    
    $connect->set($key,$value,0);
    $connect->quit();
    return ;
}


function getMemCached ($key)
{
    $connect = new Memcached;  //声明一个新的memcached链接
    $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
    $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
    $connect->addServer('e0b3a1284387446e.m.cnbjalicm12pub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
    $connect->setSaslAuthData('e0b3a1284387446e', 'a12345678A');
    
    
    $token = $connect->get($key);
    $connect->quit();
    return $token;
}

function cache_getToken()
{
    $connect = new Memcached;  //声明一个新的memcached链接
    $connect->setOption(Memcached::OPT_COMPRESSION, false); //关闭压缩功能
    $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true); //使用binary二进制协议
    $connect->addServer('e0b3a1284387446e.m.cnbjalicm12pub001.ocs.aliyuncs.com', 11211); //添加OCS实例地址及端口号
    $connect->setSaslAuthData('e0b3a1284387446e', 'a12345678A');
    
    $token = $connect->get("token_access");
    if(!empty($token))
    {
        $connect->quit();
        return $token;
    }else
    {
        $token = get_accessToken();
        $connect->set("token_access",$token,7000);
        $connect->quit();
        return $token;
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
