<?php

if(!function_exists('is_active')){

    function is_active($controllers = [], $methods = [])
    {
        $CI =& get_instance();

        $current_controller = $CI->router->fetch_class();
        $current_method     = $CI->router->fetch_method();

        // Convert to array
        $controllers = (array) $controllers;
        $methods     = (array) $methods;

        // Check controller
        if(in_array($current_controller, $controllers)){

            // If no method specified → only controller match is enough
            if(empty($methods)){
                return 'active';
            }

            // If method specified → check method also
            if(in_array($current_method, $methods)){
                return 'active';
            }
        }

        return '';
    }
    function is_block($controllers = [], $methods = [])
    {
        $CI =& get_instance();

        $current_controller = $CI->router->fetch_class();
        $current_method     = $CI->router->fetch_method();

        // Convert to array
        $controllers = (array) $controllers;
        $methods     = (array) $methods;

        // Check controller
        if(in_array($current_controller, $controllers)){

            // If no method specified → only controller match is enough
            if(empty($methods)){
                return 'display:block';
            }

            // If method specified → check method also
            if(in_array($current_method, $methods)){
                return 'display:block';
            }
        }

        return '';
    }

}