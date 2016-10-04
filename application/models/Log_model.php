<?php

class Log_model extends MY_Model
{
    public $_table = 'logs';
    public $before_create = ['set_created_and_updated'];
    public $before_update = ['set_updated'];

    public function __construct()
    {
        parent::__construct();
    }

    protected function set_created_and_updated($user)
    {
        $user['created_at'] = $user['updated_at'] = date('Y-m-d H:i:s');
        return $user;
    }

    protected function set_updated($user)
    {
        $user['updated_at'] = date('Y-m-d H:i:s');
        return $user;
    }
}