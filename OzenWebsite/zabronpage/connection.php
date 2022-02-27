<?php


/**
 * summary
 */
class Connection
{   

   	 
    private $host;
    private $user;
    private $pass;
    private $name;
    private $conn;
    
    private function convar(){
    $this->host ="localhost";
    $this->user = "root";
    $this->pass = "5432";
    $this->name = "project";

    }
    public function getConnect(){
           $this->convar();
    	  $this->conn = mysqli_connect($this->host,$this->user,$this->pass,$this->name);
    	  
    	  if (mysqli_connect_error()) {
    	  	return "not connect";
    	  }
    	  else{
    	  	return $this->conn;
    	  }
    }
   

}











?>