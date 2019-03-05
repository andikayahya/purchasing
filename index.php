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

    <?php include "top_menu.php"?>

    <?php include "navigation/nav_mobile.php"?>
    <?php include "navigation/nav.php"?>

    <?php include "user_session.php"?>

    <?php include "isi.php"?>

    <?php include "footer.php"?>

    <?php include "java_script.php"?>
</body>

</html>

<?php } ?>