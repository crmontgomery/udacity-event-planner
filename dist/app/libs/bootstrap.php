<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;
    private $_controllerPath = 'controllers';
    private $_errorPath = 'models';
    private $_modelPath = 'error.php';

    public function __construct()
    {
        $_url = $this->parseUrl();

        // load the default controller if no url is set
        if(empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }

        $this->_loadExistingController();
        $this->_callControllerMethod();
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
            $this->_error();
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

    private function _error()
    {
        require 'app/controllers/error.php';
        $this->_controller = new Error();
        $this->_controller->index();
        exit;
    }
}
