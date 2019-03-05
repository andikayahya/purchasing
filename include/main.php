<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
//echo date("d/m/Y h:i:s");
if ($_SESSION['loginid'] == "")
	header('location:index.php');
//echo $_SESSION['nik'];
//echo $_SESSION['loginid'];
include "include/koneksi.php";
include "include/fungsi.php";
include "include/current.php";
///
$uri = $_SERVER['REQUEST_URI'];
$ip = $_SERVER['REMOTE_ADDR'];
   /* $ipaddress = $uri;
    $jsonurl = "http://metricsiogeo.heroku.com/lookup/".$ipaddress;
    $json = file_get_contents($jsonurl,0,null,null);
    $json_output = json_decode($json,true);
    $country = $json_output["ISO3166-1"]; */
///
$datetime = date('Y-m-d H:i:s');
$jam = date('H');
$tanggal = date ('Y-m-d');
$quser = "select * from t_username where username='".$_SESSION['loginid']."'";
$ruser = mysql_query( $quser);
$rwuser = mysql_fetch_array($ruser);
$report = $rwuser['report'];
$nama = $rwuser['nama'];
$uname = $rwuser['username'];
$realip = getRealIpAddr();
$nixx = $rwuser['nik']; 
$depart = $rwuser['dept'];


$time1 = date('H:i');
$date1 = date('Y-m-d');
$tanggal = substr($date1,8,2)." ".conmonth(substr($date1,5,2))." ".substr($date1,0,4);
//////////////////////Banner///////////////////////
$yesterday = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$today = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$tomorrow = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$due = mktime(0, 0, 0, date("m")  , date("d")+18, date("Y"));
///
$duetimex = mktime(0, 0, 0, date("s"), date("i")+1, date("H"));

//$age = floor((time() - mktime(0, 0, 0, date("H")+8, date("i"), date("s"))) / 31557600);

///
$yesterday = date('Y-m-d',$yesterday);
$tomorrow = date('Y-m-d',$tomorrow);
$tanggal = date ('Y-m-d');
$due = date ('Y-m-d',$due);
$duetimex = date ('H:i:s',$duetimex);
///////////////////////////////////////////////////
///

{
if ($_SESSION['loginid'] =='yanuartikania')
$poflag='ct';
else if($_SESSION['loginid'] =='dayat.dayat')
$poflag='fv';
else if($_SESSION['loginid'] =='boby.hermawan')
$poflag='cv';
else if($_SESSION['loginid'] =='natalia.pandjaitan')
$poflag='si';
else if($_SESSION['loginid'] =='andy.chah')
$poflag='fe';
else
$poflag='';
}
///
$quser2 = "select * from t_mst_employee where nama='$nama'";
$ruser2 = mysql_query($quser2);
$rwuser2 = mysql_fetch_array($ruser2);
$link2 = $rwuser2['link'];
$nik2 = $rwuser2['nik'];
$divisi = $rwuser2['divisi'];
$kadivstat = $rwuser2['kadiv'];
$kadeptstat = $rwuser2['kadept'];
////
///
$qdivisi = "select * from t_mst_divisi where id = '$divisi' and status = '1'";
$rdivisi = mysql_query($qdivisi);
$rwdivisi = mysql_fetch_array($rdivisi);
$div = $rwdivisi['divisi'];
//
$qtanggal = "select distinct tanggal,jam from t_kurs where status='1'";
$rtanggal = mysql_query($qtanggal);
$rwtanggal = mysql_fetch_array($rtanggal);
$tgljadi = $rwtanggal['tanggal'];
$jamjadi = $rwtanggal['jam'];
////get data from SR Online
///////////////////////////////////////////////////
	$rowsperpage = 10;
	$pageNum = 1;
	if(isset($_GET['page']))
	{
		$pageNum = $_GET['page'];
	}
	$offset = ($pageNum - 1) * $rowsperpage;
	$qcount = "select count(*) as numrows from  t_crm_sr__data where (top = '$uname' and status1='0' and batal = '0')";
	$qresult= mysql_query($qcount);
	$row = mysql_fetch_array($qresult);
	$numrows = $row['numrows'];
	$maxPage = ceil($numrows/$rowsperpage);
	$self = $_SERVER['PHP_SELF'];
	$nav  = ' ';
	///sales support
	$rowsperpagex = 10;
	$pageNumx = 1;
	if(isset($_GET['page']))
	{
		$pageNumx = $_GET['page'];
	}
	$offsetx = ($pageNumx - 1) * $rowsperpagex;
	$qcountx = "select count(*) as numrows from  t_crm_sr__data where (status1='1' and status2='0' and batal = '0')";
	$qresultx= mysql_query($qcountx);
	$rowx = mysql_fetch_array($qresultx);
	$numrowsx = $rowx['numrows'];
	$maxPagex = ceil($numrowsx/$rowsperpagex);
	$selfx = $_SERVER['PHP_SELF'];
	$navx  = ' ';
	///Shipping
	$rowsperpagey = 10;
	$pageNumy = 1;
	if(isset($_GET['page']))
	{
		$pageNumy = $_GET['page'];
	}
	$offsety = ($pageNumy - 1) * $rowsperpagey;
	$qcounty = "select count(*) as numrows from  t_crm_sr__data where (status2 = '1' and status3 = '0' and batal = '0')";
	$qresulty= mysql_query($qcounty);
	$rowy = mysql_fetch_array($qresulty);
	$numrowsy = $rowy['numrows'];
	$maxPagey = ceil($numrowsy/$rowsperpagey);
	$selfy = $_SERVER['PHP_SELF'];
	$navy  = ' ';
	
	///
	///Upload Files Request
	$rowsperpagem = 10;
	$pageNumm = 1;
	if(isset($_GET['page']))
	{
		$pageNumm = $_GET['page'];
	}
	$offsetm = ($pageNumm - 1) * $rowsperpagem;
	$qcountm = "select count(*) as numrows from  t_mis__upreq where status = '0'";
	$qresultm= mysql_query($qcountm);
	$rowm = mysql_fetch_array($qresultm);
	$numrowsm = $rowm['numrows'];
	$maxPagey = ceil($numrowsy/$rowsperpagey);
	$selfm = $_SERVER['PHP_SELF'];
	$navm  = ' ';
	
	///
	///Car reservation
	$rowsperpageg = 10;
	$pageNumg = 1;
	if(isset($_GET['page']))
	{
		$pageNumg = $_GET['page'];
	}
	$offsetg = ($pageNumg - 1) * $rowsperpageg;
	$qcountg = "select count(*) as numrows FROM `t_kendaraan__reserve` WHERE  (STATUS = '0' and dept !='0' and closed = '0')";
	$qresultg= mysql_query($qcountg);
	$rowg = mysql_fetch_array($qresultg);
	$numrowsg = $rowg['numrows'];
	$maxPageg = ceil($numrowsg/$rowsperpageg);
	$selfg = $_SERVER['PHP_SELF'];
	$navg  = ' ';
	///
	$rowsperpaged = 10;
	$pageNumd = 1;
	if(isset($_GET['page']))
	{
		$pageNumd = $_GET['page'];
	}
	$offsetd = ($pageNumd - 1) * $rowsperpaged;
	$qcountd = "select count(*) as numrows FROM `t_kendaraan__reserve` WHERE  (STATUS = '0' and dept !='0' and due <= '".$tanggal."' and closed = '0')";
	$qresultd= mysql_query($qcountd);
	$rowd = mysql_fetch_array($qresultd);
	$numrowsd = $rowd['numrows'];
	$maxPaged = ceil($numrowsd/$rowsperpaged);
	$selfd = $_SERVER['PHP_SELF'];
	$navd  = ' ';													

///

	$qultahx = "select * from t_mst_employee where status='1' order by nama ASC";
	$rultahx = mysql_query($qultahx);
	while ($rwultahx = mysql_fetch_row($rultahx))
	{
		  ////
		$tanggalx = date ('Y-m-d');
		$hariinix = substr ($tanggalx,5,5);
		$tglinix = substr ($tanggalx,8,2);
		$bulaninix = substr ($tanggalx,5,2);
		$tglgabungx = $tglinix.$bulaninix;
		  
		  ////
		$tlahirx = $rwultahx['9'];
		$harilahirx = substr ($tlahirx,8,2);
		$bulanlahirx = substr ($tlahirx,5,2);
		$ultahgabungx = $harilahirx.$bulanlahirx;
		$ultahx = substr ($tlahirx,5,5);
	}
//////
?>

<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
window.open("https://www.haldinfoods.com");
</script>
	<head>
		<?php include "./new_myhaldin_2018/title.php"?>
		<?php include "./new_myhaldin_2018/css.php"?>

		<?php
			if ($jam <= '14')
			{
		?>

		<!-- use this for popup-->
		<div id="boxes">
			<div style="display: none; margin:2px auto;" id="dialog" class="window">
				<div id="lorem">
					<div class="modal-dialog modal-confirm">
						<div class="modal-content">
							<div class="modal-header">
								<div class="icon-box">
									<i class="material-icons">
										<img src="new_myhaldin_2018/img/logo-haldin2x.png">
									</i>
								</div>				
								<h4 class="modal-title">Welcome to My Haldin</h4>	
							</div>

							<div class="modal-body">

								<p class="text-center">
									<?php
										if ($jam <= '10')
										        echo ("Selamat Pagi");
										else if ($jam <= '16')
										        echo ("Selamat Siang");
										else if ($jam <= '18')
										        echo ("Selamat Sore");
										else
										     echo ("Selamat Malam");
									?>

									Per tanggal 19 Desember 2018 departemen MIS menerapkan sistem ticketing untuk troubleshooting. Apabila ada kebutuhan troubleshoot diharapkan untuk mengisi form terlebih dahulu 🙂</br><font style="font-size: 12px;"><b><i>DEPARTMENTS → my MIS → MyTroubleshoot → Req. Troubleshoot</i></b></font>
								</p>


							</div>

							
						</div>
					</div>
				</div>
			</div>
			<div style="width: auto; display: none; opacity: 0.8;" id="mask"></div>
		</div> 
		<!-- use this for popup-->

		<?php } ?>

	</head>
	
	<body>
		<div class="site-wrap">
			<?php include "./new_myhaldin_2018/main_menu.php"?>
			<?php include "./new_myhaldin_2018/headline.php"?>
			<?php include "./new_myhaldin_2018/music.php"?>
			
			<?php include "./new_myhaldin_2018/storyboard.php"?>
			<?php include "./new_myhaldin_2018/brand_area.php"?>
			<?php include "./new_myhaldin_2018/footer.php"?>
			<?php include "./new_myhaldin_2018/java_script.php"?>
			<?php include "./new_myhaldin_2018/live_chat.php"?>	
		</div>
	</body>

	<script type="text/javascript">
	   	$(document).ready(function() 
	   	{    

			var id = '#dialog';
		
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			$('#mask').fadeIn(500);	
			$('#mask').fadeTo("slow",0.9);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
	              
			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
		
			//transition effect
			$(id).fadeIn(2000); 	
	
			//if close button is clicked
			$('.window .close').click(function (e) 
			{
				//Cancel the link behavior
				e.preventDefault();
				
				$('#mask').hide();
				$('.window').hide();
			});		
		
			//if mask is clicked
			$('#mask').click(function () 
			{
				$(this).hide();
				$('.window').hide();
			});		
	
		});
	</script>
</html>