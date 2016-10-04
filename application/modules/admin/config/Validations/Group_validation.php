<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$ci =& get_instance();

$config = [
    'group/store' => [
        [
            'field' => 'name',
            'label' => 'lang:name',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'description',
            'label' => 'lang:description',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'module_id',
            'label' => 'lang:modules',
            'rules' => 'trim|numeric'
        ],
    ],
    'group/update' => [
        [
            'field' => 'name',
            'label' => 'lang:name',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'description',
            'label' => 'lang:description',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'module_id',
            'label' => 'lang:modules',
            'rules' => 'trim|numeric'
        ],
    ],
];