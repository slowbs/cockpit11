<?
//error_reporting(0);//ปิดแจ้งเตือน error
require("connect_db.php");
   function fncAuthentication() {
      header('WWW-Authenticate: Basic realm="localhost"');
      header("HTTP/1.0 401 Unauthorized");
      exit;
   }
	
	//*** Check user ***//
   if (trim($_SERVER['PHP_AUTH_USER'])!= "" and trim($_SERVER['PHP_AUTH_PW']) != "")
   {
	$u = trim($_SERVER['PHP_AUTH_USER']);
	$p =trim($_SERVER['PHP_AUTH_PW']);
	$pw=md5($p);
		$sql = "select * from user where username = '$u' and password = '$pw'";
		$q=mysql_query($sql);
				
			
			if($r=mysql_fetch_array($q))
			{
				$_SESSION["strUser"] = $_SERVER['PHP_AUTH_USER'];
				$_SESSION["strPass"] = $_SERVER['PHP_AUTH_PW'];
							$_SESSION["pcuName"] = "$r[name] $r[lname]";
							$_SESSION["pcuCode"] = "$r[hospcode]";	
				$_SESSION["pcuGroup"] = "$r[group]";	
			}
					
				
		
		//mysql_close();
   }
	
	//*** Session ***//
   if(trim($_SESSION["strUser"])=="" or trim($_SESSION["strPass"])=="")
   {
	   fncAuthentication();	   
	   exit();
   }
?>
