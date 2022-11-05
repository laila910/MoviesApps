<?php
include './helpers/functions.php';
include './helpers/dbconnection.php';
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email    = CleanInputs($_POST['email']);
    $password = $_POST['password'];
    $errormessages = [];
    # Validate Inputs .... 
    if (!Validator($email, 1)) {
        $errormessages['emailRequired'] = "Email field Required";
    }
    if (!Validator($email, 4)) {
        $errormessages['email'] = "Invalid Email";
    }
    if (!Validator($password, 1)) {
        $errormessages['passwordRequired'] = "Password field Required";
    }
    if (!Validator($password, 2)) {
        $errormessages['passwordLength'] = "Password length must be >= 6";
    }
    if (count($errormessages) == 0) {
        //check with admin data 
       if($email=='laila_ebrahim975@yahoo.com' && $password=='123456'){
         $data=["email"=>$email,"password"=>$password];
         $_SESSION['User'] = $data;
         header("Location: index.php");
       } else {
            $errormessages['messages'] = "Error in Login Try Again!!!";
        }
    }
    if (count($errormessages) > 0) {
        $_SESSION['errors'] = $errormessages;
    }
}


?>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>

                                <?php
                                # Display Error Messages ... 
                                if (isset($_SESSION['errors'])) {
                                    foreach ($_SESSION['errors'] as $data) {
                                        echo '* ' . $data . '<br>';
                                    }
                                    unset($_SESSION['errors']);
                                }
                                ?>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" placeholder="Enter email address" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" />
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <input type="submit" class="btn btn-primary " value="Login">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Dashboard 2022 By L.I</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo url('js/scripts.js'); ?>"></script>
</body>

</html>