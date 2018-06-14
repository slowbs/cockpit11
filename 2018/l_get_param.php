<?php


$s_target=getsqldata('select static_target cc from kpi_head where kpi_id="'.$kpi_id.'"');

if($s_target == 'Y'){
	
	$a=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.a and (c.kpi_value<> "" or c.kpi_value is null) ) as st ');
	
	$b=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.b and (c.kpi_value<> "" or c.kpi_value is null) ) as st ');
	$c=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.c and (c.kpi_value<> "" or c.kpi_value is null) ) as st ');
	$d=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.d and (c.kpi_value<> "" or c.kpi_value is null) ) as st ');
	
	$e=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.e and (c.kpi_value<> "" or c.kpi_value is null) ) as st ');
	
}else{
	
	$a=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.a ;');
	$b=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.b ;');
	$c=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.c ;');
	$d=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.d ;');
	$e=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.e ;');
	
}



//คำนวนสูตร

$fs=getsqldata("select kpi_formula_script cc from kpi_head where kpi_id='$kpi_id'");
					
					
					
					if($fs == 'a')
					{
						
							$max=100;
							
							if($b>0){
								$sumx=($a/$b)*100;
								}
						
						
					}
					
					if($fs == 'b')
					{
						
							
						
						$max=100000;
							
							if($b>0){
								$sumx=($a/$b)*100000;
								}
						
						
					}
					
					
					if($fs == 'c')
					{
						
							
						$max=100;
					
							
							if(($b+$d)>0){
								$sumx=(($a+$c)/($b+$d))*100;
								}
						
						
					}

						if($fs == 'd')
					{
						
							
						$max=100;
							
							
							if($d>0){
								$sumx=(($a+$b+$c)/$d)*100;
								}
						
						
					}
					
						if($fs == 'e')
					{
						
							
						$max=100;
							
							
							if($d>0){
								$sumx=(($a+$b)/$c)*100;
								}
						
						
					}
					
					
if($fs == 'f')
					{
						
							$max=1000;
						
							if($b >0){
								$sumx =($a /$b )*1000;
								}
						
						
					}

				if($fs == 'g')
					{
						
							
						
						$max=100;
							
							if($b >0){
								$sumx =($a /$d )*100;
								}
						
						
					}

				if($fs == 'h')
					{
						
							
						$max=100;
						
							
							if($b >0){
								$sumx =($c /$d )*100;
								}
						
						
					}

				if($fs == 'i')
					{
						
							
						$max=100;
						
							
							if($b >0){
								$sumx =(($a -$b )/$b )*100;
								}
						
						
					}
				if($fs == 'j')
					{
						
							
						
						
							$max=$a;
							
								$sumx =$a ;
								
						
						
					}







?>