<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if(!function_exists('invalid_moodle_url')){
    function invalid_moodle_url(){
        echo '<div class="error"><p>';
        _e('Invalud site url!', 'oneacademy');
        echo '</p></div>';
    }
}

if(!function_exists('invalid_moodle_credential')){
    function invalid_moodle_credential(){
        echo '<div class="error"><p>';
        _e('Invalid Username or Password or api access is to enable to your Moodle site.', 'oneacademy');
        echo '</p></div>';
    }
}

