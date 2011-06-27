<?php
//ini_set('display_errors', 'On');
session_start();

$REDIRECT = '';
$PAGE_TITLE = ''; // Title for the page, used in template.php

$application_folder         = 'application';
$application_code_folder    = 'appCode';
$models_folder              = 'models';
$presenters_folder          = 'presenters';
$views_folder               = 'views';
$system_folder              = 'system';



# -- Start path determination code --

// The following code is used to determine what to display (i.e. which 
// presenter, and which function of that presenter to use)


// $_PATH is an array of entries that come after index.php
$_PATH = explode(PATH_DELIM, substr(stristr($request_uri, SELF), strlen(SELF . PATH_DELIM)));

# -- End path determination code --

# -- Setup Database Connection --
$_DB = connectToDB();
function connectToDB(){
    require_once SYSTEM . 'DatabaseConnection.php';
    return new DatabaseConnection();
}
# -- End Database Connection --

/**
 * Set the $PAGE_TITLE variable that is used in template.php.
 * The text becomes the web page title.
 * @param type $title String
 */
function pageTitle($title){
    $GLOBALS['PAGE_TITLE'] = $title;
}
/**
 * Sets the $REDIRECT variable to the URL passed in.
 * @param type $url String
 */
function redirect($url){
    $GLOBALS['REDIRECT'] = $url;
}



# -- Start page direction code (traffic cop) --
// Start an output buffer, it will store all outputs so it can be stored in a variable.
ob_start();

// If there is a path to goto
if(!empty($_PATH)){
    // Find if first element in $_PATH corresponds to an actual presenter,
    // if not, then go to 404
    $presenterName = $_PATH[0];
    // Full file system path to the presenter
    $presenter = PRESENTERPATH . $presenterName . '.php';
    
    if(file_exists($presenter)){
        require_once $presenter;
        // Instantiate presenter
        $pres = new $presenterName();
        
        // Call optional function, with optional argument(s)
        if(isset($_PATH[1]) && !empty($_PATH[1])){
            // Get arguments from $_PATH
            // Arguments exist after the second item in the $_PATH array.
            $args = (count($_PATH) > 2) ? array_slice($_PATH, 2) : null;
            
            // Call function with optional argument(s)
            $method = $_PATH[1];
            
            if(method_exists($pres, $method)){
                if(count($args) == 0){
                    $output = $pres->$method();
                }else{
                    // Build a PHP statement as a string then eval.
                    // I know of no better way to achieve this with an arbitrary 
                    // number of arguments being passed.
                    $eval = '$pres->$method(';
                    foreach ($args as $value) {
                        $eval .= "'{$value}', ";
                    }
                    // Remove trailing space and comma.
                    $eval = substr($eval, 0, -2);
                    $eval .= ');';
                    eval($eval);
                }
            }else{
                show404();
            }
        }else{
            // Calls a default method in the presenter if no method was passed through the address entered
            if(method_exists($pres, PRESENTER_DEFAULT_METHOD)){
                $def = PRESENTER_DEFAULT_METHOD;
                $pres->$def();
            }else{
                show404();
            }
        }
    }else{
        // Goto 404 page here
        // If a URL was entered beyond index.php that was not found
        if(!empty ($presenterName)){
            show404();
        }else{
            include_once VIEWPATH . 'Default.php';
        }
    }
}
require_once SYSTEM . 'LinkHelper.php';
$link = new LinkHelper();

// If a redirect is requested perform that instead of the output
if(empty($REDIRECT)){
    // Store contents of output buffer into $output
    $output = ob_get_contents();
    // End output buffer
    ob_end_clean();
}else{
    ob_end_clean();
    header('Location: ' . $REDIRECT);
    exit;
}
    
# -- End page direction code --

function show404($message = "404'd!"){
    // TODO: finish this method!
    echo $message;
    // TODO: Remove or comment when deployed
    // debug_print_backtrace();
}

# -- Check if AJAX is trying to access the page --
$isAJAX = FALSE;
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    $isAJAX = TRUE;
}
# -- End AJAX check --

# -- Display contents --
if($isAJAX){
    echo $output;
}else{
    require_once 'template.php';
}
# -- End display contents --

