<?php
namespace approot;



abstract class AppModel
{
    

    function __construct() {
        $this->beforeInit();
        $this->init();
        $this->afterInit();
    }

    protected function beforeInit()
    {

    }

    protected function init(){

    }


    protected function afterInit()
    {

    }


    abstract public function validation();

}



