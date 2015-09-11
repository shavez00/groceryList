<?php
/*  GroceryList class
* + = public function/property
* - = private function/property
* x = proteced function/proptery
*
* The GroceryList class extends tge ArrayAccess interface
* and the Count interface.  Using the ArrayAccess interface
* new food objects can be added to the class.  The preferred
* format is array("description", array("quantity"=>$x, $foodId=>(object)food).
*  The count interface is used to get a quick count of the number 
* of food objects in the list.  To remove an item off the list
* you can use "unset$x["description"]".  To update an item
* just reference the description of the item in the list and change
* the properties.
*
* The class contains four properties: 
* - $_glArray - holds the metadata of the list 
* (groceryListId/userId/groceryList).  Can be initated 
* by a database dip.
* - $_values - holds the list of food objects and the quantity
* of items in the grocery list
* - $_update - Boolean switch to designate wether the grocery
* list has been updated abd needs to be saves on destruct.
* - $dbh - holds an instance of tge glDbMysql object for 
* database access
* 
* The class contains ten methods:
* +  offsetExists($offset), offsetGet($offset), offsetSet ($offset, $value), 
* offsetUnset ($offset),  count () - inherited from ArrayAccess
*and Count interfaces.
* + save($userId) - save grocerylist metadata (groceryListId/
* userId/groceryList) to the database.
* + __construct($groceryListId, $userId) - initiaizes arrays from
* database dip or cached file.
* + __destruct - is $_update is set, write cache file.
*/

class GroceryList implements ArrayAccess, Countable {
	  private $_values = array();
	  private $_update = FALSE;
	  private $_glArray;
	  private $dbh;
	
	  public function __construct($groceryListId = NULL, $userId = NULL) {
		    $filename = dirname($_SERVER['SCRIPT_FILENAME']);

		    //if ($groceryListId == NULL && $userId == NULL) throw new Exception("Please input a Grocery List Id or User Id to search for. - grocerylist.php - line 10");

		    $this->dbh = new \Simplon\Mysql\glDbMysql();

		    if ($groceryListId || $userId) {
		        if ($groceryListId) {
					      $glArray = $this->dbh->getRows("GroceryList", array("groceryListId"=>$groceryListId));
					      $this->_glArray = $glArray[0];
					      if ($this->_glArray == NULL) throw new Exception("Grocery list Id searched for not found - grocerylist.php - line 16");
					      if ($userId != NULL) {
						        if ($this->_glArray[0]["userId"] != $userId) throw new Exception ("There is a mismatch between the Grocery List Id supplied and the User Id, please resolve.  - grocerylist.php - line 18");	
						    }
						    $this->_values = unserialize($this->_glArray["groceryList"]);
				    }  elseif ($userId) {
					      $glArray = $this->dbh->getRows("GroceryList", array("userId"=>$userId));
					      $this->_glArray = $glArray[0];
					      if ($this->_glArray == NULL) throw new Exception("User Id searched for not found - grocerylist.php - line 22");
					       $this->_values = unserialize($this->_glArray["groceryList"]);
					  }
			  } elseif(file_exists($filename . '/gl.dat')) {
           $f = file_get_contents($filename . '/gl.dat');
           $this->_values = unserialize($f) ;
           $fh = fopen($filename . '/gl.dat', 'w');
           fclose($fh);
           unlink($filename . '/gl.dat');
			  }
			  var_dump($this->_glArray);
	  }
	
    public function offsetExists($offset) {
	       return array_key_exists($offset, $this->_values);
    }

    public function offsetGet($offset) {
	       return $this->offsetExists($offset) ? $this->_values[$offset] : NULL;
    }

    public function offsetSet ($offset, $value) {
	      $this->_values[$offset] = $value;
	      $this->_update = TRUE;
    }

    public function offsetUnset ($offset) {
	       if ($this->offsetExists($offset)) {
		         unset($this->_values[$offset]);
	       } else {
		          throw new Exception ("Item does not exist in Grocery List - groceryList.php - line 57");
	       }
    }

    public function count () {
	       return count($this->_values);
    }

    public function save($userId = NULL) {
	      if ($this->_glArray) {
		        $this->dbh->update("GroceryList", array("groceryListId"=>$this->_glArray["groceryListId"]), array("groceryList"=>serialize($this->_values)));
		    } else {
			      $this->dbh->insert("GroceryList", array("userId"=>$userId, "groceryList"=>serialize($this->_values)));
		    }
	      //$this->dbh->getRows("GroceryList", array("groceryListId"=>$groceryListId));
    }
	
    public function __destruct() {
	       if ($this->_update == TRUE) {
	            $f = serialize($this->_values) ;
	       
	            //needed to resolve issue of php saving the file during file_put_contents
	            //to the SERVER root directory or some other random directory.
	            //Solved this by making the directory absolute based upon the location of the
	            //script that's running, it solves this issue
	            //solution found here - http://stackoverflow.com/questions/6629061/php-file-creation-write-within-destructor
	            $filename = dirname($_SERVER['SCRIPT_FILENAME']);
              file_put_contents($filename . '/gl.dat', $f);
         }
    }

   public function __sleep() {
	       $vars = array_keys(get_object_vars($this));
	       return $vars;
    }

    public function __wakeup() {
    }
}