<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// default controller for this module
$route['admin'] = 'home';

$route['admin/login'] = 'auth/login';
$route['admin/logout'] = 'auth/logout';