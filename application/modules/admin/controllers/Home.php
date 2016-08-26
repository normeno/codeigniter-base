<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function index()
    {
        echo $this->router->fetch_module();
        echo $this->blade->view()->make('main')->render();
    }
}