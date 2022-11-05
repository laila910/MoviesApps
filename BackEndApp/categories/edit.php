<?php 
    
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/dbconnection.php';
   $id = '';
   if($_SERVER['REQUEST_METHOD'] == "GET"){
    // LOGIC .... 
      $errorMessages = [];
      $id  = Sanitize($_GET['id'],1);
       if(!Validator($id,3)){
        $errorMessages['id'] = "Invalid ID";
        $_SESSION['errors'] = $errorMessages;
       header("Location: index.php");
       }
    }
   if($_SERVER['REQUEST_METHOD'] == "POST"){    
      $categoryname =CleanInputs(Sanitize($_POST["title"],2));  
       $id  = CleanInputs(Sanitize($_POST['id'],1));
       $errorMessages=array();
     //validate category Name
   if(!Validator($categoryname,1)){
      $errorMessages['CategoryName']="Category Name field Required";
   } 
  if(!Validator($categoryname,2,4)){
    $errorMessages['CategoryName'] = "category name length must be > 4 ";
  }
 //Validate category  Id 
  if(!Validator($id,1)){
      $errorMessages['categoryid']=" catgory id  field Required";
   }
  if(!Validator($id,3)){
      $errorMessages['categoryid'] = " category must be integer number ";
   }
     if(count($errorMessages) == 0){
         $sql="UPDATE `categoreis` SET `title`='$categoryname' WHERE `id`='$id'";
         $op = mysqli_query($conn,$sql);
       if($op){
            $errorMessages['Result'] = "Data updated.";
       }else{
            $errorMessages['Result']  = "Error Try Again.";
         }
        $_SESSION['errors'] = $errorMessages;
        header('Location: index.php');
     }else{
       $_SESSION['errors'] = $errorMessages;
   }
  }
   # Fetch product
   $sql1  =" SELECT `id`, `title` FROM `categoreis` WHERE `id`= ".$id;
   $op1  = mysqli_query($conn,$sql1);
   $FData = mysqli_fetch_assoc($op1);
    include '../header.php';
?>
  <body class="sb-nav-fixed">   
<?php 
    include '../nav.php';
?>  
<div id="layoutSidenav">        
<?php 
    include '../sidNave.php';
?>  
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                        <?php 
                            if(isset($_SESSION['errors'])){
                               foreach($_SESSION['errors'] as $key =>  $value){
                                echo '* '.$key.' : '.$value.'<br>';
                               }
                             unset($_SESSION['errors']);
                             }else{
                        ?>
                        <li class="breadcrumb-item active">Edit category </li>
                        <?php } ?>
                        </ol>
                       <div class="container">
                <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Category Name</label>
                     <input type="text" name="title"  value="<?php echo $FData['title']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Category Name ">
                 </div>               
                      <input type="hidden" name="id" value="<?php echo $FData['id'];?>">
                     <button type="submit"  name="submit"class="btn btn-primary">Submit</button>
                 </form>
               </div>
              </div>
              </main>   
 <?php
include '../footer.php';
 ?>