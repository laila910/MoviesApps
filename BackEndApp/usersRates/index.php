<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/dbconnection.php';
$sqlUser="SELECT * FROM `users`";
$opUser=mysqli_query($conn,$sqlUser);
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
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <?php
                        if (isset($_SESSION['errors'])) {
                            foreach ($_SESSION['errors'] as $key =>  $value) {
                                echo '* ' . $key . ' : ' . $value . '<br>';
                            }
                            unset($_SESSION['errors']);
                        } else {
                        ?>
                            <li class="breadcrumb-item"><a href="<?php echo  url('index.php'); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Rates Data</li>
                        <?php } ?>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                             User Rates Table  
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name </th>
                                            <th>Movie Names & Rates Given</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // while ($result = mysqli_fetch_assoc($op)) {
                                            while($UsersData=mysqli_fetch_assoc($opUser)){
                                        ?>
                                            <tr>
                                                <td><?php echo $UsersData['id'];?></td>
                                                <td><?php echo $UsersData['name']; ?></td>
                                               
                                                <td><?php
                                                $sqlMovieRate="SELECT `title`,`rates`.`rate` as `Rate` FROM `movies` JOIN `rates` ON `movies`.`id`=`rates`.`movie_id` WHERE `rates`.`user_id`=".$UsersData['id'];
                                                $opMovieRate=mysqli_query($conn,$sqlMovieRate);
                                            
                                                  if (mysqli_num_rows($opMovieRate)>0) {
                                                        while ($result=mysqli_fetch_assoc($opMovieRate)) {
                                                                    echo $result['title'];

                                                                     while ($result['Rate']) {
                                                                          echo '<span style="color:orange"><i class="bi bi-star-fill"></i></span>';
                                                                          $result['Rate']= $result['Rate']-1;
                                                                          if (0<$result['Rate'] && $result['Rate']<1) {
                                                                          echo '<span style="color:orange"><i class="bi bi-star-half"></i></span>';
                                                                          break;
                                                                           }
                                                                     }
                                                                      echo '<br>';
                                                         }
                                                   }else{
                                                        echo 'Not Rate Any Movie Yet';
                                                        }                               
                                                ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            include '../footer.php';
            ?>