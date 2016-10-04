<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// default controller for this module
$route['admin'] = 'home';

$route['admin/login'] = 'auth/login';
$route['admin/logout'] = 'auth/logout';

$route['admin/set_lang/(:any)'] = 'home/set_lang/$1';