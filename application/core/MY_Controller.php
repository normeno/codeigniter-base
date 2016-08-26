<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Philo\Blade\Blade;

class MY_Controller extends MX_Controller
{
    protected $blade;
    //protected $views = APPPATH . '/modules/admin/views';
    protected $views;
    protected  $cache = APPPATH . '/cache';
    public function __construct()
    {
        parent::__construct();
        $this->views = APPPATH . "/modules/{$this->router->fetch_module()}/views";
        $this->blade = new Blade($this->views, $this->cache);
        $this->blade->view()->composer("*", function($view)
        {
            $view->with("session", $this->session);
            $view->with("uri", $this->uri);
        });
    }
}