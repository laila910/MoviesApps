<?php 

  include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/dbconnection.php';
 if($_SERVER['REQUEST_METHOD'] == "GET"){
   // LOGIC .... 
     $errorMessages = [];
     $id  = Sanitize($_GET['id'],1);
      if(!Validator($id,3)){
       $errorMessages['id'] = "Invalid ID";
      }else{
        // DB Opretaion ... 
        $sql = "DELETE FROM `categoreis` where `id` =".$id;
        $op = mysqli_query($conn,$sql);
        if($op){
            $errorMessages['Result'] = "deleted done";
        }else{     
        $errorMessages['Result'] = "error in delete operation";
        }
      }
     $_SESSION['errors'] =  $errorMessages;   
     header("Location: index.php");
 }



?>