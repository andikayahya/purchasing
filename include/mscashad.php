<?php
	session_start();
	if ((!isset($_SESSION['loginid'])) || ($_SESSION['loginid'] == ""))
	{
		header('Location: /../index.php');
	}
	date_default_timezone_set("Asia/Bangkok");
	include "../include/koneksi.php";
	$menu = base64_decode($_GET['m']);
	//$akses = base64_decode($_GET['a']);
	$parm = base64_decode($_GET['prm']);
	$group = base64_decode($_GET['group']);
	
	$pecah = explode('/', $parm);
	$namamenu = $pecah[2];
	$msakses = $pecah[3];
	$add = substr($msakses,0,1);
	$edit = substr($msakses,1,1);
	$delete = substr($msakses,2,1);
	$print = substr($msakses,3,1);
	$approve1 = substr($msakses,4,1);
	$approve2 = substr($msakses,5,1);
	
	$sqlkry = "select nama, nik, jabatan, divisi, dept, section from t_mst_employee where nik = '".$_SESSION['nik']."' ";
	$stmtkry = mysql_query($sqlkry);
	$rowkry = mysql_fetch_assoc($stmtkry);
	
	$divisi = $rowkry['divisi'];
	$departemen = $rowkry['dept'];
	$section = $rowkry['section'];
	$jabatan = $rowkry['jabatan'];
	
	$sqlmst = "	select m_kode 
				from msmaster where m_kode = '".$_SESSION['nik']."' and m_status = 'A' and m_type = 'ACCOUNTING'";
	$stmtmst = mysql_query($sqlmst);
	$rowmst = mysql_fetch_assoc($stmtmst);
	
	$sqlmin = "select MIN(jabatan) as jabjab from t_mst_employee where divisi = '".$divisi."' and status = '1'";
	$stmtmin = mysql_query($sqlmin);
	$rowmin = mysql_fetch_assoc($stmtmin);
	
	$links = "mscashad-new.php?prm=".base64_encode($parm);
	$links2 = "mscashad-dinas-new.php?prm=".base64_encode($parm);
	
	$bulan = date("m");
	
	if($bulan == '01'){
		$from = (date("Y")-1)."-12-01 00:00:00";
		$now = date("Y-m-d H:i:s");
	}
	else{
		$b = (date("m")-1);
		if($b <= 9 ){ $tmnt = "0".$b; }
		// update 11/15/2018 : algoritma error karena bulan sudah lebih dari 1 digit. maka diubah menjadi 1 bulan kebelakang
		//$from = date("Y")."-".$tmnt."-01 00:00:00";
		$from = date("Y")."-".$b."-01 00:00:00";
		$now = date("Y-m-d H:i:s"); 
	}
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cash Advance</title>
	<!-- Bootstrap Styles-->
    <link rel="icon" href="../assets/img/haldin_logo.gif" />
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/jquery-ui.min.css" rel="stylesheet">
     <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
   
    <!-- Custom Styles-->
    <link href="../assets/css/custom-styles.css" rel="stylesheet" />
    <!-- TABLE STYLES-->
    <!--<link href="../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
	<link rel="stylesheet" type="text/css" href="../assets/datatable/jquery.dataTables.css">
    <link href="../assets/master/datepicker/css/jquery.datepicker.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <?php include "../header.php"?>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
           <?php include "../menu.php" ?>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            My Cash Advance
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <?php if ($add == 'Y'){?><a style="color:#000;" href="<?php echo $links; ?>">
                             <input type="button" class="btn" id="addbtn" value="New Request CA" style="margin-top:5px;" /></a>&nbsp;&nbsp;<a style="color:#000;" href="<?php echo $links2; ?>">
                             <input type="button" class="btn" id="addbtn" value="CA Business Trip" style="margin-top:5px;" /></a><?php } else{ echo ""; }?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th>No.</th>
                                            <th>Kode</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th width="100">Date</th>
                                            <th width="100">Need On</th>
                                            <th>Kurs</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th width="200">Desc</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
										/*
										select a.*, DATE_FORMAT(a.m_tanggal,'%d-%m-%Y') as tgl, DATE_FORMAT(a.m_need,'%d-%m-%Y') as tgl2,
														b.nama, c.m_status as sts2
														from mscashad a left join msperjadin c on a.m_kodedinas = c.m_kode, t_mst_employee b
														where a.m_nik = b.nik and (a.m_status = '0' or a.m_status = 'Y') and a.m_status2 = '0' 
														and year(a.m_tanggal) = '".date("Y")."' and month(a.m_tanggal) >= '".(date("m") - 1)."' "
										*/
										if( $rowmst['m_kode'] != '' ){
											if ( $approve2 == 'Y' ){
												 $sqls = "	select a.*, DATE_FORMAT(a.m_tanggal,'%d-%m-%Y') as tgl, DATE_FORMAT(a.m_need,'%d-%m-%Y') as tgl2,
														b.nama, c.m_status as sts2
														from mscashad a left join msperjadin c on a.m_kodedinas = c.m_kode, t_mst_employee b
														where a.m_nik = b.nik and (a.m_status = '0' or a.m_status = 'Y') and a.m_status2 = '0' 
														and a.m_tanggal between '".$from."' and '".$now."' ";
											}
											else{
												 $sqls = " 	select a.*, DATE_FORMAT(a.m_tanggal,'%d-%m-%Y') as tgl, DATE_FORMAT(a.m_need,'%d-%m-%Y') as tgl2,
												 	b.nama, c.m_status as sts2, b.divisi as div1, b.dept as dept2
												 	from mscashad a left join msperjadin c on a.m_kodedinas = c.m_kode, t_mst_employee b
												 	where a.m_nik = b.nik and a.m_status = 'Y' and a.m_status2 = '0' 
													and a.m_tanggal between '".$from."' and '".$now."'
													UNION
													select a.*, DATE_FORMAT(a.m_tanggal,'%d-%m-%Y') as tgl, DATE_FORMAT(a.m_need,'%d-%m-%Y') as tgl2,
												 	b.nama, c.m_status as sts2, b.divisi as div1, b.dept as dept2
												 	from mscashad a left join msperjadin c on a.m_kodedinas = c.m_kode, t_mst_employee b
												 	where a.m_nik = b.nik and a.m_status = '0' and a.m_status2 = '0'  and b.divisi = '".$divisi."' and b.dept = '".$departemen."'
													and a.m_tanggal between '".$from."' and '".$now."' ";
											}
										}
										else{
											if ( $approve2 == 'Y' ){
												 $sqls = "	select a.*, DATE_FORMAT(a.m_tanggal,'%d-%m-%Y') as tgl, DATE_FORMAT(a.m_need,'%d-%m-%Y') as tgl2,
														b.nama, c.m_status as sts2
														from mscashad a left join msperjadin c on a.m_kodedinas = c.m_kode, t_mst_employee b
														where a.m_nik = b.nik and (a.m_status = '0' or a.m_status = 'Y') and a.m_status2 = '0' 
														and a.m_tanggal between '".$from."' and '".$now."' ";
											}
											else{
												//hide dayat dari Bu Yenny
												if($_SESSION['nik'] == '96.0025'){
													 $sqls = " 	select a.*, DATE_FORMAT(a.m_tanggal,'%d/%m/%Y') as tgl, DATE_FORMAT(a.m_need,'%d/%m/%Y') as tgl2,
														b.nama, b.jabatan, c.m_status as sts2
														from mscashad a left join msperjadin c on a.m_kodedinas = c.m_kode, t_mst_employee b
														where a.m_nik = b.nik and b.jabatan >= '".$rowkry['jabatan']."' 
														and a.m_tanggal between '".$from."' and '".$now."' and a.m_status2 <> 'Y' and a.m_nik <> '10.0428' ";
												}
												//close hide dayat
												else{
													 $sqls = " 	select a.*, DATE_FORMAT(a.m_tanggal,'%d/%m/%Y') as tgl, DATE_FORMAT(a.m_need,'%d/%m/%Y') as tgl2,
														b.nama, b.jabatan, c.m_status as sts2
														from mscashad a left join msperjadin c on a.m_kodedinas = c.m_kode, t_mst_employee b
														where a.m_nik = b.nik and b.jabatan >= '".$rowkry['jabatan']."' 
														and a.m_tanggal between '".$from."' and '".$now."' ";
												}
												
												if ( $jabatan <= 2 || $jabatan == $rowmin['jabjab'] ){
												 $sqls = $sqls." and b.divisi = '".$divisi."' ";
												}
												else if( $jabatan <= 6 && $jabatan >= 3){
													 $sqls = $sqls." and b.divisi = '".$divisi."'";
													if($departemen != '0'){ $sqls = $sqls. " and b.dept = '".$departemen."'"; }
													}
												else if ( $jabatan >= 7 ){
													 $sqls = $sqls." and b.divisi = '".$divisi."' and b.dept = '".$departemen."' and b.section = '".$section."'";
												}
											}
										}	
										 $sqls = $sqls." order by m_kode desc";
										$stmt2 = mysql_query($sqls);
										$i=1;
										//
										//echo $sqls;
										while( $row = mysql_fetch_assoc($stmt2))
        								{
											?>
                                        <tr class="odd gradeX">
                                            <td align="right"><?php echo $i; ?></td>
                                            <td onclick="view('<?php echo $row['m_kode'];?>','<?php echo base64_encode($parm); ?>','<?php echo $row['m_type'];?>')" style="cursor:pointer;color:#00F;" align="center"><b><?php echo $row['m_kode']; ?></b></td>
                                            <td><?php echo $row['m_nik']; ?></td>
                                            <td align="left"><?php echo $row['nama'];?></td>
                                            <td align="center"><?php echo $row['tgl']; ?></td>
                                            <td align="center"><?php echo $row['tgl2']; ?></td>
                                            <td align="center"><?php echo $row['m_kurs']; ?></td>
                                            <td align="right"><?php echo number_format($row['m_rate'], 0, '.', ','); ?></td>
                                            <td align="right"><?php echo number_format($row['m_jumlah']*$row['m_rate'], 0, '.', ','); ?></td>
                                            <td align="left"><?php if( strlen( $row['m_ket']) > 50){echo substr($row['m_ket'],0,50)."..."; }else{echo $row['m_ket'];} ?></td>
                                            <td>
<!-- ---------------------------------- IF Approval 1 -->												
												<?php if( $row['m_type'] == '1' ){
														  if( $approve2 == 'Y' ){
															if( $row['m_status'] == '0' ){ ?>
															<input type="button" class="btn btn-sm btn-warning" style="cursor:pointer" value="Approve" id="app1" onclick="approve1('<?php echo $row['m_kode'];?>','<?php echo base64_encode($parm);?>','<?php echo $row['m_type']; ?>')" /><?php }
															else { echo ""; }
														  }//penutup approve2 == Y 
														  else{
															if($row['m_status'] == '0' && $approve1 == 'Y'  && ($jabatan < $row['jabatan'] || $jabatan == $rowmin['jabjab'])){ ?>
															<input type="button" class="btn btn-sm btn-warning" style="cursor:pointer" value="Approve" id="app1" onclick="approve1('<?php echo $row['m_kode'];?>','<?php echo base64_encode($parm); ?>','<?php echo $row['m_type']; ?>')" /><?php } 
															else if($rowmst['m_kode'] != '' && $row['div1'] == $divisi && $row['dept2'] == $departemen ){
															?>
                                                            <input type="button" class="btn btn-sm btn-warning" style="cursor:pointer" value="Approve" id="app1" onclick="approve1('<?php echo $row['m_kode'];?>','<?php echo base64_encode($parm); ?>','<?php echo $row['m_type']; ?>')" />
                                                            <?php
															}
															else { echo ""; } 
														  }//penutup else
													  }//penutup m_type == 1
													  else if ( $row['m_type'] == '2' ){ 
													  if( $approve2 == 'Y' ){
														if( $row['m_status'] == '0' ){ ?>
														<input type="button" class="btn btn-sm btn-warning" style="cursor:pointer" value="Approve" id="app1" onclick="approve1('<?php echo $row['m_kode'];?>','<?php echo base64_encode($parm);?>','<?php echo $row['m_type']; ?>')" /><?php }
														else { echo ""; }
													  }//penutup approve 2 == Y 
													  else{
															if($row['m_status'] == '0' && $approve1 == 'Y'  && ($jabatan < $row['jabatan'] || $jabatan == $rowmin['jabjab'])){ ?>
															<input type="button" class="btn btn-sm btn-warning" style="cursor:pointer" value="Approve" id="app1" onclick="approve1('<?php echo $row['m_kode'];?>','<?php echo base64_encode($parm); ?>','<?php echo $row['m_type']; ?>')" /><?php } 
															else if($rowmst['m_kode'] != '' && $row['div1'] == $divisi && $row['dept2'] == $departemen ){
															?>
                                                            <input type="button" class="btn btn-sm btn-warning" style="cursor:pointer" value="Approve" id="app1" onclick="approve1('<?php echo $row['m_kode'];?>','<?php echo base64_encode($parm); ?>','<?php echo $row['m_type']; ?>')" />
                                                            <?php
															}
															else { echo ""; } 
														  }//penutup else
													  }//penutup m_type == 2
													  else{ echo ""; } ?>
<!-- ---------------------------------- IF Approval 2 -->
													
                                            	<?php 	if($row['m_type'] == '1'){
														if($row['m_status'] == 'Y' && $row['m_status2'] == '0' && $rowmst['m_kode'] != ''){ ?>
                                            		<input type="button" class="btn btn-sm btn-info" style="cursor:pointer" value="Approve" id="acc" onclick="approve2('<?php echo $row['m_kode'];?>','<?php echo base64_encode($parm); ?>','<?php echo $row['m_type']; ?>')" /><?php } else { echo ""; }}
														else if( $row['m_type'] == '2' ){
													if($row['m_status'] == 'Y' && $row['sts2'] == 'Y' && $row['m_status2'] != 'Y' && $rowmst['m_kode'] != ''){ ?>
                                            		<input type="button" class="btn btn-sm btn-info" style="cursor:pointer" value="Approve" id="acc" onclick="approve2('<?php echo $row['m_kode'];?>','<?php echo base64_encode($parm); ?>','<?php echo $row['m_type']; ?>')" /><?php } else { echo ""; }
															} ?>
<!-- ---------------------------------- IF Edit -->                                        		
												<?php if($row['m_type'] == '1'){
													  	  if($row['m_status'] == '0' && $row['m_nik'] == $_SESSION['nik']){?>
                                                	<input type="button" style="cursor:pointer;" class="btn btn-sm btn-danger" onClick="editnumber('<?php echo base64_encode($parm); ?>','<?php echo $row['m_kode']; ?>','<?php echo base64_encode($row['m_nik']); ?>','<?php echo $row['m_type']; ?>')" id="edit" value="Edit" /><?php } else { echo ""; }}
													  else if($row['m_type'] == '2'){
														  if( $row['m_status'] != 'Y' && $row['m_nik'] == $_SESSION['nik']){ ?>
															  <input type="button" style="cursor:pointer;" class="btn btn-sm btn-danger" onClick="editnumber('<?php echo base64_encode($parm); ?>','<?php echo $row['m_kode']; ?>','<?php echo base64_encode($row['m_nik']); ?>','<?php echo $row['m_type']; ?>')" id="edit" value="Edit" /><?php } else { echo ""; } 
															  } ?></td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Description
                            </div> 
                            <div class="panel-body">
                                <div class="table-responsive">
                                	<table>
                                    	<tr>
                                        	<td width="20" align="right">1.</td>
                                            <td width="100" align="center"><input type="button" style="width:80px;" class="btn btn-sm btn-warning" value="Approve" /></td>
                                            <td align="left">Approval Manager</td>
                                        </tr>
                                       	<tr>
                                        	<td width="20" align="right">2.</td>
                                            <td width="100" align="center"><input type="button" style="width:80px;" class="btn btn-sm btn-info" value="Approve" /></td>
                                            <td align="left">Approval FAD</td>
                                        </tr>
                                        <tr>
                                        	<td width="20" align="right">3.</td>
                                            <td width="100" align="center"><input type="button" style="width:80px;" class="btn btn-sm btn-danger" value="Edit" /></td>
                                            <td align="left">Edit Chash Advance before Approved or Unapproved</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php /*?><div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                Tasks Panel
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge">7 minutes ago</span>
                                        <i class="fa fa-fw fa-comment"></i> Commented on a post
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">16 minutes ago</span>
                                        <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">36 minutes ago</span>
                                        <i class="fa fa-fw fa-globe"></i> Invoice 653 has paid
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> A new user has been added
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1.23 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> A new user has added
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">yesterday</span>
                                        <i class="fa fa-fw fa-globe"></i> Saved the world
                                    </a>
                                </div>
                                <div class="text-right">
                                    <a href="#">More Tasks <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                     </div><?php */?>
                </div>
                <!-- /. ROW  -->
				<?php include "footer.php"; ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <div class="modal fade" id="approve_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<span id="approve1">
    	</span>
    </div>
    <div class="modal fade" id="approve_modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<span id="approve2">
    	</span>
    </div>
    <div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<span id="view">
    	</span>
    </div>
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <!--<script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>-->
	<script type="text/javascript" language="javascript" src="../assets/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
	$(document).ready(function() {
	$('#dataTables-example').dataTable( {
		"lengthMenu": [[25, 50, 100, 500, -1], [25, 50, 100, 500, "All"]],
		"pagingType": "full_numbers"
	} );
	} );
	</script>
    
         <!-- Custom Js -->
    <script src="../assets/js/custom-scripts.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets/js/myjs.js"></script>
    <script type="text/javascript">
	function approve1(nomor, akses, type)
		{
			var ttp = type;
			var data={n:nomor,a:akses};
			var fungsi=function(respon){
					$("#approve1").html(respon);
				};
			if(ttp == '1'){
				$("#approve1").html('<img src="../assets/img/loadingz.gif"/>');
				$.get('mscashad-app1.php',data,fungsi);}
			if(ttp == '2'){
				$("#approve1").html('<img src="../assets/img/loadingz.gif"/>');
				$.get('mscashad-dinas-app1.php',data,fungsi);}
			$('#approve_modal').modal();
		}
	function approve2(nomor, akses, type)
		{
			var ttp = type;
			var data={n:nomor,a:akses};
			var fungsi=function(respon){
					$("#approve2").html(respon);
				};
			if(ttp == '1'){
				$("#approve2").html('<img src="../assets/img/loadingz.gif"/>');
				$.get('mscashad-app2.php',data,fungsi);}
			if(ttp == '2'){
				$("#approve2").html('<img src="../assets/img/loadingz.gif"/>');
				$.get('mscashad-dinas-app2.php',data,fungsi);}
			
			$('#approve_modal2').modal();
		}
	function view(nomor, akses, type)
		{
			var ttp = type;
			var data={n:nomor,a:akses};
			var fungsi=function(respon){
					$("#view").html(respon);
				};
			if(ttp == '1'){
				$("#view").html('<img src="../assets/img/loadingz.gif"/>');
				$.get('mscashad-view.php',data,fungsi);}
			else if(ttp == '2'){
				$("#view").html('<img src="../assets/img/loadingz.gif"/>');
				$.get('mscashad-dinas-view.php',data,fungsi);}
			
			$('#view_modal').modal();
		}
	function editnumber(akses, nomor, nik, type)
	{
		var ttp = type;
		if(ttp == '1'){window.open('mscashad-new.php?prm='+akses+'&nmr='+nomor+'&nk='+nik,'_top');}
		else if (ttp == '2'){window.open('mscashad-dinas-new.php?prm='+akses+'&nmr='+nomor+'&nk='+nik,'_top');}	
	}
    </script>
</body>
</html>