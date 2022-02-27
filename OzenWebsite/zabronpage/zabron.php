<!DOCTYPE html>
<html>
<head>
	<title>Zabron page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style type="text/css">
  	.c1{
  		width: 30%;
  	}
  	.sing{
  		font-size: 30px;
  	}
  	.counter{
  		width: 100%;
  	
  	}
  	.send{
  		width: 90%;
  		background-color: black;
  		border: 0px;
  		margin-top: 20px;
  	}
  	label{
  		margin-top: 10px;
  	}
  	.full-back{
  	 width: 100%;
  	 background-image: url("https://media-cdn.tripadvisor.com/media/photo-w/14/b6/c4/e9/check-in.jpg");
  	 backdrop-filter:blur(5px);
  	 background-size: cover;
  	}
  </style>
</head>
<body>
<?php


error_reporting(0);
$name = $_POST['name'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$time = $_POST['time'];
$countofperson = $_POST['countofperson'];
$comment = $_POST['comment'];
$send = $_POST['send'];

require("connection.php");

class Success extends Connection
{
    private $counter = 0;
    private $conn;

    public function getCounter()
    {
        return $this->counter;
    }
    
    public function setCounter($counter)
    {
        $this->counter = $counter;
        return $this->counter;
    }

    public function Insert($name, $phone, $date, $time, $countofperson, $comment){
     if ($this->counter == 5) {
       $this->conn = $this->getConnect();


      $mysql = "INSERT INTO reserve(client_name,client_phone,reserve_date,reserve_time,person_count,comments)
                  values('".$name."','".$phone."','".$date."','".$time."','".$countofperson."','".$comment."');";

                  $result = mysqli_query($this->conn,$mysql);


       header("Location:https://www.google.com/");
       
     }
    }
}


interface Check{
  public function CheckForm($inputvalue, $submit);
  public function SendMessage($inputvalue, $submit);
  
}

class NameCheck extends Success implements Check
{   

     private $trueNum = 0;
    public function setTrue($trueNum){
      $this->trueNum = $trueNum;
    }
   
    public function getTrue()
    {
        return $this->trueNum;
    }

    public function CheckForm($name, $send)
    { 
       $c = 0;
     if(isset($send)){

          if (strlen($name)<3) {
          echo "is-invalid";
         }
         else {
           echo "is-valid";
           $c++;
           
         }
   }
   $this->setTrue($c);


}
   
    public function SendMessage($name, $send)
    {
      if(isset($send)){

          if (strlen($name)<3) {
         echo "Укажите пожалуйста, правилную имю!!!";
         }
        else {
          echo "";
        }

     }
  
  }


}


class PhoneCheck extends Success implements Check
{
    private $trueNum = 0;

    public function setTrue($trueNum){
      $this->trueNum = $trueNum;
    }
   

    public function getTrue()
    {
        return $this->trueNum;
    }


   public function CheckForm($phone, $send)
   {
    $c=0;
    if(isset($send)){
         if (strlen($phone)<11||intval($phone)==0) {
             echo "is-invalid";
           }

         else {
           echo "is-valid";
           $c++;
           
          }
     }
     $this->setTrue($c);
   }
   public function SendMessage($phone, $send){

    if(isset($send)){
    if (strlen($phone)<11||intval($phone)==0) {
     echo "Укажите пожалуйста, правилный номер телефона!!!";
     }

      else {
     echo "";
       }
    }

   }

  

}


class DateCheck extends Success implements Check
{  
    private $trueNum = 0;

    public function setTrue($trueNum){
      $this->trueNum += $trueNum;
    }
   
    public function getTrue()
    {
        return $this->trueNum;
    }

     public function CheckForm($date, $send)
   {
    $c = 0;
    if(isset($send)){
       if ($date == "") {
        echo "is-invalid";
      }
      else {
        echo "is-valid";
        $c++;
        
      }
    }
    $this->setTrue($c);
   }
   public function SendMessage($date, $send){
    
    if(isset($send)){
             if ($date == "") {
          echo "Заполните эту полю!!!";
        }
        else {
          echo "";
        
        }
     }

   }

  
    
}

class TimeCheck extends Success implements Check
{  
    private $trueNum = 0;

    public function setTrue($trueNum){
      $this->trueNum += $trueNum;
    }
   
    public function getTrue()
    {
        return $this->trueNum;
    }

     public function CheckForm($time, $send)
   {
    $c = 0;
    if(isset($send)){
       if ($time == "") {
        echo "is-invalid";
      }
      else {
        echo "is-valid";
        $c++;
        
      }
    }
    $this->setTrue($c);
   }
   public function SendMessage($time, $send){
    
    if(isset($send)){
             if ($time == "") {
          echo "Заполните эту полю!!!";
        }
        else {
          echo "";
        
        }
     }

   }

  
    
}


class PersonCheck extends Success implements Check
{   

    private $trueNum = 0;

    public function setTrue($trueNum){
      $this->trueNum = $trueNum;
    }
   
    public function getTrue()
    {
        return $this->trueNum;
    }
    
     public function CheckForm($countofperson, $send){
     $c = 0;
     if(isset($send)){

             if (strlen($countofperson)==0||intval($countofperson)>50) {
            echo "is-invalid";
         } 

         else{
           echo "is-valid";
           $c++;
          
         }

     }
     $this-> setTrue($c);

   }
   public function SendMessage($countofperson, $send){
    
    if(isset($send)){
       
         if (strlen($countofperson)==0) {
            echo "Заполните эту полю!!!";
         } 
         elseif (intval($countofperson)>50) {
           echo "Простите но вы не можете забранировать столь больше 50 человек!!!";
         }
         else{
           echo "";
         }
     
     }

   }


}



$NameCheck = new NameCheck;
$PhoneCheck = new PhoneCheck;
$DateCheck = new DateCheck;
$TimeCheck = new TimeCheck;
$PersonCheck = new PersonCheck;



?>
<div class="full-back">
	<br><br>
	<div class="container c1 bg-white rounded">
		<form action="" method="post" >
			<br>
			<div class="w-100 text-center"><h2>Забронируйте стол</h2></div>
		        <label for="name">Имя</label>
            <input type="text" name="name" id="name" 
            class="form-control p-2 <?php  $NameCheck -> CheckForm($name, $send) ; ?> "  placeholder="Имя" value="<?php echo $name; ?>">
            <div class="form-control-feedback text-danger"><?php  $NameCheck -> SendMessage($name, $send); ?></div>
            
            <label for="phone">Телефон</label>
            <input type="tel" name="phone" id="phone" 
            class="form-control p-2 <?php  $PhoneCheck -> CheckForm($phone, $send); ?>" value="<?php echo $phone; ?>"> 
            <div class="form-control-feedback text-danger"><?php  $PhoneCheck-> SendMessage($phone, $send); ?></div>
            
            <label for="date">Дата</label>
            <input type="Date" name="date" id="date" 
            class="form-control p-2 <?php  $DateCheck -> CheckForm($date, $send); ?>" value="<?php echo $date; ?>" >
            <div class="form-control-feedback text-danger"><?php  $DateCheck -> SendMessage($date, $send); ?></div>
            
            <label for="time">Время</label>
            <input type="time" name="time" id="time" 
            class="form-control p-2 <?php  $TimeCheck -> CheckForm($time, $send); ?>" value="<?php echo $time; ?>" >
            <div class="form-control-feedback text-danger"><?php  $TimeCheck -> SendMessage($time, $send); ?></div>
            
            <label for="countofperson">Количуство персон</label><br>
            <input type="number" name="countofperson" id="countofperson" 
            class="p-2 counter form-control w-25 <?php  $PersonCheck -> CheckForm($countofperson, $send); ?>" value="<?php echo $countofperson; ?>" min="1">
             <div class="form-control-feedback text-danger"><?php  $PersonCheck -> SendMessage($countofperson, $send); ?></div>

            <label for="Comment">Комментария</label>
            <input type="text" name="comment" id="comment" class="form-control p-2" placeholder="Коментария" value="<?php echo $comment; ?>">

           <div class="w-100 text-center"> <input type="submit" name="send" id="send" class="rounded text-white p-2 send" value="Забронировать"></div>
           <br><br>
		</form>
	</div>
	<br><br>
</div>
<br>
<br>
<?php
    $sum = $NameCheck->getTrue() + $PhoneCheck->getTrue() + $DateCheck->getTrue()+ $TimeCheck->getTrue()+$PersonCheck->getTrue();
  
  $success = new Success;

  $success -> setCounter($sum);

  $success->Insert($name,$phone,$date,$time,$countofperson,$comment);
  

?>
</body>
</html>
