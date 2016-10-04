<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        parent::set_current_module(6);
    }

    public function index()
    {
        $data = [
            'users' => $this->user->count(['users_groups.group_id >', 2]),
            'logged_today' => $this->user->loggedToday()
        ];

        echo $this->render_view('home.index', $data);
    }

    public function set_lang($lang)
    {
        parent::change_language($lang);
        redirect('admin');
    }
}