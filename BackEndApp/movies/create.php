<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/dbconnection.php';
include '../header.php';


if($_SERVER['REQUEST_METHOD']=='POST'){

      $movieName =CleanInputs(Sanitize($_POST["title"],2));  
      $movieDescription=CleanInputs(Sanitize($_POST['description'],2));
      $category_id=CleanInputs(Sanitize($_POST['category_id'],1));
      $movieImage     = $_FILES['movieImage']['name'];
  $errorMessages=array();
  //validate brand Name
   if(!Validator($movieName,1)){
      $errorMessages['MovieName']="Movie Name field Required";
   }
  if(!Validator($movieName,2,4)){
    $errorMessages['MovieName'] = "Movie Name length must be > 4 ";
  }
  //Validate Description
  if(!Validator($movieDescription,1)){
    $errorMessages['MovieDescription']="Movie Description field Required";
 }
if(!Validator($movieDescription,2,4)){
  $errorMessages['MovieDescription'] = "Movie Description length must be > 4 ";
}
 //Validate Category_Id
 if(!Validator($category_id,1)){
  $errorMessages['CategoryId']=" catgory id  field Required";
}
if(!Validator($category_id,3)){
  $errorMessages['CategoryId'] = " category must be integer number ";
}
  //validate brandImage 
   $nameArray = explode('.',$movieImage);
   $FileExtension = strtolower($nameArray[1]);
     if(!Validator($movieImage,1)){
      $errorMessages['MovieImage'] = " Movie image Field Required";
    }
    if(!Validator($FileExtension,5)){  
      $errorMessages['MovieImage'] = "Invalid Image Extension";
    } 
 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;
 }else{
      $tmp_path = $_FILES['movieImage']['tmp_name'];
       $FinalName = rand().time().'.'.$FileExtension;
       $disFolder = './uploads/';
       $disPath  = $disFolder.$FinalName;
     if(move_uploaded_file($tmp_path,$disPath))
       {
       $sql4 =  "INSERT INTO `movies`( `title`, `description`,`category_id`,`image`) VALUES ('$movieName','$movieDescription','$category_id','$FinalName')";
      $op4 = mysqli_query($conn,$sql4);
    if($op4){
        $errorMessages['Result'] = "Data inserted.";
    }else{
        $errorMessages['Result']  = "Error Try Again.";    
    }
     }else{
               $Message['Result'] = "Error In Uploading";
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
                       <li class="breadcrumb-item active"> Add New Movies</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Movie Name </label>
                     <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter movie Name ">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputDescr">Enter Movie Description</label>
                     <input type="text" name="description" class="form-control" id="exampleInputDescr" aria-describedby=""
                         placeholder="Enter movie Description">
                  </div>
                
                  <div class="form-group">
                            <label for="exampleInput"> Movie Category</label>
                            <select name="category_id" class="form-control"> 
                                 <?php 
                                 
                                    $sql="SELECT * FROM `categoreis`";
                                    $op=mysqli_query($conn,$sql);
                                     while($data1 = mysqli_fetch_assoc($op)){
                                  ?>
                              <option value="<?php echo $data1['id']?>">
                              <?php echo $data1['title'];?></option>
                                   <?php } ?>
                            </select>  
                  </div>

                  <div class="form-group">
                        <label for="exampleInputEmail1">Upload Movie Image</label>
                         <br>
                        <input type="file" name="movieImage"  >
                  </div>
                 <button type="submit" class="btn btn-primary">Create Movie</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>