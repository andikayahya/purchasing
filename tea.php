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

                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="inbox-text-list sm-res-mg-t-30">

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px;">No.</th>
                                        <th width="50px" style="font-size: 12px;">Trip ID</th>
                                        <th style="font-size: 12px;">Material</th>
                                        <th style="font-size: 12px;">Title</th>
                                        <th style="font-size: 12px;">Agent</th>
                                        <th style="font-size: 12px;">Supplier</th>
                                        <th style="font-size: 12px;">Visit Date</th>
                                        <th style="font-size: 12px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                        $id=$_GET['id'];
                                        $trip=$_GET['trip_id'];
                                        $qrecord = "    SELECT a.id, a.trip_id, a.agent, c.full_name, a.product_group, a.title, a.material_id, 
                                                        a.description, a.supplier, a.visit_date, a.finish_date, b.name, a.status, a.image1, a.image2, a.image3, a.image4
                                                        FROM `t_tea` as a 
                                                        JOIN t_tea_material as b 
                                                        JOIN t_agent as c 
                                                        on a.material_id=b.material_id and 
                                                        a.agent=c.id where a.material_id = '$id'
                                                        AND a.status = '1'
                                                        ORDER BY trip_id DESC";
                                        $rrecord = mysqli_query($konek, $qrecord);
                                        $no=1;
                                        while($rwrecord = mysqli_fetch_array($rrecord))
                                        {
                                    ?>
                                    
                                    <tr>
                                        <td style="font-size: 12.5px;"><?php echo $no;?></td>

                                        <td style="font-size: 12.5px;">
                                            <a data-toggle="modal" href="#" data-target="#myModal<?php echo $rwrecord['id'];?>">
                                                <strong><?php echo $rwrecord['trip_id'];?></strong>
                                            </a>

                                             

                                            <div class="modal fade" id="myModal<?php echo $rwrecord['id'];?>" role="dialog">
                                                <div class="modal-dialog modal-large">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="view-mail-hd">
                                                                <div class="view-mail-hrd">
                                                                    <h1 style="color:#4682B4;"><b><?php echo $rwquery['title'];?></b></h1>
                                                                </div>
                                                                <div class="view-ml-rl">
                                                                    <p style="color:#4682B4;"><b><i><?php echo $rwquery['full_name'];?></i></b></p>
                                                                </div>
                                                            </div>
                                                            <div class="mail-ads mail-vw-ph">
                                                                <p class="first-ph"><b>Trip ID : </b><font style="color:red; font-style: italic;"><?php echo $rwrecord['trip_id'];?></font></p>
                                                                <p><b>Material Name : </b><?php echo $rwrecord['name'];?></p>
                                                                <p><b>Vendor Name :</b><?php echo $rwrecord['supplier'];?></p>
                                                                <p class="last-ph"><b>Visit Date :</b> <?php echo $rwrecord['visit_date'];?></p>
                                                            </div>

                                                            <div class="view-mail-atn">
                                                                <div class="html-editor-click" name="editor">
                                                                    <?php echo $rwrecord['description'];?>
                                                                </div>

                                                                <div>
                                                                    <img <?php echo 'src="images/'.$rwrecord['image1'].'"';?> alt="" height="800" width="1000">
                                                                </div>
                                                                <br>
                                                                <div>
                                                                    <img <?php echo 'src="images/'.$rwrecord['image2'].'"';?> alt="" height="800" width="1000">
                                                                </div>
                                                                <br>
                                                                <div>
                                                                    <img <?php echo 'src="images/'.$rwrecord['image3'].'"';?> alt="" height="800" width="1000">
                                                                </div>
                                                                <br>
                                                                <div>
                                                                    <img <?php echo 'src="images/'.$rwrecord['image4'].'"';?> alt="" height="800" width="1000">
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td style="font-size: 12.5px;"><?php echo $rwrecord['name'];?></td>
                                        <td style="font-size: 12.5px;"><?php echo substr($rwrecord['title'],0,15);?></td>
                                        <td style="font-size: 12.5px;"><?php echo substr($rwrecord['full_name'],0,15);?></td>
                                        <td style="font-size: 12.5px;"><?php echo substr($rwrecord['supplier'],0,15);?></td>
                                        <td style="font-size: 12.5px;"><?php echo $rwrecord['visit_date'];?></td>
                                        <td style="font-size: 12.5px;">
                                            <a href="tea_edit.php?trip_id=<?php echo $rwrecord['trip_id']; ?>">
                                                <button class="btn btn-primary notika-btn-primary btn-xs">Edit</button>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php $no++; } ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
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
    <script type="text/javascript">
        
    </script>
</body>

</html>

<?php } ?>
