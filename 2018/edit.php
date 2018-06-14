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
	if($_SESSION["pcuCode"] <> $_GET["hospcode"] && $_SESSION["pcuGroup"] <> 'admin' )
	{
		?>
		<div class="text-center container">
		<h3 class="title text-danger">คุณสามารถแก้ไขข้อมูลได้เฉพาะในเขตของคุณเท่านั้น </h3>
		<input type="button" class="btn btn-primary btn-round btn-lg" value="ปิด" onClick="closewin();">
	</div>
		<?
		
		exit();
	}
	
	//end chk สิทธิการแก้

?>
	<div class="wrapper thsarabunnew">
	 
	 <?
		if($_GET["m"]>=10){
						$y="2017-$_GET[m]-01";
					}else{
						$y="2018-$_GET[m]-01";
						
					}
		//เช็คว่ามีตัวแปร $_POST[kpi_num] ยัง ถ้ายังให้แสดงฟอร์มกรอกข้อมูล  ถ้ามีแล้ว ให้ทำการันทึกข้า database 
		if(!isset($_POST[kpi_num]))
		{
		?>
	
		<form method="post" action="edit.php?hospcode=<?="$_GET[hospcode]";?>">		
			<div class="card">
				<div class="card-header text-center" data-background-color="purple">
					<h5 class="title thsarabunnew">ข้อมูลตัวชี้วัด</h5>
					<span class="category"><? echo getsqldata('SELECT kpi_name cc from kpi_head where kpi_id = "'.$_GET[kpi].'"  ');  ?></span>
				</div>
				<div class="card-content">
					
                

				<?php
					
					
					
						
						
					 $sql2="SELECT * from kpi_detail where kpi_id ='$_GET[kpi]' ORDER BY kpi_type asc ";
 
 						$n=0;
					 $q2=mysql_query($sql2);
					// $numx = mysql_num_rows($q);
							
						while($r2=mysql_fetch_array($q2))	{
						$n=$n+1;
					?>
						
               	
             	
             	<div class="form-group label-floating has-success">
					<label class="control-label"><?="$r2[detail_name]";?>(<?="$r2[kpi_type]";?>)</label>
					<input type="text" name="kpi_value<?="$n";?>" 
					  value="<?php echo getsqldata('SELECT kpi_value cc from kpi_input where hospcode="'.$_GET[hospcode].'" and kpi_month = "'.$y.'" and did="'.$r2[did].'"'); ?>"
					  class="form-control">
				</div>

              	
              			<input type="hidden" value="<?="$r2[did]";?>" name="did<?="$n";?>" />
              			<input type="hidden" value="<?="$r2[kpi_id]";?>" name="kpi_id<?="$n";?>" />

               	
                	<?php 
					}
					
					
					?>

                
              </div>
              <div class="card-footer justify-content-center text-center">
                <input type="hidden" value="<?="$n";?>" name="kpi_num" />
                 <input type="hidden" value="<?="$_GET[hospcode]";?>" name="hospcode" />
                <input type="hidden" value="2018" name="kpi_year" />
                <input type="hidden" value="<?="$y";?>" name="y" />
                
                <input type="hidden" value="<? echo getsqldata('SELECT kpi_name cc from kpi_head where kpi_id = "'.$_GET[kpi].'"  ');  ?>" 
                
                name="kname" />
                
                
                <input type="submit" class="btn btn-primary btn-sm btn-round " value="บันทึกการแก้ไข" >
                
               <input type="button" class="btn btn-primary btn-sm btn-round" value="ปิด" onClick="closewin();">
              </div>
					
					
					
					
					
				
				
			</div>
		
</form>	
	
	
	<?
		}else{
			
			echo "$_POST[kpi_num]<br>";
			
			$input_date=date("Y-m-d");
		
		
	for($i=1;$i<=$_POST["kpi_num"];$i++)
	{
		$s="replace into kpi_input set 	
		hospcode='".$_POST["hospcode"]."',
		did ='".$_POST["did$i"]."' ,
		kpi_month ='$_POST[y]' ,
		kpi_year  ='$_POST[kpi_year]', 
		kpi_value ='".$_POST["kpi_value$i"]."' ,
		input_date ='$input_date', 
		d_update ='$input_date', 
		kpi_id ='".$_POST["kpi_id$i"]."' 
		";
		//$a = mysql_real_escape_string($_POST['hospcode'],$i);
		//echo "$txt";
		$q=mysql_query($s);
		if($q){
			
			echo "บันทึก/แก้ไขข้อมูลตัวชี้วัดย่อยที่ $_POST[did] = $_POST[kpi_value] สำเร็จ<br>";
			
		}else{
			echo "บันทึก/แก้ไขข้อมูลตัวชี้วัดย่อยที่ $_POST[did] = $_POST[kpi_value] ผิดพลาด<br>";
		}
			
		
	}
			$t=getsqldata('SELECT concat(b.hosptype,b.name) as cc from user a,hospcode b where a.hospcode=b.hospcode and a.username ="'.$_SESSION["strUser"].'"');
			$sms= "คุณ".$_SESSION["pcuName"]." $t ได้แก้ไขข้อมูล ตัวชี้วัด $_POST[kname] เมื่อวันที่ $input_date" ;
		
			?>
			 <input type="button" class="btn btn-primary btn-sm btn-round" value="ปิด" onClick="closewin();">
	<?php		
			
		}// end if isset kpi_num
		
		
		?>
	
	
	
	

	
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
