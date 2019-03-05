<?php
    session_start();
    error_reporting(0);
    include "./include/koneksi.php";
    include "./include/current.php";

    date_default_timezone_set("Asia/Bangkok");

    if (isset($_POST[save]))
    {
        $qtype = "select * from t_product_counter where id='1'";
        $rtype = mysqli_query($konek, $qtype);
        $rwtype = mysqli_fetch_array($rtype);
        //$type = $rwtype['category'];
        switch (strlen($rwtype['counter']+1))
        {       
            case 1 : $trip_id = 'TEA0000000'.($rwtype['counter']+1);break;
            case 2 : $trip_id = 'TEA000000'.($rwtype['counter']+1);break;
            case 3 : $trip_id = 'TEA00000'.($rwtype['counter']+1);break;
            case 4 : $trip_id = 'TEA0000'.($rwtype['counter']+1);break;
            case 5 : $trip_id = 'TEA000'.($rwtype['counter']+1);break;
            case 6 : $trip_id = 'TEA00'.($rwtype['counter']+1);break;
            case 7 : $trip_id = 'TEA0'.($rwtype['counter']+1);break;
            case 8 : $trip_id = ($rwtype['counter']+1);break;            
        }
        $newcount = $rwtype['counter']+1;
        $qupdcounter = "update t_product_counter set counter='".$newcount."' where id='1'";
        $rupdcounter = mysqli_query($konek, $qupdcounter);
        
        $date = date('m-d-Y');
        $date_finish = date('m-d-Y');

        $time = date('H:i:s');
        $time_finish = date('H:i:s');

        $sess_user = $_SESSION['id'];

        $rawdate = htmlentities($_POST['visit_date']);
        $date = date('m-d-Y', strtotime($rawdate));

        $rawdate2 = htmlentities($_POST['finisih_date']);
        $date2 = date('m-d-Y', strtotime($rawdate2));
        
        $qrequest = "INSERT INTO t_tea(id, trip_id, agent, product_group, title, material_id, supplier, description, visit_date, finish_date, uploaded_date, status) VALUES (NULL, '".$trip_id."', '".$sess_user."', 'Tea', '".$_POST['trip_title']."', '".$_POST['material_id']."', '".$_POST['vendor_name']."', '".$_POST['editor']."', '".$date."', '".$date2."',  NOW() ,'1')";
        $rrequest = mysqli_query($konek, $qrequest);

        echo "<script type='text/javascript'>
             alert('Submitted Successfully!')
             window.location='tea.php';
             </script>";
        }


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

    <html class="no-js" lang="en">

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


         <!-- Compose email area Start-->
        <form name="action" method="post" action="" enctype="multipart/form-data">
            <div class="inbox-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <div class="inbox-left-sd">
                                <div class="compose-ml">
                                    <button class="btn" type="submit" name="save">Save</button>
                                </div>
                                
                                <?php include "material_index.php"?>

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

                                <div class="cmp-int-box mg-t-20">
                                    <textarea class="form-control" name="editor" id="editor1">
                                       <?php echo $rwrecord['description'];?>
                                    </textarea>
                                </div>
                            </form>

                           
                            <div class="vw-ml-action-ls text-right mg-t-20">
                                <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                    <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-next"></i> Reply</button>
                                    <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-right-arrow"></i> Forward</button>
                                    <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-down-arrow"></i> Print</button>
                                    <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-trash"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Compose email area End-->
        <?php } ?>
        <!-- Start Footer area-->
        <?php include "footer.php"?>
        <!-- End Footer area-->
        <?php include "java_script.php"?>
    </body>

    </html>

<?php } ?>




