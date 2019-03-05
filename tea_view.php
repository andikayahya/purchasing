<?php
    session_start();
    error_reporting(0);

    include "include/koneksi.php";
    include "include/current.php";

    date_default_timezone_set("Asia/Bangkok");
    
    $tanggal = date('Y-m-d');
    $time1 = date('H:i:s');
    $timex = date ('mdHis');
    $noatk = $timex;
    $tanggal = date ('Y-m-d');
    $jam = date ('H:i:s');

     // Apabila user belum login
    if (empty($_SESSION['id']) AND empty($_SESSION['password']))
    {
        header('location:./cpanel/index.php');  
    }
    // Apabila user sudah login dengan benar, maka terbentuklah session
    else
    {

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <?php include "title.php"?>
    <?php include "css.php"?>
</head>

<body>
    <!-- Start Header Top Menu -->
    <?php include "top_menu.php"?>
    <!-- End Header Top Menu -->
    <!-- Mobile Menu start -->
    <?php include "navigation/nav_mobile.php"?>
    <?php include "navigation/nav.php"?>
    <!-- Mobile Menu end -->
    
    <?php include "user_session.php"?>

    <!-- Inbox area Start-->
    <div class="inbox-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="inbox-left-sd">
                        <div class="compose-ml">
                            <a class="btn" href="tea_add.php">Add Product</a>
                        </div>

                        <?php include "material_index.php"?>

                        <hr>
                        <div class="inbox-status">
                            <ul class="inbox-st-nav inbox-nav-mg">
                                <!--<li><a href="#"><i class="notika-icon notika-success"></i> Forum</a></li>
                                <li><a href="#"><i class="notika-icon notika-chat"></i> Chat</a></li>
                                <li><a href="#"><i class="notika-icon notika-star"></i> Work</a></li>
                                <li><a href="#"><i class="notika-icon notika-settings"></i> Settings</a></li>
                                <li><a href="#"><i class="notika-icon notika-support"></i> Support</a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>

                <?php
                      $id=$_GET['trip_id'];
                      $qrecord = "SELECT * FROM `t_tea` as a JOIN t_tea_material as b on a.material_id=b.material_id where a.trip_id = '$id'";
                      $rrecord = mysqli_query($konek, $qrecord);
                      $no=1;
                      while($rwrecord = mysqli_fetch_array($rrecord))
                      {
                ?>

                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="view-mail-list sm-res-mg-t-30">
                        <div class="view-mail-hd">
                            <div class="view-mail-hrd">
                                <h1 style="color:#4682B4;"><b><?php echo $rwrecord['title'];?></b></h1>
                            </div>
                            <div class="view-ml-rl">
                                <p style="color:#4682B4;"><b><i><?php echo $rwrecord['agent'];?></i></b></p>
                            </div>
                        </div>
                        <div class="mail-ads mail-vw-ph">
                            <p class="first-ph"><b>Material Name : </b><?php echo $rwrecord['name'];?></p>
                            <p><b>Vendor Name :</b><?php echo $rwrecord['supplier'];?></p>
                            <p class="last-ph"><b>Visit Date :</b> <?php echo $rwrecord['visit_date'];?></p>
                        </div>

                        <div class="summernote-clickable">
                            <a href="tea_edit.php?trip_id=<?php echo $id; ?>">
                                <button type="button" class="btn btn-primary btn-s"/>Click here to edit the content</button>
                            </a>
                        </div>

                        <div class="view-mail-atn">
                            <div class="html-editor-click" name="editor">
                                <?php echo $rwrecord['description'];?>
                            </div>
                        </div>
                    </div>
                </div>

               

                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Inbox area End-->
    <!-- Start Footer area-->
    <?php include "footer.php"?>
    <!-- End Footer area-->
    <!-- Start jquery-->
    <?php include "java_script.php"?>
    <!-- End jquery-->
</body>

</html>

<?php } ?>
