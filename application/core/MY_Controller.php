<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Philo\Blade\Blade;

class MY_Controller extends MX_Controller
{
    protected $blade;
    protected $views;
    protected  $cache = APPPATH . '/cache';

    public function __construct()
    {
        parent::__construct();

        if (!is_null($this->router->fetch_module())) {
            $this->views = APPPATH . "/modules/{$this->router->fetch_module()}/views";
        } else {
            $this->views = APPPATH . "/views";
        }

        $this->blade = new Blade($this->views, $this->cache);

        $this->blade->view()->composer("*", function($view) {
            $view->with("session", $this->session);
            $view->with("uri", $this->uri);
        });

        if(is_null($this->session->language)) {
            $this->change_language();
        }
    }

    public function change_language($lang = null)
    {
        if(is_null($this->session->language)) {
            $this->config->set_item('language', 'english');
            $this->session->set_userdata('language', 'english');
        } elseif (!is_null($lang)) {
            $this->config->set_item('language', $lang);
            $this->session->set_userdata('language', $lang);
        }
    }
}

// include base controllers
require APPPATH."core/controllers/Admin_Controller.php";
require APPPATH."core/controllers/Front_Controller.php";