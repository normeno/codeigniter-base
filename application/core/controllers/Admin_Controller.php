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
            'form',
            'security'
        ]);
    }

    protected function render_view($view, $data)
    {
        $data['csrf'] = $this->gen_csrf();
        $data['current_user'] = $this->current_user();

        echo $this->blade
                ->view()->make($view, $data)
                ->render();
    }

    protected function valid_user()
    {
        return $this->ion_auth->user()->row();
    }

    protected function gen_csrf()
    {
        $csrf = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        ];

        return $csrf;
    }

    protected function current_user()
    {
        return $this->ion_auth->user()->row();
    }
}