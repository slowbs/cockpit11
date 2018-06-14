
	<html>
<head>
<title>ThaiCreate.Com PHP & MySQL (mysqli)</title>
</head>
<body>
<?php

	ini_set('display_errors', 1);
	error_reporting(~0);

   $serverName = "localhost";
   $userName = "root";
   $userPassword = "region11++";
   $dbName = "r11_cockpit";
  
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	if (mysqli_connect_errno())
	{
		echo "Database Connect Failed : " . mysqli_connect_error();
	}
	else
	{
		echo "Database Connected.";
	}

	mysqli_close($conn);
?>
</body>
</html>

	
