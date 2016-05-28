<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;
    private $_controllerPath = 'controllers';
    private $_errorPath = 'error.php';
    private $_modelPath = 'models';

    public function __construct()
    {
        require_once 'app/controllers/error.php';
        
        $_url = $this->parseUrl();
        
        // Load the default (index) controller if no url is set
        if(empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }
        
        $this->_loadExistingController();
        
        // Check if ajax request:
        //  a. true: allow access to the method
        //  b. false: check if it begins with _:
        //    a. true: deny the user and quit
        //    b. false: proceed as normal

        if($this->isAjax() || $this->validateSecurity()){
            $this->_callControllerMethod();
        } else {
            $this->_error('No you don\'t');
        }
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $this->_url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    private function _loadDefaultController()
    {
        require 'app/controllers/index.php';
        $this->_controller = new Index();
        $this->_controller->index();
    }

    private function _loadExistingController()
    {
        $file = 'app/controllers/' . $this->_url[0] . ".php";
        if (file_exists($file)){
            require $file;
            $this->_controller = new $this->_url[0];
            $this->_controller->loadModel($this->_url[0]);
        } else {
            $this->_error('Sorry, looks like you took a wrong turn.');
            return false;
        }
    }

    private function _callControllerMethod()
    {
    /**
        * url[0] Controller  url[3] Param 2
        * url[1] Method      url[4] Param 3
        * url[2] Param 1
        *
        */
        $length = count($this->_url);

        // Default URL Rewrite
        switch ($length) {
            case 5:
                // Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            case 4:
                // Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;
            case 3:
                // Controller->Method(Param1)
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;
            case 2:
                // Controller->Method()
                $this->_controller->{$this->_url[1]}();
                break;
            default:
                $this->_controller->index();
                break;
        }
    }

    private function _error($msg = null)
    {
        $this->_controller = new Error();
        $this->_controller->index($msg);
        exit;
    }
    
    private function validateSecurity()
    {   
        $method = $this->_url[1];
        
        if(!isset($this->_url[1])){
            return true;
        } else {
            if(!method_exists($this->_controller, $this->_url[1])){
                return false;
            } elseif (substr($method,0,1) === '_'){
                return false;
            } 
        }
        
        return true;
    }
    
    private function isAjax()
    {
        // http://stackoverflow.com/questions/18260537/how-to-check-if-the-request-is-an-ajax-request-with-php
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {    
            return true;
        } else {
            return false;
        }
    }
}
