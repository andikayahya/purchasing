<?php
	session_start();
	session_destroy();

	include "../include/koneksi.php";

	date_default_timezone_set("Asia/Bangkok");
	$uri = $_SERVER['REQUEST_URI'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$dtime = date('H:i:s');
	$tanggal = date ('Y-m-d');
	$realip = get_IP_address();

	function get_IP_address()
{
  foreach (array('HTTP_CLIENT_IP',
               'HTTP_X_FORWARDED_FOR',
               'HTTP_X_FORWARDED',
               'HTTP_X_CLUSTER_CLIENT_IP',
               'HTTP_FORWARDED_FOR',
               'HTTP_FORWARDED',
               'REMOTE_ADDR') as $key){
    if (array_key_exists($key, $_SERVER) === true){
        foreach (explode(',', $_SERVER[$key]) as $IPaddress){
            $IPaddress = trim($IPaddress); // Just to be safe

            if (filter_var($IPaddress,
                           FILTER_VALIDATE_IP,
                           FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
                !== false) {

                return $IPaddress;
            }
        }
    }
}
}

	$ol="insert into t_online(id,ip,url,time,date) values('','$realip','$uri','$dtime','$tanggal')";
	$rol = mysqli_query($konek, $ol);

	// fungsi untuk menghindari injeksi dari user yang jahil
	function anti_injection($data)
	{
	  	$filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	  	return $filter;
	}

	$username = anti_injection($_POST['id']);
	$password = anti_injection(md5($_POST['password']));

	$query  = "SELECT * FROM t_agent WHERE id  ='$username' AND password='$password'";
	$login  = mysqli_query($konek, $query);
	$ketemu = mysqli_num_rows($login);
	$r      = mysqli_fetch_array($login);

	// If ID and Password correct
	if ($ketemu > 0)
	{
		session_start();

		// bikin variabel session
		$_SESSION['id']    = $r['id'];
		$_SESSION['password']    = $r['password'];
		$_SESSION['status']   = $r['status'];
		  
		// bikin id_session yang unik dan mengupdatenya agar slalu berubah 
		// agar user biasa sulit untuk mengganti password Administrator 
		$sid_lama = session_id();
		session_regenerate_id();
		$sid_baru = session_id();

		header("location:../index.php");
	}

	else
	{
	    echo "<h1>Login Gagal! Username & Password salah.</h1>";
	    echo "<p><a href=\"index.php\">Ulangi Lagi</a></p>";  
  	}

?>
