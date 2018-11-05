<?php
/**
 * Created by PhpStorm.
 * User: baldonharris
 * Date: 09/10/2017
 * Time: 11:11 PM
 */
if (!function_exists('isAJAX')) {
    function isAJAX($return = false) {
        $CI =& get_instance();
        if (!$CI->input->is_ajax_request()) {
            if ($return === false) {
                show_404();
            } else {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('isInput')) {
    function isInput($method = 'post') {
        $CI =& get_instance();
        switch ($method) {
            case 'post':
            case 'POST':
                $toReturn = $CI->input->post();
                break;
            case 'get':
            case 'GET':
                $toReturn = $CI->input->get();
                break;
            default:
                $toReturn = NULL;
        }

        return $toReturn;
    }
}

if (!function_exists('return_json')) {
    function return_json($data) {
        $CI =& get_instance();
        if (is_array($data)) {
            $CI->output->set_output(json_encode($data));
        } else {
            echo '<pre>';
            print_r(debug_backtrace());
            echo '</pre>'; die;
        }
    }
}