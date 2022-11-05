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
       
      $movieName =CleanInputs(Sanitize($_POST["title"],2));  
      $movieDescription=CleanInputs(Sanitize($_POST['description'],2));
      $category_id=CleanInputs(Sanitize($_POST['category_id'],1));

      $image = $_POST['OldImage'];
     $finalImage = $image;
       $id = CleanInputs(Sanitize($_POST['id'],1));
       $errorMessages=array();
    //validate Movie Name
   if(!Validator($movieName,1)){
      $errorMessages['movieName']="Movie Name field Required";
   }
  if(!Validator($movieName,2,4)){
    $errorMessages['moviename'] = "Movie Name length must be > 4 ";
  }
  //validate Id  
  if(!Validator($id,1)){
      $errorMessages['MovieId']="Movie id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['MovieId'] = "Movie Id must be integer number ";
      }
  //Validate BrandImage
    $imageName     = $_FILES['movieImage']['name'];
   if(Validator($imageName,1)){

      $nameArray = explode('.',$imageName);
      $FileExtension = strtolower($nameArray[1]);
      
      $newName = rand().time().'.'.$FileExtension;

 
   if(!Validator($imageName,1)){
    
    $errorMessages['image'] = "image Field Required";

  }
   if(!Validator($FileExtension,5)){
    
    $errorMessages['imageExtension'] = "Invalid Image Extension";

        }
      }

     if(count($errorMessages) == 0){
     
        if(Validator($imageName,1)){
       

        $fileTmp      = $_FILES['movieImage']['tmp_name'];
        $uplodeFolder = './uploads/';
        $desPath      = $uplodeFolder.$newName;


        
        if(move_uploaded_file($fileTmp,$desPath)){
          // 
         
           $finalImage = $newName;
      

          if(file_exists('./uploads/'.$image)){
             
             unlink('./uploads/'.$image);
          }

        }else{

          $errorMessages['imageMove'] = "Error in Upload Tru Again";

          }

      }
      
         $sql="UPDATE `movies` SET `title`='$movieName',`description`='$movieDescription',`category_id`='$category_id',`image`='$finalImage' WHERE `id`=". $id;
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
            header('Location: index.php');

   }

  }

   # Fetch movie
   $sql  ="SELECT * FROM `movies` WHERE `id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);
  //  fetch category
   $sql2="SELECT * FROM `categoreis`";
   $op2=mysqli_query($conn,$sql2);
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
                        
                        <li class="breadcrumb-item active">Edit Brand</li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
              <div class="form-group">
                     <label for="exampleInputEmail1">Enter Movie Name </label>
                     <input type="text" name="title" value="<?php echo $FData['title'];?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter movie Name ">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputDescr">Enter Movie Description</label>
                     <input type="text" name="description" class="form-control" value="<?php echo $FData['description'];?>" id="exampleInputDescr" aria-describedby=""
                         placeholder="Enter movie Description">
                  </div>
                
                  <div class="form-group">
                            <label for="exampleInput"> Movie Category</label>
                            <select name="category_id" class="form-control"> 
                                 <?php 
                                     while($data1 = mysqli_fetch_assoc($op2)){
                                  ?>
                              <option value="<?php echo $data1['id'];?>"  <?php if($data1['id'] == $FData['category_id'] ){ echo 'selected';}?> >
                              <?php echo $data1['title'];?></option>
                                   <?php } ?>
                            </select>  
                  </div>

                  <div class="form-group">
                        <label for="exampleInputEmail1">Upload Brand Image</label>
                         <br>
                        <input type="file" name="movieImage" >
                        <br>

                      <img src='./uploads/<?php echo $FData['image'];?>'  width="70px" >

                      <input type="hidden" name = "OldImage" value="<?php echo $FData['image'];?>">
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