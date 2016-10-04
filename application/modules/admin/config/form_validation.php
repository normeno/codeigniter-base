<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$ci =& get_instance();

require_once __DIR__ . '/Validations/Site_validation.php';

/*$config = [
    // Users
    'user' => [
        [
            'field' => 'company',
            'label' => 'lang:company',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'first_name',
            'label' => 'lang:first_name',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'last_name',
            'label' => 'lang:last_name',
            'rules' => 'trim'
        ],
        [
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim'
        ],
        [
            'field' => 'email',
            'label' => 'lang:email',
            'rules' => 'trim|required|valid_email|is_unique[users.email.'.$ci->uri->segment(4).']'
        ],
        [
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => ($ci->router->fetch_method() == 'create') ? 'trim|required|min_length[6]|max_length[20]' : 'trim|min_length[6]|max_length[20]'
        ],
        [
            'field' => 'confirm_password',
            'label' => 'lang:confirm_password',
            'rules' => 'trim|matches[password]'
        ]
    ],
];*/
//require_once __DIR__ . '/Validations/Group_validation.php';
/*$config = [
    'site/edit' => [
        [
            'field' => 'short_name',
            'label' => 'Short Name',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'full_name',
            'label' => 'Full Name',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'logo',
            'label' => 'Logo',
            'rules' => 'trim'
        ],
        [
            'field' => 'website',
            'label' => 'Website',
            'rules' => 'trim|required|valid_url'
        ],
        [
            'field' => 'contact_email',
            'label' => 'Contact Email',
            'rules' => 'trim|required|valid_email'
        ]
    ]
];*/