<?php

$h=$r[hospcode];
$aa="";
$bb="";
 $cc="";
$dd="";
$ee="";
$s_target=getsqldata('select static_target cc from kpi_head where kpi_id="'.$kpi_id.'"');

if($s_target == 'Y'){
	
	$aa=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.a and (c.kpi_value<> "" or c.kpi_value is null) ) as st where hospcode ="'.$h.'" ');
	
	$bb=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.b and (c.kpi_value<> "" or c.kpi_value is null) ) as st  where hospcode ="'.$h.'"  ');
	$cc=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.c and (c.kpi_value<> "" or c.kpi_value is null) ) as st  where hospcode ="'.$h.'"  ');
	$dd=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.d and (c.kpi_value<> "" or c.kpi_value is null) ) as st  where hospcode ="'.$h.'"  ');
	
	$ee=getsqldata('
SELECT sum(cc) as cc from 
(SELECT c.kpi_month,c.kpi_value  cc,c.hospcode from kpi_head a,kpi_detail b,kpi_input c ,
(SELECT max(kpi_month) m,did,kpi_value  ,hospcode from kpi_input  
where  (kpi_value<> "" or kpi_value is null) GROUP BY hospcode,did) as d

where  a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'" and CONCAT(c.hospcode,c.did,c.kpi_month) = CONCAT(d.hospcode,d.did,d.m)
and b.did=a.e and (c.kpi_value<> "" or c.kpi_value is null) ) as st   where hospcode ="'.$h.'" ');
	
}else{
	
	$aa=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.a  and hospcode ="'.$h.'" ');
	$bb=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.b  and hospcode ="'.$h.'" ');
	$cc=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.c  and hospcode ="'.$h.'" ');
	$dd=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.d  and hospcode ="'.$h.'" ');
	$ee=getsqldata('SELECT sum(c.kpi_value)  cc from kpi_head a,kpi_detail b,kpi_input c 
where a.kpi_id=b.kpi_id and b.did=c.did and a.kpi_id="'.$kpi_id.'"
and b.did=a.e  and hospcode ="'.$h.'" ');
	
}



//คำนวนสูตร

$fx=getsqldata("select kpi_formula_script cc from kpi_head where kpi_id='$kpi_id'");
					
					
					
					if($fx == 'a')
					{
						
							
							
							if( $bb>0){
								$sumt=( $aa/ $bb)*100;
								}
						
						
					}
					
					if($fx == 'b')
					{
						
							
						
						
							
							if( $bb>0){
								$sumt=( $aa/ $bb)*100000;
								}
						
						
					}
					
					
					if($fx == 'c')
					{
						
							
						
					
							
							if(( $bb+ $dd)>0){
								$sumt=(( $aa+ $cc)/( $bb+ $dd))*100;
								}
						
						
					}

						if($fx == 'd')
					{
						
							
						
							
							
							if( $dd>0){
								$sumt=(( $aa+ $bb+ $cc)/ $dd)*100;
								}
						
						
					}
					
						if($fx == 'e')
					{
						
							
						
							
							
							if( $dd>0){
								$sumt=(( $aa+ $bb)/ $cc)*100;
								}
						
						
					}
					
					
if($fx == 'f')
					{
						
							
						
							if( $bb >0){
								$sumt =( $aa / $bb )*1000;
								}
						
						
					}

				if($fx == 'g')
					{
						
							
						
						
							
							if( $bb >0){
								$sumt =( $aa / $dd )*100;
								}
						
						
					}

				if($fx == 'h')
					{
						
							
						
						
							
							if( $bb >0){
								$sumt =( $cc / $dd )*100;
								}
						
						
					}

				if($fx == 'i')
					{
						
							
						
						
							
							if( $bb >0){
								$sumt =(( $aa - $bb )/ $bb )*100;
								}
						
						
					}
				if($fx == 'j')
					{
						
							
						
						
							
							
								$sumt = $aa ;
								
						
						
					}







?>