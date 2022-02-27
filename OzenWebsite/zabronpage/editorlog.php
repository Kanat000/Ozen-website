<!DOCTYPE html>
<html>
<head>
  <title>Log in</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <style type="text/css">
     

body{
  padding: 0px;
  margin: 0px;
   background-color: white;
}

main{
  height: 650px;
  padding-top:100px; 
}


/**{
  border:1px solid black; 
}
*/

.send{
  width: 20%;
  border: 0px;
  border-radius: 5px;
  background-color: #3856eb;
  color: white;
  padding: 10px;
}
.c1{
  width: 40%;
  padding: 20px 50px 20px 50px;
  background-color: #5465ff;
  margin-top: 100px;
  border-radius: 10px;

}

.form{
  background-color: #f7e859;
  color: white;
  padding: 10px;
  border-radius: 10px;
}
label{
  font-size: 15px;
  color: #2d7ffa;
  font-weight: 600;
}
   </style>
</head>
<body>
 
 <main>
  <?php

  require_once('connection.php');

  interface CheckClass{
    public function Check($inputname,$pass); 
  }
 
   class CheckLogin extends Connection implements CheckClass
  {    
     
       private $conn;
      public function Check($inputname,$pass)
      {    
          $this->conn = $this->getConnect();

          $query = "SELECT login FROM  menueditor";
          $result = mysqli_query($this->conn,$query);
          $arr = mysqli_fetch_all($result,MYSQLI_NUM);
          $b = 0;
          for ($i = 0; $i < count($arr); $i++) {
            
              if (strcmp($inputname, $arr[$i][0]) == 0) { 
              
               $query2 = "SELECT pass FROM menueditor WHERE login = '".$inputname."';";
               $result2 = mysqli_query($this->conn,$query2);
               $arr2 = mysqli_fetch_all($result2,MYSQLI_NUM);
               $c = 0;
               for ($l = 0; $l < count($arr2); $l++) {
                 if (strcmp($pass, $arr2[$l][0])==0) {
                   setcookie($inputname,$pass,time()+3600);
                   if(!isset($_COOKIE[$inputname])) {
                       echo "Cookie named '" . $inputname . "' is not set!";
                     } else {
                      echo "Cookie '" . $inputname . "' is set!<br>";
                   echo "Value is: " . $_COOKIE[$inputname];
                  }
                   
                   /*header("Location:http://localhost/zabronpage/editorpage.php");   */       
                 }
                 else{
                   echo 'Password is wrong!!!';
                 }
               }
            
              }
              else {
                $b++;
              }

            
          }
          if ($b>=count($arr)) {
            echo 'Login is wrong!!!';
          }
          
        }
          
      
  }





?>
  <div class="container c1 mt-5" >
    <div class="w-100 text-center text-white"><h3>Log in</h3></div>
 <form action="" method="post" class="row form">
 
    <label class="col-lg-12 mt-3" for="uname">Username:</label>
    <input type="text" name="loguname"  class="form-control"  id = "uname"placeholder="Enter Username...">
    <div class="col-lg-12 text-danger"><?php /*echo $login_error*/;?></div>
     <label class="col-lg-12 mt-3" for="password">Password:</label>
     <input type="password" name="logpass" id="password"  class="form-control">
     
   
     <div class="w-100 text-center mt-3"><input type="submit" name="send" value="submit" class="send"></div><br>
     <div class="w-100 text-center mt-3 text-danger">
      <?php
      error_reporting(0);
   $log_login = $_POST['loguname'];
   $log_pass = $_POST['logpass'];


   $checklogin = new CheckLogin;

   echo '<div class="col-lg-12">';
   $checklogin->Check($log_login,$log_pass);
  echo '</div>';


  ?>
</div>
 </form>
</div>



 </main>


 


</body>
</html>