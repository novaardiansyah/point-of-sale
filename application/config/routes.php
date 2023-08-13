<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// * Category Routes
$route['(:any)/kategori'] = 'master_data/category/index';
$route['(:any)/kategori/(:any)'] = 'master_data/category/$2';

$route['master-data/(:any)'] = 'master_data/$1';

$route['default_controller'] = 'main';
$route['404_override'] = 'main/error_404';
$route['translate_uri_dashes'] = TRUE;
