<?php

/**
 * Sample functions.php file
 */

function get_my_wordwrapper_token( $str_token )
{
    $str_token = '';

    if ( is_page( array(
        'athenahealth', 
        'athenaclinicals', 
        'athenacollector', 
        'athenacommunicator'
        )) ) 
    {
        $str_token = 'athena';
    }
    if ( is_page( array(
        'CareCloud', 
        'CareCloud Central', 
        'CareCloud Breeze', 
        'CareCloud Live', 
        'CareCloud Concierge'))
        ) 
    {
        $str_token = 'Care';
    }

    return $str_token;
}
add_filter( 'get_wordwrapper_token', 'get_my_wordwrapper_token', 10, 3 );
