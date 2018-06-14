<?php 



//คำนวนสูตร

$fs=getsqldata("select kpi_formula_script cc from kpi_head where kpi_id='$_GET[content]'");
					
					
					
					if($fs == 'a')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($b[$i]>0){
								$sumx[$i]=($a[$i]/$b[$i])*100;
								}
						
						}
					}
					
					if($fs == 'b')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($b[$i]>0){
								$sumx[$i]=($a[$i]/$b[$i])*100000;
								}
						
						}
					}
					
					
					if($fs == 'c')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if(($b[$i]+$d[$i])>0){
								$sumx[$i]=(($a[$i]+$c[$i])/($b[$i]+$d[$i]))*100;
								}
						
						}
					}

						if($fs == 'd')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($d[$i]>0){
								$sumx[$i]=(($a[$i]+$b[$i]+$c[$i])/$d[$i])*100;
								}
						
						}
					}
					
						if($fs == 'e')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($d[$i]>0){
								$sumx[$i]=(($a[$i]+$b[$i])/$c[$i])*100;
								}
						
						}
					}
					
					
if($fs == 'f')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($b[$i]>0){
								$sumx[$i]=($a[$i]/$b[$i])*1000;
								}
						
						}
					}

				if($fs == 'g')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($b[$i]>0){
								$sumx[$i]=($a[$i]/$d[$i])*100;
								}
						
						}
					}

				if($fs == 'h')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($b[$i]>0){
								$sumx[$i]=($c[$i]/$d[$i])*100;
								}
						
						}
					}

				if($fs == 'i')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($b[$i]>0){
								$sumx[$i]=(($a[$i]-$b[$i])/$b[$i])*100;
								}
						
						}
					}
				if($fs == 'j')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							
								$sumx[$i]=$a[$i];
								
						
						}
					}




?>