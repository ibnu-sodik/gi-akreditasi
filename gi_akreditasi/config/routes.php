<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// Front end
$route['default_controller'] 		= 'beranda';
$route['halaman/(:any)']			= "halaman/detail/$1";

$route['instrumen/(:any)']			= "instrumen/detail/$1";
$route['instrumen/halaman/(:any)']	= "instrumen/index/$1";

$route['video/(:any)']				= "video/detail/$1";
$route['video/halaman/(:any)']		= "video/index/$1";

$route['kategori/(:any)']			= "kategori/detail/$1";
$route['kategori/(:any)/(:num)']	= "kategori/detail/$1/$2";

$route['kontak/kirim-pesan']		= "kontak/kirim_pesan";

$route['search']					= 'result/search/';
$route['search/(:any)']				= 'result/search/$1';

// Admin
$route['admin'] 				= 'admin/login';
$route['admin/konfigurasi-website'] = 'admin/website/konfigurasi_website';
$route['admin/konfigurasi-user'] = 'admin/user/konfigurasi_user';

$route['admin/update-password/(:any)']			= 'admin/reset/update_password/$1';
$route['admin/send-reset-code']					= 'admin/reset/send_reset_code';
$route['admin/reset-password/(:any)']			= 'admin/reset/index/$1';
$route['admin/aktivasi/(:any)']					= 'admin/aktivasi/index/$1';

$route['404_override'] 			= 'halaman_404';
$route['translate_uri_dashes'] 	= FALSE;
// $route['item'] 					= "item";  
// $route['getItem'] 				= "item/getItem";  
