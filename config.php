<?php
$application_folder = 'application';
$application_code_folder = 'appCode';
$models_folder = 'models';
$presenters_folder = 'presenters';
$views_folder = 'views';

define('APPPATH', $application_folder . '/');
define('MODELPATH', APPPATH . $models_folder . '/');
define('PRESENTERPATH', APPPATH . $presenters_folder . '/');
define('VIEWPATH', APPPATH . $views_folder . '/');
define('APPCODE', $application_code_folder . '/');

define('DB_HOST', 'database_host_string');
define('DB_LOGIN', 'database_login');
define('DB_PASSWORD', 'database_password');
define('DATABASE', 'database_name');

/**
 * For testing and development
 */
function pre($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}