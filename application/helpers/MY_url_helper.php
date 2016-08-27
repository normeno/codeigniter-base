<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('current_url'))
{
    /**
     * Get current url
     *
     * @return string
     */
    function current_url()
    {
        return site_url(uri_string());
    }
}

if ( ! function_exists('refresh'))
{
    /**
     * Refresh current page
     */
    function refresh()
    {
        redirect(current_url());
    }
}