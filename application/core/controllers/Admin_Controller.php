<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library([
            'session',
            'form_validation',
            'ion_auth'
        ]);

        $this->load->helper([
           'form'
        ]);
    }

    protected function render_view($view, $data)
    {
        echo $this->blade
                ->view()->make($view, $data)
                ->render();
    }
}