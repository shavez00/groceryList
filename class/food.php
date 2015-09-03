<?php

class Food {
    private $description;
    private $UPC;
    private $category;
    private $nutrionalInfoId;
    private $foodId;
    private $food;
    private $dbh;
    
    public function __construct($description, $foodId = NULL) {
	      try {
		         $this->dbh = new \Simplon\Mysql\glDbMysql();
		         if (!$foodId) {
		             if(!$this->dbh->getRows("Food", array("description"=>$description))) {
		                  $this->dbh->insert("Food", array("description"=>$description));
		              }
		              $temp = $this->dbh->getRows("Food", array("description"=>$description));
				     }  else {
			            $temp = $this->dbh->getRows("Food", array("foodId"=>$foodId));
		              if (empty($temp)) throw new Exception("The food Id you are searching for does not exist. - Food.php - line 21");
		              if (!empty($description)) {
                       if ($temp[0]["description"] !== $description) throw new Exception("You have a mismatch between the Food Id and description you are searching for.");
                  }
             }
	      } catch (Exception $e) {
            echo $e->getMessage();
            die;
        }
        $this->food = (object)$temp[0];
	      $this->description = $this->food->description;
	      $this->UPC = $this->food->UPC;
	      $this->category = $this->food->category;
	      $this->nutritionalInfoId = $this->food->nutritionalInfoId;
	      $this->foodId = $this->food->foodId;
    }

    public function getFood() {
	      $values = [
	           "description"=>$this->description,
	           "UPC"=>$this->UPC,
	           "category"=>$this->category,
	           "nutritionalInfoId"=>$this->nutritionalInfoId,
	           "foodId"=>$this->foodId,
	            ];
	      return $values;
    }

    public function updateProperties(array $properties) {
        foreach ($properties as $k => $v) {
	          if ($k !== "UPC" && $k !== "category" && $k !== "description")throw new Exception("The property that you are trying to update does not exist - Food.php - line 51");
	          $response = $this->dbh->update("Food", ["foodId" => $this->foodId], $properties);
	          $this->$k = $v;
        }
    }

    public function __sleep() {
         $this->dbh = NULL;
	       $vars = array_keys(get_object_vars($this));
	       return $vars;
    }

    public function __wakeup() {
		    $this->dbh = new \Simplon\Mysql\glDbMysql();
    }
}