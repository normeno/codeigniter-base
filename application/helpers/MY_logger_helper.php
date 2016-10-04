<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('current_url'))
{
    /**
     * Save the action
     *
     * @return string
     */
    function log_action($user, $action)
    {
        $ci =& get_instance();

        if (empty($user) || empty($action)) {
            return false;
        }

        $ci->log->insert([
            'user_id' => $user,
            'reason' => $action
        ]);
    }
}