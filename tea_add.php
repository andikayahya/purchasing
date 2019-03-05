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
        
        $date_finish = date('Y-m-d');

        $time = date('H:i:s');
        $time_finish = date('H:i:s');

        $sess_user = $_SESSION['id'];

        $rawdate = htmlentities($_POST['visit_date']);
        $date = date('Y-m-d', strtotime($rawdate));

        $rawdate2 = htmlentities($_POST['finisih_date']);
        $date2 = date('Y-m-d', strtotime($rawdate2));
        
       $name1 = $_FILES['image1']['name'];
        $location = $_FILES['image1']['tmp_name'];

        move_uploaded_file($location, "images/".$name1);

        $name2 = $_FILES['image2']['name'];
        $location = $_FILES['image2']['tmp_name'];

        move_uploaded_file($location, "images/".$name2);

        $name3 = $_FILES['image3']['name'];
        $location = $_FILES['image3']['tmp_name'];

        move_uploaded_file($location, "images/".$name3);

        $name4 = $_FILES['image4']['name'];
        $location = $_FILES['image4']['tmp_name'];

        move_uploaded_file($location, "images/".$name4);

        $qrequest = "INSERT INTO t_tea(id, trip_id, agent, product_group, title, material_id, supplier, description, visit_date, finish_date, uploaded_date, status, image1, image2, image3, image4) VALUES (NULL, '".$trip_id."', '".$sess_user."', 'Tea', '".$_POST['trip_title']."', '".$_POST['material_id']."', '".$_POST['vendor_name']."', '".$_POST['editor']."', '".$date."', '".$date2."',  NOW() ,'1', '".$name1."', '".$name2."', '".$name3."', '".$name4."')";
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

                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                            <div class="view-mail-list sm-res-mg-t-30">
                                <div class="view-mail-hd">
                                    <div class="view-mail-hrd">
                                        <h2>New Trip Report</h2>
                                    </div>
                                </div>

                                <?php
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
                                ?>

                                <div class="cmp-int mg-t-20">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                            <div class="cmp-int-lb cmp-int-lb1 text-left">
                                                <span>Title: </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                            <div class="form-group">
                                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                                    <input type="text" name="trip_title" class="form-control" placeholder="Insert your trip title here .." />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                            <div class="cmp-int-lb cmp-int-lb1 text-left">
                                                <span>Product Group: </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                            <div class="form-group">
                                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                                    <b>
                                                        <input style="color:#FF6347; font-style: italic;" disabled="" ="" type="text" name="product_group" class="form-control" value="Tea" />
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                            <div class="cmp-int-lb cmp-int-lb1 text-left">
                                                <span>Material Name: </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-10 col-sm-10 col-xs-12">
                                            <div class="form-group">
                                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                                    <div class="bootstrap-select fm-cmp-mg">
                                                        <?php echo "  <select name='material_id' class='selectpicker'>
                                                                        <option value='-' disabled='disabled'>Choose One</option>";
                                                        $query = "select * from t_tea_material order by name ASC";
                                                        $result = mysqli_query($konek, $query);
                                                        while ($row = mysqli_fetch_array($result))
                                                        {
                                                            echo "<option value='".$row['id']."'>".$row['name']."</option>";        
                                                        }
                                                        echo "</select>";?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                            <div class="cmp-int-lb cmp-int-lb1 text-left">
                                                <span>Vendor Name: </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                            <div class="form-group">
                                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                                    <input type="text" name="vendor_name" class="form-control" placeholder="e.g Sule, Andre, Parto" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                            <div class="cmp-int-lb cmp-int-lb1 text-left">
                                                <span>Visit Date: </span>
                                            </div>
                                        </div>
                                       <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                            <div class="form-group">
                                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                                    <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
                                                        <div class="input-group date nk-int-st">
                                                            <span class="input-group-addon"></span>
                                                            <input type="text" name="visit_date" class="form-control" placeholder="Choose your trip day">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                           <div class="cmp-int-lb cmp-int-lb1 text-left">
                                                <span>Finish Date: </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                            <div class="form-group cmp-em-mg">
                                                <div class="nk-int-st cmp-int-in cmp-email-over">
                                                    <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
                                                        <div class="input-group date nk-int-st">
                                                            <span class="input-group-addon"></span>
                                                            <input type="text" name="finisih_date" class="form-control" placeholder="Choose your trip day">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cmp-int-box mg-t-20">
                                    <textarea class="form-control" name="editor" id="editor1"></textarea>
                                </div>
                           
                            <div class="vw-ml-action-ls text-right mg-t-20">
                                <input type="file" name="image1">
                            </div>
                            <div class="vw-ml-action-ls text-right mg-t-20">
                                <input type="file" name="image2">
                            </div>
                            <div class="vw-ml-action-ls text-right mg-t-20">
                                <input type="file" name="image3">
                            </div>
                            <div class="vw-ml-action-ls text-right mg-t-20">
                                <input type="file" name="image4">
                            </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Compose email area End-->
        
        <!-- Start Footer area-->
        <?php include "footer.php"?>
        <!-- End Footer area-->
        <?php include "java_script.php"?>
    </body>

    </html>

<?php } ?>




