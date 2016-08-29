<?php

/**
 * Created by PhpStorm.
 * User: normeno
 * Date: 27-08-16
 * Time: 11:45
 */
class Migrate extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['migration']);
    }

    public function index()
    {
        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }

    public function refresh()
    {
        $this->migration->version(0);

        $this->index();
    }
}