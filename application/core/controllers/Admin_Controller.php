<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use DebugBar\StandardDebugBar;

class Admin_Controller extends MY_Controller
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
        $this->load->model('site_model', 'site');
        $this->load->model('user_model', 'user');
        $this->load->model('module_model', 'module');
        $this->load->model('group_module_model', 'group_module');
        //$this->load->model('log_model', 'log');

        $this->lang->load('admin', $this->session->language);

        if ($this->router->fetch_method() != 'login'
            && $this->router->fetch_method() != 'logout') {
            $this->valid_user();
        }

        $this->form_validation->set_error_delimiters('<small class="help-block">', '</small>');
    }

    /**
     * Render a view
     *
     * @param $view
     * @param $data
     */
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
        $data['setting'] = $this->setting->get(1);

        echo $this->blade
                ->view()->make($view, $data)
                ->render();
    }

    /**
     * Validate User
     */
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

    /**
     * Generate CSRF
     *
     * @return array
     */
    protected function gen_csrf()
    {
        $csrf = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        ];

        return $csrf;
    }

    /**
     * Get the current user
     *
     * @return mixed
     */
    protected function current_user()
    {
        $user = $this->ion_auth->user()->row();

        if ($user) {
            $path = 'assets/img/users/';
            $user->avatar = is_null($user->avatar) ? $path.'default-user.png' : $path.$user->avatar;
        }

        return $user;
    }

    /**
     * Generate a sidebar
     */
    protected function modules()
    {
        $this->load->model('module_model', 'module');
        $this->load->model('group_module_model', 'group_module');

        $output = [];

        $modules = $this->group_module->sidebar();

        $this->session->unset_userdata('sidebar');
        $this->session->set_userdata('sidebar', $modules);

        return $output;
    }

    /**
     * Knowing what is the current module
     *
     * @param $module
     */
    protected function set_current_module($module) {
        $this->session->set_userdata('current_module', $module);
    }
}