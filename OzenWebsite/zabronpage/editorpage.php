<!DOCTYPE html>
<html>
<head>
  <title>Editorpage</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    body{
      background-image: url("https://previews.123rf.com/images/thodonal/thodonal1904/thodonal190401000/120670493-setting-and-network-connection-concept-on-dark-background.jpg");
      background-repeat: no-repeat;
      background-size: cover;
    }
    .section{
  margin: auto;
  margin-top: 20px;
  margin-bottom:20px;
  width: 70%;
  font-size: 25px;
 background-image: url("https://img.freepik.com/free-vector/white-abstract-background_23-2148810113.jpg?size=626&ext=jpg");
 background-repeat: no-repeat;
 background-size: cover;
  border-radius: 5px;
  padding: 20px;

}

  </style>
</head>
<body>

 
  <main  >
    <?php
  error_reporting(0);
require 'connection.php';
$name = $_POST['name'];
$description = $_POST['description'];
$image = $_POST['image'];
$price = $_POST['price'];
$add = $_POST['add'];


class Insert extends Connection
{
    private $conn;
    private $correct = 0;
    
    public function setCorrect($correct)
    {
        $this->correct = $correct;
        return $this->correct;
    }
    
    public function getCorrect()
    {
        return $this->correct;
    }

    public function DataInsert($name,$description,$image,$price)
   {
    $this->conn = $this->getConnect();
     if ($this->getCorrect() == 3) {
       $query2 ="INSERT INTO menu(name,description,url,price) 
         values('".$name."','".$description."','".$image."','".$price."');";
       mysqli_query($this->conn,$query2);
       echo "Success"; 
     }
   }
    
}
abstract class Check 
{
  
    abstract public function CheckForm($value);
    abstract public function SendMessage($value);
   
   

}

class CheckName extends Check
{   
  private $true = 0;
 
  public function setTrue($true)
  {
      $this->true = $true;
      return $this;
  }
  /**
   * @return type
   */
  public function getTrue()
  {
      return $this->true;
  }

    public function CheckForm($name){
      $c = 0;
     
      if(strlen($name) < 3){
    echo "is-invalid";
   }
   else {
     echo "is-valid";
     $c++;
     $this->setTrue($c);
     }
   
 }
    public function SendMessage($name){
      
      if(strlen($name) < 3){
    echo "Пожалуйста,напищите правильную имю!!!";
   }
      else {
        echo "";
      }
    
  }
}

class CheckDescription extends Check
{
  private $true = 0;
 
  public function setTrue($true)
  {
      $this->true = $true;
      return $this;
  }
  /**
   * @return type
   */
  public function getTrue()
  {
      return $this->true;
  }


  public function CheckForm($description){
    $c=0;
     
   if (strlen($description) < 20) {
  echo "is-invalid";
     }
   else {
       echo "is-valid";
       $c++;
       $this->setTrue($c);
     }
    
  }

  public function SendMessage($description)  {
   
     if (strlen($description) < 20) {
  echo "Информация должно составлять больше 20 букв!!!";
     }
   else {
       echo "";
     }
   
 }
   
  
}



class CheckPrice extends Check
{
 private $true = 0;
 
  public function setTrue($true)
  {
      $this->true = $true;
      return $this;
  }
  /**
   * @return type
   */
  public function getTrue()
  {
      return $this->true;
  }

   public function CheckForm($price)
   {
    $c=0;
     
    if (intval($price)==0) {
  echo "is-invalid";
     }
    else {
       echo "is-valid";
       $c++;
       $this->setTrue($c);
     }  
    }
   
   public function SendMessage($price)
   {
     
     if (intval($price)==0) {
  echo "Укажите правильную цену!!!";
     }
    else {
       echo "";
     }  
   
 }
}

$CheckName = new CheckName;
$CheckDescription = new CheckDescription;
$CheckPrice = new CheckPrice;
$Insert = new Insert;

?>
      <div class="section p-3 text-center w-50">
      <form action="" method="post">
        <label for = "topic"><h4>Name:</h4></label>
        <input type="text" name="name" class="form-control p-3 <?php $CheckName->CheckForm($name); ?>" id = "topic" 
        placeholder="Write a name" value="<?php echo $name; ?>">
        <div class="w-100 text-danger text-center"><?php $CheckName->SendMessage($name); ?></div>

        <label for="news" class="mt-4"><h4>Description:</h4></label>
        <textarea name="description" placeholder="Write a description..."
         class="form-control <?php $CheckDescription->CheckForm($description); ?>" rows="10" id="news" 
         style="resize: none;" ><?php echo $description; ?></textarea>
         <div class="w-100 text-danger text-center"><?php $CheckDescription->SendMessage($description); ?></div>

         <label for="image" class="mt-4">Write a URL of image:</label>
         <input type="text" name="image" class="form-control p-3" id="image" placeholder="URL"  value="<?php echo $image; ?>">

         <label for="price" class="mt-4">Write a Price(Tenge):</label>
         <input type="text" name="price" class="form-control p-3 <?php $CheckPrice->CheckForm($price); ?>" 
         id="price" placeholder="Price"  value="<?php echo $price; ?>">
          <div class="w-100 text-danger text-center"><?php $CheckPrice->SendMessage($price);?></div>

        <input type="submit" name="add" value="Add" class="w-25 p-3 rounded bg-success mt-4 mb-5 text-white">
        <br>
      </form>
    </div>
     </main>

<?php

$correctNum = $CheckName->getTrue()+$CheckDescription->getTrue()+$CheckPrice->getTrue();
$Insert->setCorrect($correctNum);
$Insert->DataInsert($name,$description,$image,$price);
echo($Insert->getCorrect());
?>


</body>
</html>