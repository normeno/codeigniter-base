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

    public function modules()
    {
        $output = [];
        $menus = $this->db->get('modules')->result();

        foreach ($menus as $menu) {

            if (!$menu->module_id) {
                $output[$menu->id] = [
                    'id'        => $menu->id,
                    'name'      => $menu->name,
                    'route'     => site_url($menu->route),
                    'menu_id'   => $menu->module_id,
                    'font'      => $menu->font
                ];
            } else {
                if (array_key_exists($menu->module_id, $output)) {
                    $output[$menu->module_id]['childs'][] = [
                        'id'        => $menu->id,
                        'name'      => $menu->name,
                        'route'     => site_url($menu->route),
                        'menu_id'   => $menu->module_id,
                        'font'      => $menu->font
                    ];
                }
            }

        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }
}