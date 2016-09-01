<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

        $this->lang->load('admin', $this->session->lang);

        $this->form_validation->set_error_delimiters('<small class="help-block">', '</small>');
    }

    protected function render_view($view, $data)
    {
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

    /**
     * Generate a sidebar
     */
    protected function modules()
    {
        $output = [];
        $menus = $this->db->order_by('priority', 'ASC')->get('modules')->result();

        // Get main menu
        foreach ($menus as $menu) {
            if (!$menu->module_id) {
                $output[$menu->id] = [
                    'id'        => $menu->id,
                    'name'      => $this->lang->line(strtolower($menu->name)),
                    'route'     => site_url($menu->route),
                    'menu_id'   => $menu->module_id,
                    'font'      => $menu->font
                ];
            }
        }

        // Get submenus
        foreach ($menus as $menu) {
            if (array_key_exists($menu->module_id, $output)) {
                $output[$menu->module_id]['childs'][] = [
                    'id'        => $menu->id,
                    'name'      => $this->lang->line(strtolower($menu->name)),
                    'route'     => site_url($menu->route),
                    'menu_id'   => $menu->module_id,
                    'font'      => $menu->font
                ];
            }
        }

        $this->session->unset_userdata('sidebar');
        $this->session->set_userdata('sidebar', $output);
    }
}