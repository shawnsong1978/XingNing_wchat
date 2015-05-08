<?php

/* write log*/
include_once "mem.php";
class log
{
	public  static function logger($log_content,$level)
	{
	    $loglevel = getMemCached("LogLevel");
	    if(empty($token))
	    {
	        $loglevel = 0;
	    }
	    if($loglevel <= $level)
	    {
	        $max_size = 500000;
	        $log_filename = "/xingning/log.xml";
	        if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
	        file_put_contents($log_filename, date('Y-m-d H:i:s')." ".$log_content."\r\n", FILE_APPEND);
	    }
        
    }

}
?>
