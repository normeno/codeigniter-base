<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
	{
	    $data = [
	        'setting' => $this->setting->get(1)
        ];

        echo $this->render_view('home', $data);
	}

	public function set_lang($lang)
    {
        parent::change_language($lang);
        redirect('/');
    }
}
