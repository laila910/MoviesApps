<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/dbconnection.php';

$sql = "SELECT * FROM `users` ";
$op  = mysqli_query($conn, $sql);
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
                            <li class="breadcrumb-item active">Users Data</li>
                        <?php } ?>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                             Users Table  
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name </th>
                                            <th>User Email</th>
                                            <th>User BirthDate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($result = mysqli_fetch_assoc($op)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $result['id']; ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                                <td><?php echo $result['email']; ?></td>
                                                <td><?php echo $result['birthDate']; ?></td>
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