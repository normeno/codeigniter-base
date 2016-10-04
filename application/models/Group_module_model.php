<?php

class Group_module_model extends MY_Model
{
    /**
     * @var string
     */
    public $_table = 'groups_modules';

    /**
     * @var string
     */
    public $primary_key = 'id';

    /**
     * @var array
     */
    public $protected_attributes = ['id'];

    /**
     * @var array
     */
    public $before_create = ['set_created_and_updated'];

    /**
     * @var array
     */
    public $before_update = ['set_updated'];

    /**
     * @var array
     */
    public $has_many = [
        'groups' => ['model' => 'group_model', 'primary_key' => 'id'],
        'modules' => ['model' => 'module_model', 'primary_key' => 'id']
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Trigger to update the fields created_at and updated_at
     *
     * @param $group
     * @return mixed
     * @internal param $user
     */
    protected function set_created_and_updated($group)
    {
        $group['created_at'] = $group['updated_at'] = date('Y-m-d H:i:s');
        return $group;
    }

    /**
     * Trigger to update the field updated_at
     *
     * @param $group
     * @return mixed
     * @internal param $user
     */
    protected function set_updated($group)
    {
        $group['updated_at'] = date('Y-m-d H:i:s');
        return $group;
    }

    public function sidebar()
    {
        $modules = $this->db->from($this->_table)
                            ->select('modules.*')
                            ->join('modules', 'modules.id = groups_modules.module_id')
                            ->where('groups_modules.group_id', 1)
                            ->order_by('modules.priority', 'ASC')
                            ->get()->result();

        // Get main menu
        foreach ($modules as $module) {
            if (!$module->module_id) {
                $output[$module->id] = [
                    'id'        => $module->id,
                    'name'      => $this->lang->line(strtolower($module->name)),
                    'route'     => site_url($module->route),
                    'menu_id'   => $module->module_id,
                    'font'      => $module->font
                ];
            }
        }

        // Get submenus
        foreach ($modules as $module) {
            if (array_key_exists($module->module_id, $output)) {
                $output[$module->module_id]['childs'][] = [
                    'id'        => $module->id,
                    'name'      => $this->lang->line(strtolower($module->name)),
                    'route'     => site_url($module->route),
                    'menu_id'   => $module->module_id,
                    'font'      => $module->font
                ];
            }
        }

        print_r($output);

        return $output;
    }
}