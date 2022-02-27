<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
	/**{
		border:1px solid black;
	}*/
	.foodinfo{
		height: 120px;
	}
	.foodname{
         font-size: 30px;
         margin-bottom: 0px;
         padding-bottom: 0px;
	}
	.image {
  display: block;
  width: 100%;
 
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: #5c5c5cae;

}

.imgcontainer:hover .overlay {
  opacity: 1;
}

.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;

}
body{
	background-color: #e8e8e8;
}
</style>
</head>
<body>
<main>
	<div class="container-fluid row">
	<?php
      
   
   require 'connection.php';
 
   class Food 
   {
      public function Template($name,$description,$url,$price)
       {
       	echo '<div class="col-lg-4">';
       	echo '<div class="rounded row p-4 imgcontainer">
     				<div class="col-lg-12 p-0"><img src="'.$url.'" width="100%" height="340px" class="image">
                     <div class="overlay">
                     <div class="text">'.$description.'</div>
                    </div>
     				</div>
     			
     				<div class="col-lg-12 p-3 foodinfo">

                      <div class="foodname">'.$name.'</div><br>
                      <div class="footpeice">'.$price.' T</div>
     				</div>
     			</div>';
        echo '</div>';			
       }
   }

   

   
   class Select extends Connection
   {   
   	   private $conn;
      public function getElement()
      {
      	$this->conn = $this->getConnect();

      $sql = "SELECT name,description,url,price FROM menu ORDER BY id ASC";
      $result = mysqli_query($this->conn,$sql);
      $article = mysqli_fetch_all($result,MYSQLI_NUM);
      return $article;
      }
   }

   
   $select =new Select;
   $food = new Food;


   $arr = $select->getElement();
    
   $size = count($arr);
   $s = 0;
    for ($i = 0; $i < $size/3; $i++) {
    	echo '<div class="col-lg-1"></div>
     	<div class="col-lg-10 row p-0 m-0">';
     	   for ($j = 0; $j < 3; $j++) {
     	   	$food->Template($arr[$s][0],$arr[$s][1],$arr[$s][2],$arr[$s][3]);
     	   	$s++;
     	   }
     		
     	
     	echo '	</div>
     	<div class="col-lg-1"></div>';
    }


	?>
   </div> 
</main>
</body>
</html>
