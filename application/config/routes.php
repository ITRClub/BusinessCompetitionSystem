<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/transaction/getCoinInfo/(:any)'] = 'Api/Api_transaction/getCoinInfo/$1';
