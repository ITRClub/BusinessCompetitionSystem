<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/transaction/getCoinInfo/(:any)'] = 'Api/Api_transaction/getCoinInfo/$1';
$route['api/wallet/getInfo'] = 'Api/Api_wallet/getInfo';

$route['ucenter/transaction/log'] = 'UCenter/showTransactionLog';
$route['ucenter/index'] = 'UCenter/index';
$route['ucenter'] = 'UCenter/index';

$route['register'] = 'User/register';
$route['toRegister']['POST'] = 'User/toRegister';
$route['login'] = 'User/login';
$route['toLogin']['POST'] = 'User/toLogin';
$route['logout'] = 'User/toLogout';
