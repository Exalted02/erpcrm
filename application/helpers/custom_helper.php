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

if (!function_exists('school_type_array')) 
{
	function school_type_array(){
		return $array = [
			'Direct', 'Re-Seller'
		];
    }
}

if (!function_exists('format_amount')) 
{
	function format_amount($amount){

        // trim only (don't force numeric yet)
        $clean = trim($amount);

        // remove commas for numeric check
        $numeric = str_replace(',', '', $clean);

        // if NOT numeric → return original
        if(!is_numeric($numeric)){
            return $amount;
        }

        $numeric = (float)$numeric;

        // if whole number → return int
        if(floor($numeric) == $numeric){
            return (int)$numeric;
        }

        // else return with 2 decimal
        return number_format($numeric, 2, '.', '');
    }
}
