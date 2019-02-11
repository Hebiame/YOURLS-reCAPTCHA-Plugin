<?php
/*
Plugin Name: reCAPTCHA Plugin
Plugin URI: http://github.com/Hebiame/YOURLS-reCAPTCHA-Plugin
Description: Enables Google's reCAPTCHA 
Version: 1.0
Author: Hebiame, Kenstin
Author URI: https://github.com/Hebiame https://github.com/Kenstin/
*/

function addRecaptchaScript()
{
    echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
}

function itShunt($false, $url)
{
    if (!$url || $url == 'http://' || $url == 'https://') {
        $return['status']    = 'fail';
        $return['code']      = 'error:nourl';
        $return['message']   = yourls__('Missing or malformed URL');
        $return['errorCode'] = '400';
        return yourls_apply_filter('add_new_link_fail_nourl', $return, $url, $keyword, $title);
    }
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        //your site secret key
        $secret         = 'insert_recaptcha_key';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData   = json_decode($verifyResponse);
        
        // All clear, don't interrupt the normal flow of events
        if ($responseData->success) {
            return $false;
        }
    }
    return array(
        'status' => 'fail',
        'code' => 'error:recaptcha_fail',
        'message' => 'reCAPTCHA check failed',
        'errorCode' => '403'
    );
    
}

yourls_add_filter('shunt_add_new_link', 'itShunt');

yourls_add_action('html_head', 'addRecaptchaScript');