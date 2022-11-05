<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/dbconnection.php';
include '../header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userName = CleanInputs(Sanitize($_POST["name"], 2));
  $userEmail = CleanInputs($_POST["email"]);
  $userBirthDate=$_POST['birthDate'];
  

  $errorMessages = array();
  //validate user name
  if (!Validator($userName, 1)) {
    $errorMessages['userName'] = "User Name field Required";
  }
  if (!Validator($userName, 2, 4)) {
    $errorMessages['UserName'] = "User Name length must be > 4 ";
  }
//validate Email
if (!Validator($userEmail, 1)) {
  $errormessages['email'] = "Email field Required";
}
if (!Validator($userEmail, 4)) {
  $errormessages['email'] = "Invalid Email";
}
//validate Birth Date
if (!Validator($userBirthDate, 1)) {
  $errorMessages['userBirthDate'] = "User Birth Date field Required";
}
if(!validateDate($userBirthDate,'Y-m-d')){
  $errorMessages['userBirthDate']='user birth date is invalid';
}
  if (count($errorMessages) > 0) {
    $_SESSION['errors'] = $errorMessages;
  } else {
    $sql4 =  "INSERT INTO `users`( `name`, `email`, `birthDate`) VALUES ('$userName','$userEmail','$userBirthDate')";
    $op4 = mysqli_query($conn, $sql4);
    if ($op4) {
      $errorMessages['Result'] = "Data inserted.";
    } else {
      $errorMessages['Result']  = "Error Try Again.";
    }
    $_SESSION['errors'] = $errorMessages;
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
            if (isset($_SESSION['errors'])) {
              foreach ($_SESSION['errors'] as $key => $value) {
                echo '* ' . $key . ' : ' . $value . '<br>';
              }
              unset($_SESSION['errors']);
            } else {
            ?>
              <li class="breadcrumb-item active"> Add New User</li>
            <?php  } ?>
          </ol>
          <div class="container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputname">Enter User Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputname" aria-describedby="" placeholder="Enter Name">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter User Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="" placeholder="Enter Email">
              </div>
              <div class="form-group">
                <label for="exampleInputDate">Enter User Birth Date</label>
                <input type="date" name="birthDate" class="form-control" id="exampleInputDate" aria-describedby="" placeholder="Enter Birth Date">
              </div>
              <button type="submit" class="btn btn-primary">Create User</button>
            </form>
          </div>

        </div>
      </main>
      <?php
      include '../footer.php';
      ?>