 <div id="layoutSidenav_nav">
     <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
         <div class="sb-sidenav-menu">
             <div class="nav">
                 <div class="sb-sidenav-menu-heading">Core</div>
                 <a class="nav-link" href="<?php echo  url($data . '/index.php'); ?>">
                     <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                     Dashboard
                 </a>
                 <div class="sb-sidenav-menu-heading">Interface</div>
                 <?php
                    $sidArray = ['movies', 'categories', 'users','usersRates'];
                    foreach ($sidArray as $key => $data) {
                    ?>
                     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts<?php echo $key; ?>" aria-expanded="false" aria-controls="collapseLayouts<?php echo $key; ?>">
                         <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                         <?php echo $data; ?>
                         <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                     </a>
                     <div class="collapse" id="collapseLayouts<?php echo $key; ?>" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                         <nav class="sb-sidenav-menu-nested nav">
                            <?php if($data !='usersRates'){ ?>
                             <a class="nav-link" href="<?php echo  url($data . '/create.php'); ?>"> Add </a>
                             <?php }?>
                             <a class="nav-link" href="<?php echo  url($data . '/index.php'); ?>">Display </a>
                         </nav>
                     </div>
                 <?php } ?>
             </div>
         </div>
         <div class="sb-sidenav-footer">
             <div class="small">Logged in as:</div>
            <?php $email= $_SESSION['User']['email'];
     $username=explode('@',$email);
     echo $username['0'];?>
   
         </div>
     </nav>
 </div>