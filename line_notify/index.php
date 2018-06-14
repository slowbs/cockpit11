#!/usr/bin/php -q

<?
$host="192.168.1.254";
$user = "nws";
$pw="nws";


$db = "ds_asset";

	mysql_connect($host,$user,$pw) or die ("เธ•เธดเธ”เธ•เน?เธญเธ?เธฒเธ?เธ?เน?เธญเธกเธนเธฅเน?เธกเน?เน?เธ”เน?");
	mysql_select_db($db) or die ("เน€เธฅเธทเธญเธ?เธ?เธฒเธ?เธ?เน?เธญเธกเธนเธฅเน?เธกเน?เน?เธ”เน?");
	mysql_query("SET NAMES UTF8");

$s="SELECT 0-(timestampdiff(day,a.master_date_expire_warranty,curdate())) as date_exp
,a.master_date_expire_warranty,concat('รหัสเครื่องมือ ',a.ds_master_id,' ',a.master_name,' หน่วยงานที่รับผิดชอบ ',m.master_plan_name,' ใกล้จะสิ้นสุดอายุการรับประกันในอีก ',0-(timestampdiff(day,a.master_date_expire_warranty,curdate())),'วัน') as cc

 from ds_master_record a ,ds_master_plan m
where a.master_subplan=m.master_plan_id AND
 master_date_expire_warranty >= CURDATE() 
and 0-(timestampdiff(day,a.master_date_expire_warranty,curdate())) <= 20";

$q=mysql_query($s);
$n=mysql_num_rows($q);
if($n>=0)
{
$xname="";
while($r=mysql_fetch_array($q))
	{
?>

 <iframe src="http://192.168.1.254/line_notify/notice.php?message=<?="$r[cc]";?>"></iframe>

<?
	}
}
	
//echo "$xname";
?> 
 

     