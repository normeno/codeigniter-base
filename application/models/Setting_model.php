<?php

class Setting_model extends MY_Model
{
    public $validate = [
        [
            'field' => 'short_name',
            'label' => 'short_name',
            'rules' => 'required|valid_email'
        ]
    ];
}