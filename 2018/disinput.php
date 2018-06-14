<!doctype html>
<html lang="en">
<?php 
	session_start();
	error_reporting(0);//ปิดแจ้งเตือน error
require("connect_db.php");
	require("authen.php");
	
?>
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Cockpit R11</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="../assets/css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
     
    
    <link rel="stylesheet" href="fonts/thsarabunnew.css">
    	
	
<script language="JavaScript">
<!--
function closewin() {
window.opener.location.reload();
self.close();
}
</script>
</head>

<body>
<?php
	
	//chk สิทธิการแก้
	if($_SESSION["pcuGroup"] <> 'admin' )
	{
		?>
		<div class="text-center container">
		<h3 class="title text-danger">คุณไม่มีสิทธิ์เข้าถึงข้อมูลส่วนนี้ </h3>
		<input type="button" class="btn btn-primary btn-round btn-lg" value="ปิด" onClick="closewin();">
	</div>
		<?
		
		exit();
	}
	
	//end chk สิทธิการแก้

?>
	<div class="wrapper thsarabunnew">
	 
	 <?
		
	
			
			//echo "$_POST[kpi_num]<br>";
			
		
		$s="replace into kpi_disabled set 	
		kpi_id ='".$_GET[kpi]."', 
		kpi_month ='".$_GET[m]."', 
		k_disabled = '".$_GET[d]."' 
		";
		//$a = mysql_real_escape_string($_POST['hospcode'],$i);
		//echo "$txt";
		$q=mysql_query($s);
		if($q){
			
			echo "บันทึก/แก้ไขข้อมูลตัวชี้วัดย่อยที่ $_GET[kpi] กำหนดปิดการบันทึกข้อมูล = $_GET[d] สำเร็จ <br>";
			
		}else{
			echo "บันทึก/แก้ไขข้อมูลตัวชี้วัดย่อยที่ $_GET[kpi] กำหนดปิดการบันทึกข้อมูล = $_GET[d] ผิดพลาด<br>";
		}
			
		
	
			
		
			?>
			 <input type="button" class="btn btn-primary btn-sm btn-round" value="ปิด" onClick="closewin();">
	
	
	
	
	

	
	<br>
<br>
<br>
<br>
<br>

	<iframe src="http://www.rdc11.go.th/cockpit11/line_notify/notice.php?message=<?="$sms";?>"></iframe>
	
	
	
	</div>

</body>

	<!--   Core JS Files   -->
	<script src="../assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../assets/js/material.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="../assets/js/bootstrap-notify.js"></script>

	<!--  Google Maps Plugin    -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

	<!-- Material Dashboard javascript methods -->
	<script src="../assets/js/material-dashboard.js"></script>

	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>



</html>
