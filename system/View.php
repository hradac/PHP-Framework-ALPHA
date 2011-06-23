<?php
/**
 * Description of View
 *
 * @author Jason Zeiner
 *
 * Date May 1, 2011
 */
class View {
    public $link;
    public function __construct() {
        require_once 'LinkHelper.php';
        $this->link = new LinkHelper();
    }
}

?>
