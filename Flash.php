<?php
/**
 * Sets a Session variable which lasts only on one page request
 *
 * @author vidhu
 */
class Flash {

    private $flashVariables = array();
    private static $FlashClass;
    
   

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

    public function setFlash($name, $value){
        $fv = new FlashVariable($name, $value);
        array_push($this->flashVariables, $fv);
        $_SESSION['__FLASH_'] = $this->flashVariables;
    }
    
    public function getFlash($name){
        foreach ($this->flashVariables as $i => $fv){
            if($fv->name == $name){
                $this->flashVariables[$i]->isDisplayed = TRUE;
                return $fv->value;
            }
        }
        return null;
    }
    
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
