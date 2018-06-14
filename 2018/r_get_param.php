
<?
//get a แต่ละเดือน



//get a-e แต่ละเดือน




  for($i=1;$i<=12;$i++)
  {
	  if($i>=10)
	  {
		  $y="2017-$i-01";
	  }else{
		   $y="2018-0$i-01";
		  
	  }
	  
	  //เก็บหาว่า เดือนนั้นๆ kpi ตัวนี้ ถูกผิดการแก้ไขยัง โดย ดูจาก ตาราง kpi_disabled
					$k_disabled[$i]=getsqldata('select k_disabled  cc from kpi_disabled where kpi_id="'.$_GET[content].'" and kpi_month = "'.$y.'" ');
					
	  		$k_dis[$i]='select k_disabled  cc from kpi_disabled where kpi_id="'.$_GET[content].'" and kpi_month = "'.$y.'" ';
	  
	  
	  
	  //หาค่า $a-$e แต่ละเดือน
	   $a[$i]=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$_GET[content].'" and b.did=a.a and c.kpi_month="'.$y.'" and c.hospcode = "'.$r[hospcode].'"');
	   $b[$i]=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$_GET[content].'" and b.did=a.b and c.kpi_month="'.$y.'" and c.hospcode = "'.$r[hospcode].'"');
	  
	  $c[$i]=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$_GET[content].'" and b.did=a.c and c.kpi_month="'.$y.'" and c.hospcode = "'.$r[hospcode].'"'); 
	  
	  
	   $d[$i]=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$_GET[content].'" and b.did=a.d and c.kpi_month="'.$y.'" and c.hospcode = "'.$r[hospcode].'"'); 
	  
	   $e[$i]=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$_GET[content].'" and b.did=a.e and c.kpi_month="'.$y.'" and c.hospcode = "'.$r[hospcode].'"'); 
	  
  }








?>