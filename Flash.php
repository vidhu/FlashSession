<?php
/**
 * Sets a Session variable which lasts only on access
 *
 * @author vidhu
 */
class Flash {

    private $flashVariables = array();
    private static $FlashClass;
    
   
    /**
     * Initiate the Library for use on the page
     */
    public function __construct() {
        self::$FlashClass = $this;

        if(isset($_SESSION['__FLASH_'])){
            $this->flashVariables = $_SESSION['__FLASH_'];
        }
        
        foreach ($this->flashVariables as $i => $fv){
            if($fv->isDisplayed == TRUE){
                unset($this->flashVariables[$i]);
            }
        }
    }

    /**
     * Sets a flash variable which is saved untill it is access
     * @param String $name Variable Name
     * @param Any $value Variable data
     */
    public function setFlash($name, $value){
        $fv = new FlashVariable($name, $value);
        array_push($this->flashVariables, $fv);
        $_SESSION['__FLASH_'] = $this->flashVariables;
    }
    
    /**
     * Gets the data from a Flash Variable
     * @param String $name Variable Name
     * @return null|any
     */
    public function getFlash($name){
        foreach ($this->flashVariables as $i => $fv){
            if($fv->name == $name){
                $this->flashVariables[$i]->isDisplayed = TRUE;
                return $fv->value;
            }
        }
        return null;
    }
    
    /**
     * Returns the Flash Library for use
     * @return Flash The previously initiated library
     */
    public static function getFlashFactory(){
        return self::$FlashClass;
    }
}

class FlashVariable{
    public $name;
    public $value;
    public $isDisplayed;
    
    public function __construct($name, $value) {
        $this->name = $name;
        $this->value = $value;
        $this->isDisplayed = FALSE;
    }
}
