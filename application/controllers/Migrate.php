<?php

/**
 * Created by PhpStorm.
 * User: normeno
 * Date: 27-08-16
 * Time: 11:45
 */
class Migrate extends MX_Controller
{
    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }
}