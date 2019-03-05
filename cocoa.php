<?php
    session_start();

    include "include/koneksi.php";

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <?php include "head.php"?>
</head>

<body>
    <!-- Start Header Top Menu -->
    <?php include "top_menu.php"?>
    <!-- End Header Top Menu -->
    <!-- Mobile Menu start -->
    <?php include "nav.php"?>
    <!-- Mobile Menu end -->
    
    <!-- Inbox area Start-->
    <?php include "isi.php"?>
    <!-- Inbox area End-->
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2018 
. All rights reserved by <a href="https://haldin-natural.com">haldin-natural</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
    <!-- Start jquery-->
    <?php include "java_script.php"?>
    <!-- End jquery-->
</body>

</html>