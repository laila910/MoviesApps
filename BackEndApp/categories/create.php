<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/dbconnection.php';
include '../header.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
   $categoryname =CleanInputs(Sanitize($_POST["title"],2));  
   $errorMessages=array();
   if(!Validator($categoryname,1)){
      $errorMessages['CategoryName']="Category Name field Required";
   }  
  if(!Validator($categoryname,2,2)){
    $errorMessages['categoryNameLength'] = "category name length must be > 4 ";
  }
 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;
 }else{
       $sql4 =  "INSERT INTO `categoreis`(`title`) VALUES ('$categoryname')";
      $op4 = mysqli_query($conn,$sql4);  
    if($op4){
        $errorMessages['Result'] = "Data inserted.";
    }else{
        $errorMessages['Result']  = "Error Try Again.";
     }
     $_SESSION['errors']=$errorMessages;
     header('Location: index.php');
     } 
    }
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
                                    foreach($_SESSION['errors'] as $key => $value){
                                             echo '* '.$key.' : '.$value.'<br>';
                                            
                                       }  unset($_SESSION['errors']);
                                     }else{        
                            ?>
                       <li class="breadcrumb-item active"> Add New Category</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Category Name</label>
                     <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Category Name ">
                 </div>
                 <button type="submit" class="btn btn-primary">Create Category</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>