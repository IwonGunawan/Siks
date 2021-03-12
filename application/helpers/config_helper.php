<?php
	function config($name="") 
	{
		$list_config 	= array(
					"LEVEL_ADMIN" 						=> 0, 
					"LEVEL_USTADZ"						=> 1,
					"LEVEL_SANTRI" 						=> 2, 

					"STATUS_ACTIVE"						=> 0, 
					"STATUS_DEACTIVE"					=> 1, 
					
					"NOT_DELETED" 						=> 0, 
					"DELETED"									=> 1,
		);

		return $list_config[$name];
	}