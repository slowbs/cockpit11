  <div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">

			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

		        Tip 2: you can also add an image using data-image tag
		    -->

			<div class="logo" >
			    
				<img src="../assets/img/avatar_hat.jpg" style="width:210px;">
				
			</div>

	    	<div class="sidebar-wrapper">
	            <ul class="nav">
	                <li class="active">
	                    <a href="index.php">
	                        <i class="material-icons">dashboard</i>
	                        <p>Dashboard</p>
	                    </a>
	                </li>
	            </ul>
	            
	           <center><span class="label label-danger"><a href="index.php?l=all">All</a></span><span class="label label-info"><a href="index.php?l=pa">PA</a></span><span class="label label-warning"><a href="index.php?l=h_kpi">กตร</a></span><span class="label label-success"><a href="index.php?l=hdc">hdc</a></span></center>
	            
	 <div id="myDropdown" class="dropdown-content">  
     <input type="text" placeholder="Search.." class="form-control" id="myInput" onkeyup="filterFunction()">      
	               
	            <div class="panel-group" id="accordion">
  
  <?php 
					if($_GET["l"] == "all")
					{
						$g=" ";
						
					}
					if($_GET["l"] == "pa")
					{
						$g="pa='Y' and";
						
					}
					if($_GET["l"] == "h_kpi")
					{
						$g="h_kpi='Y' and";
						
					}
					if($_GET["l"] == "hdc")
					{
						$g="hdc='Y' and";
						
					}
			
			$sql="select * from kpi_head where  $g (main_kpi_id = '' or main_kpi_id is null) ";
 
 
			 $q=mysql_query($sql);
			 $num = mysql_num_rows($q);
					$x=0;
				while($r=mysql_fetch_array($q))
			{
						$x=$x+1;
				
				
				if(substr("$r[kpi_id]",0,3) == substr("$_GET[content]",0,3) )
				{
					$col=" in ";
				}
			?>
   <div class=" panel panel-default ">
    <div class="panel-heading">
    
      <h4 class="panel-title">
       <?php
		if($r["pa"] <> '')
		{
			?>
			<span class="label label-info">PA</span>
			<?
			
		}
		
		?>
     <?php
		if($r["h_kpi"] <> '')
		{
			?>
			<span class="label label-primary">กตร</span>
			<?
			
		}
		
		?>
     <?php
		if($r["hdc"] <> '')
		{
			?>
			<span class="label label-success">hdc</span>
			<?
			
		}
		
		?>
       
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?="$x";?>" class="thsarabunnew"  style="font-size:80%;">
        <?php echo "$r[kpi_name]"; ?> </a>
        
         
      </h4>
      
      	
      <?php
				$kpi_id=$r[kpi_id] ;
				
				//สร้างตัวแปร  $max ไว้เก็บค่าสูงสุดของ เกจ bar และจะถูกกำหนดในไฟล์ l_get_param.php
				$max=0;
						require("l_get_param.php");
						
		?>
      
    </div>
    <div id="collapse<?="$x";?>" class="panel-collapse collapse <?="$col";?> ">
     
      <div class="panel-body">
      
      
      
      <?
				//เช็คว่า ถ้าเป็นkpi จาก hdc ให้ link ไปที่ตัวชี้วัดนั้น ในเว้บ hdc เลย ถ้าไม่ใช่ค่อยแสดงข้อมูล
		  if($r["hdc"] == "Y")
		  {
			  ?>
			  
			   <a href="<?="$r[etc]";?>" name="<?="$r[kpi_id]";?>" target="_blank" ><p class="thsarabunnew" style="font-size:90%;" ><?php echo "$r[kpi_name]"; ?></p></a>
						
			  
			  <?
			  
			  
		  }else{
			  
			  	//เช็คว่า ถ้ามี kpi ย่อย ไม่ต้องประมวลผล kpi หลัก เพราะยังไม่แน่ใจในสูตรการประมวลผล kpi ภาพรวมแต่ละตัวกรณีที่มี kpi ่ย่อย
			  
			  		$numkpi= getsqldata('select count(kpi_id) as cc from kpi_head where main_kpi_id = "'.$r[kpi_id].'"');
			  
			  		if($numkpi > 0){
						
					}else{
		  ?>
            
               
      
     				 <a href="index.php?content=<?="$r[kpi_id]";?>#<?="$r[kpi_id]";?>" name="<?="$r[kpi_id]";?>" ><p class="thsarabunnew" style="font-size:90%;" ><?php echo "$r[kpi_name]"; ?></p></a>
     				 
						<div class="progress">
						  <div class="progress-bar" role="progressbar" aria-valuenow="<?="$sumx";?>"
						  aria-valuemin="0" aria-valuemax="100" style="width:<? echo ($sumx/$max)*100  ?>%">
								<p style="color:darkgrey"><? echo round($sumx,2);?><? if($max==100){echo "%";} ?> </p>
						  </div>
						</div> 
			<?
					}//end chk num kpi
		  }//end chk hdc=Y
		  ?>			
						
						
						
			<?php
		  //clear $a,$b,$c,$d,$e $sum ก่อน loop รอบใหม่
						$a="";
						$b="";
						$c="";
						$d="";
						$e="";
						$sumx="";
		  ?>			
      
      
      
      
      <?php
      $sql2="select * from kpi_head where main_kpi_id = '$r[kpi_id]'  ";
 
 
			 $q2=mysql_query($sql2);
			 $numx = mysql_num_rows($q);
			if($numx>0){		
				while($r2=mysql_fetch_array($q2))
					{
					
						// defined $kpi_id ไปให้ l_get_param.php
						$kpi_id=$r2[kpi_id] ;
						require("l_get_param.php");
						
						?>
						<a href="index.php?content=<?="$r2[kpi_id]";?>#<?="$r2[kpi_id]";?>" name="<?="$r2[kpi_id]";?>" ><p class="thsarabunnew" style="font-size:90%;"><?php echo "$r2[kpi_name]"; ?></p>  </a>
						<div class="progress">
						  <div class="progress-bar" role="progressbar" aria-valuenow="<?="$sumx";?>"
						  aria-valuemin="0" aria-valuemax="100" style="width:<? echo ($sumx/$max)*100  ?>%">
								<p style="color:darkgrey"><? echo round($sumx,2);?><? if($max==100){echo "%";} ?> </p>
						  </div>
						</div> 

				<?php
						//clear $a,$b,$c,$d,$e $sum ก่อน loop รอบใหม่
						$a="";
						$b="";
						$c="";
						$d="";
						$e="";
						$sumx="";

							
						
					}
			}
		  ?>
  	  
  	  
   	  </div>
    </div>
  </div>
  <?php
				$col ="";
			}
					?>
  
  
</div> 
	</div>           
	    	</div>
		</div>