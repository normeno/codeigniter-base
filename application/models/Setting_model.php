<?php

class Setting_model extends MY_Model
{
    /**
     * @var string
     */
    public $_table = 'settings';

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
    public $belongs_to = [
        'groups_modules' => ['model' => 'group_module_model']
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('module_model', 'module');
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
}