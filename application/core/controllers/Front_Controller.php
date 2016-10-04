<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use DebugBar\StandardDebugBar;

class Front_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library([
            'form_validation',
            'ion_auth',
            'uploader'
        ]);

        $this->load->helper([
            'form',
            'security'
        ]);

        $this->load->model('setting_model', 'setting');
        $this->load->model('user_model', 'user');

        $this->lang->load('front', $this->session->language);
    }

    protected function render_view($view, $data)
    {
        $debugbar = new StandardDebugBar();
        $debugbar_renderer = $debugbar->getJavascriptRenderer($baseUrl = base_url('vendor/maximebf/debugbar/src/DebugBar/Resources/'));

        if (ENVIRONMENT == 'development') {
            $data['debugbar_renderer'] = $debugbar_renderer;
        }

        $data['ci'] = get_instance();
        $data['csrf'] = $this->gen_csrf();
        $data['current_user'] = $this->current_user();
        $data['sidebar'] = $this->session->userdata('sidebar');

        echo $this->blade
                ->view()->make($view, $data)
                ->render();
    }

    protected function valid_user()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/login', 'refresh');
        }else{
            $module = $this->session->current_module;
            $groups = $this->group_module->get_many_by('module_id', $module);

            $access = false;

            foreach ($groups as $group) {
                if ($this->ion_auth->in_group((int)$group->group_id)) {
                    $access = true;
                }
            }

            if(!$access)
                redirect('admin/logout', 'refresh');
        }
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
        $user = $this->ion_auth->user()->row();

        if ($user) {
            $path = 'assets/img/users/';
            $user->avatar = is_null($user->avatar) ? $path.'default-user.png' : $path.$user->avatar;
        }

        return $user;
    }
}