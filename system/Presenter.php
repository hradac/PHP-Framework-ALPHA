<?php
/**
 * Generic Presenter object. All other Presenters should extend this file.
 *
 * @author Jason Zeiner
 *
 * Date May 1, 2011
 */
require_once APPCODE . 'AppObj.php';

class Presenter extends AppObj {
    private $subclass;      // Name of the subclass inheriting this class.
    protected $modelName;   // Models have the name of the inheriting class 
                            // with 'Model.php' after it.
    protected $model;       // This presenter's model instance.
    protected $view;        // Instance of this presenter's view.
    
    public function __construct($subclass) {
        $this->subclass = $subclass;
        $this->modelName = $subclass . 'Model';
        // I chose not to instantiate the model at this point to leave flexibility 
        // for the individual presenters which may not have a model, or may not 
        // use its model durring every operation.
        
        // I will however include the model file it is exists.
        $this->includeDB();
    }
    /**
     * This function will perform an include of $modelName if the file exists.
     * This is for the convenience of the inheriting classes of Presenter.
     * 
     * @return boolean 
     */
    private function includeDB(){
        if(file_exists(MODELPATH . $this->modelName . '.php')){
            require_once MODELPATH . $this->modelName . '.php';
            return true;
        }else{
            return false;
        }
    }
}

?>
