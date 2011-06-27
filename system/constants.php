<?php
define('PATH_DELIM', '/');
// If this a windows system then replace backslashes with forward slashes.
// This is for consistency.
$basepath = str_replace('\\', PATH_DELIM, dirname(__FILE__));

define('BASEPATH', $basepath . PATH_DELIM);

define('SYSTEM', BASEPATH . $system_folder . PATH_DELIM);
define('APPPATH', BASEPATH . $application_folder . PATH_DELIM);
define('APPCODE', BASEPATH . $application_code_folder . PATH_DELIM);

define('MODELPATH', APPPATH . $models_folder . PATH_DELIM);
define('PRESENTERPATH', APPPATH . $presenters_folder . PATH_DELIM);
define('VIEWPATH', APPPATH . $views_folder . PATH_DELIM);

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

/**
 * TODO: Change database access to per app and per db connection
 */
define('DB_HOST', 'database host');
define('DB_LOGIN', 'database login');
define('DB_PASSWORD', 'database password');
define('DATABASE', 'database name');

define('AJAX_LINK_CLASS', 'ajaxLink');
define('PRESENTER_DEFAULT_METHOD', '_default');

$request_uri = $_SERVER['REQUEST_URI'];

// Just in case the requested URI has a trailing slash this removes it.
if(substr($request_uri, -1) == PATH_DELIM){
    $request_uri = substr($request_uri, 0, (strlen($request_uri) - 1) );
}
// $WEBPATH is the complete URL of the base diretory of this site, including whatever sub folder it my reside in.
//$WEBPATH = 'http://' . $_SERVER['HTTP_HOST'] . stristr($request_uri, SELF, true);
// The above code was commented out and the following line added because the above line uses stristr which is PHP 5.3 and above
$WEBPATH = 'http://' . $_SERVER['HTTP_HOST'] . str_replace(stristr($request_uri, PATH_DELIM . SELF), '', $request_uri) . '/';
define('WEBPATH', $WEBPATH);