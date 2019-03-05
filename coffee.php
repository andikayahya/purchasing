<?php
    session_start();

    include "include/koneksi.php";
    include "include/current.php";

     // Apabila user belum login
    if (empty($_SESSION['id']) AND empty($_SESSION['password']))
    {
        header('location:cpanel/index.php');  
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
    <?php include "navigation/nav_coffee.php"?>
    <!-- Mobile Menu end -->
    <?php include "user_session.php"?>
    <!-- Inbox area Start-->
    <?php include "coffee_list.php"?>
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