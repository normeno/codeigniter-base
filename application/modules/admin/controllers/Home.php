<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo $this->render_view('home.index', []);
    }
}