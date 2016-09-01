<?php
$config = array(
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
);