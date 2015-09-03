<?php

class GroceryList implements ArrayAccess, Countable {
	  protected $_values = array();
	
    public function offsetExists($offset) {
	       return array_key_exists($offset, $this->_values);
    }

    public function offsetGet($offset) {
	       return $this->offsetExists($offset) ? $this->_values[$offset] : NULL;
    }

    public function offsetSet ($offset, $value) {
	      $this->_values[$offset] = $value;
    }

    public function offsetUnset ($offset) {
	       if ($this->offsetExists($offset)) unset($this->_values[$offset]);
    }

    public function count () {
	       return count($this->_values);
    }
	
    public function __destruct() {
	       $f = serialize($this->_values) ;
	       
	       //needed to resolve issue of php saving the file during file_put_contents
	       //to the SERVER root directory or some other random directory.
	       //Solved this by making the directory absolute based upon the location of the
	       //script that's running, it solves this issue
	       //solution found here - http://stackoverflow.com/questions/6629061/php-file-creation-write-within-destructor
	       $filename = dirname($_SERVER['SCRIPT_FILENAME']);
         file_put_contents($filename . '/groc', $f);
    }

   public function __sleep() {
	       $vars = array_keys(get_object_vars($this));
	       return $vars;
    }

    public function __wake() {
    }
}