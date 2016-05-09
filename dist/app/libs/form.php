<?php

require '/form/val.php';

class Form
{
    private $_currentItem = null;
    private $_postData = array();
    private $_val = array();
    private $_error = array();

    public function __construct()
    {
        $this->_val = new Val();
    }

    //Posting
    public function post($field)
    {
        $this->_postData[$field] = $_POST[$field];
        $this->_currentItem = $field;

        return $this;
    }

    public function fetch($fieldName = false)
    {
        if ($fieldName) {
            if (isset($this->_postData[$fieldName])) {
                return $this->_postData[$fieldName];
            } else {
                return false;
            }
        } else {
            return $this->_postData;
        }
    }

    //validation
    public function val($typeOfValidator, $arg = null)
    {

        if ($arg == null) {
            $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem]);
        } else {
            $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem], $arg);
        }

        if ($error) {
            $this->_error[$this->_currentItem] = $error;
        }

        print_r($this->_error);

        return $this;
    }

    public function submit() {
        if (empty($this->_error)) 
        {
            return true;
        } 
        else 
        {
            $str = '';
            foreach ($this->_error as $key => $value)
            {
                $str .= $key . ' => ' . $value . "\n";
            }
            throw new Exception($str);
        }

    }
}
