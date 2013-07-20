<?php

class LoggerModel { 

	/*
	function __construct() {
		parent::__construct();
	}

	# SINGLETON 
    static public function getLogger(){
    	
        if (!isset(self::$logger)) {
            $log = __CLASS__;
            self::$logger = new $log;
        }
        return self::$logger;
    }
    */

    static public function write($class, $type, $array = array()){
    	if (isset($_SESSION['usuario'])) {
    		$array[] = "por: $_SESSION[usuario]";
    	}
	    if(!is_dir('logs')){
            mkdir('logs', 0777);
		}
		if(!is_dir('logs/operation')){
            mkdir('logs/operation', 0777);
		}
		$path = 'logs/operation/' . date('Ym') . '.txt';
		$msg = '';
		if( $file = fopen( $path , 'a+' ) ) {
			$msg .= date('Y-m-d H:i:s') . ' ' .
			        $class . ' - [ ' . $type . ' ] - ' .
				    implode('; ', $array);
			        #"\n\r";

			fwrite( $file , $msg.chr(13).chr(10) );
			fclose( $file );
		}
    }
}

?>