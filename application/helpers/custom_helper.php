<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('ticket_type_array')) 
{
	function ticket_type_array(){
		return $array = [
			'Normal', 'Priority'
		];
    }
}

