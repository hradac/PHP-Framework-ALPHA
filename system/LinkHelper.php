<?php
/**
 * Description of LinkHelper
 *
 * @author Jason Zeiner
 *
 * Date May 1, 2011
 */
class LinkHelper {
    /**
     * This method echoes an HTML anchor tag for this application using the 
     * given presenter, function, and arguments. If none of those are supplied a 
     * link to the index.php page is given. Also returns the link as text.
     * 
     * @param type $presenter Optional presenter class.
     * @param type $function Optional method call of the presenter.
     * @param type $args Optional string or array with arguments for the above function.
     * @param type $ajaxLink Boolean value stating if a link will be used with AJAX.
     * @return string 
     */
    public static function url($text, $presenter = '', $function = '', $args = '', $ajaxLink = false){
        $link = '<a ';
        if($ajaxLink){
            $link .= 'class="' . AJAX_LINK_CLASS .'" ';
        }
        
        $href = 'href="' . WEBPATH . 'index.php';
        if($presenter != ''){
            $href .= "/{$presenter}";
        }
        if($function != ''){
            $href .= "/{$function}";
        }
        if($args != ''){
            if(is_array($args)){
                foreach ($args as $value) {
                    $href .= "/{$value}";
                }
            }else{
                $href .= "/{$args}";
            }
        }
        $href .= '"';
        $link .= $href . ">{$text}</a>";
        echo $link;
        return $link;
    }
}

?>
