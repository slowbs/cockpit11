  <?
					function r_data($ss,$p,$m,$k)
					{  
						
						if($k=="Y")
						{
							echo round($ss,2);
						}else{
							
							 echo "<a href='#' title='' onclick=window.open('edit.php?kpi=$_GET[content]&hospcode=$p&m=$m','','width=900,height=500'); >".round($ss,2)."</a>";
							
							
							
							
							
						}
					}


					function disInput($m,$g)
					{
						if($g == "admin")
						{
							$dis= getsqldata('SELECT k_disabled as cc from kpi_disabled  where kpi_id = "'.$_GET[content].'" and kpi_month = "'.$m.'"');
							if($dis == "Y"){
								
								echo "<a href='#' title='' onclick=window.open('disinput.php?kpi=$_GET[content]&m=$m&d=N','','width=900,height=500'); ><i class='material-icons'>event_available</i></a>";
							}else{
								
								echo "<a href='#' title='' onclick=window.open('disinput.php?kpi=$_GET[content]&m=$m&d=Y','','width=900,height=500'); ><i class='material-icons'>event_busy</i></a>";
								
							}
								
							
							
							
							
						}
						
					}
					
					?>
  
  
  
  <div class="content">
	 <div class="container-fluid">
	     <div class="row">

       <?php
	// $sql2 = "select * from kpi_head where kpi_id='$_GET[content]'";
//$obj = null;
  //db_loadObject($sql2,$obj);
		 
	 ?>
     
     
     
     
     
<!-- Chart code -->
       <!--   graph-->
      <div class="col-md-12">
	<div class="card">
		<div class="card-header card-chart" data-background-color="white" style="background-color: #FFFFFF;">
			
			<div id="chartdiv"></div>	
			
		</div>
		<div class="card-content">
			<h4 class="title">กราฟแสดงภาพรวมผลงาน</h4>
			<p class="category">
		
			<span class="text-success">
			<?
			$x=0;
				//ถ้า ตัวชี้วัด success type >= ให้แสดงลูกศรขึ้น สีเขียว
				// ถ้าตัวชี้วัด <= ให้แสดงลูกศรลงสีเขียว เพื่อบอกว่า ยิ่งน้อยยิ่งดี
				 if(getsqldata('select success_type cc from kpi_head where kpi_id="'.$_GET[content].'"') == 1){
					$x=1;
					echo $x;
					 ?>
					 <i class="fa fa-long-arrow-up"></i>
					 <?
				 }
				if(getsqldata('select success_type cc from kpi_head where kpi_id="'.$_GET[content].'"') == 2){
					$x=2;
					echo $x;
					 ?>
					 <i class="fa fa-long-arrow-down"></i>
					 <?
				 }
				?>
			
			 <? echo getsqldata('select kpi_name cc from kpi_head where kpi_id="'.$_GET[content].'"');  ?> </span> </p>
		</div>
		<div class="card-footer">
			<div class="stats">
				<i class="material-icons">update</i> วันที่แสดงรายงาน <? echo date("d-m-Y H:m:s"); ?>
			</div>
		</div>
	</div>
</div>

      
     <!-- graph-->
      
       
      

       

       
       
      
      
      <!--table-->
      <div class="card">
	<div class="card-header" data-background-color="purple">
		<h4 class="title thsarabunnew"><? echo getsqldata('select kpi_name cc from kpi_head where kpi_id="'.$_GET[content].'"');  ?></h4>
		<p class="category">
		<!--Here is a subtitle for this table-->
		<?  if(getsqldata('select static_target cc from kpi_head where kpi_id="'.$_GET[content].'"') == "Y")
			echo "ตัวชี้วัดนี้ เป็นตัวชี้วัดที่มีเป้าหมายคงที่ กรุณากรอกผลงานเป็นข้อมูลสะสมในทุกเดือนที่รายงาน เช่น เดือน ต.ค. มีผลงาน 2 เดือน พ.ย. มีผลงานเพิ่มขึ้นอีก 1 ให้รายงานผลงานเดือน พ.ย. เป็น 3  ";
			?>
		<!--End subtitle for this table-->
		
		</p>
	</div>
	<div class="card-content table-responsive table-full-width">
		<table class="table">
			<thead class="text-danger">
				<th>จังหวัด</th>
				<th>ต.ค.<? disInput("2017-10-01",$_SESSION["pcuGroup"]); ?></th>
				<th>พ.ย. <? disInput("2017-11-01",$_SESSION["pcuGroup"]); ?></th>
				<th>ธ.ค.<? disInput("2017-12-01",$_SESSION["pcuGroup"]); ?></th>
				<th>ม.ค.<? disInput("2018-01-01",$_SESSION["pcuGroup"]); ?></th>
				<th>ก.พ.<? disInput("2018-02-01",$_SESSION["pcuGroup"]); ?></th>
				<th>มี.ค.<? disInput("2018-03-01",$_SESSION["pcuGroup"]); ?></th>
				<th>เม.ย.<? disInput("2018-04-01",$_SESSION["pcuGroup"]); ?></th>
				<th>พ.ค.<? disInput("2018-05-01",$_SESSION["pcuGroup"]); ?></th>
				<th>มิ.ย.<? disInput("2018-06-01",$_SESSION["pcuGroup"]); ?></th>
				<th>ก.ค.<? disInput("2018-07-01",$_SESSION["pcuGroup"]); ?></th>
				<th>ส.ค.<? disInput("2018-08-01",$_SESSION["pcuGroup"]); ?></th>
				<th>ก.ย.<? disInput("2018-09-01",$_SESSION["pcuGroup"]); ?></th>
				<th>ภาพรวม</th>
			</thead>
			<tbody>
			<?php
				//get ตัวแปรมาเก็บค่า รวมของ ตัวแปร a b c d ของทุกจังหวัด ในแต่ละเดือน เอาไว้คำนวนsummaryด้านล่างของตาราง
				for($i=1;$i<=12;$i++)
				{
					$suma[$i]=0;
					$sumb[$i]=0;
					$sumc[$i]=0;
					$sumd[$i]=0;
					$sume[$i]=0;
					
				}
				//เอาไว้คำนวนผลรวม summary เขต
				$totalA=0;
				$totalB=0;
				$totalC=0;
				$totalD=0;
				$totalE=0;
				$totalAll=0;
				
				
			
			$s="select hospcode,short_name cc from hospcode";
				$q=mysql_query($s);
				//$n=0;
				
						
				$kpi_id="$_GET[content]";

				while($r=mysql_fetch_array($q))
				{
					
					
					//สร้างตัวแปร  เก็บผลงานรวม ของแต่ละจังหวัด ในที่นี้ ใช้ array[hospcode]
				
				require("r_get_param_total.php");
				
				$total[$h] = $sumt;
					$sumt="";
				//เก็บค่าสะสม summary ของแต่ละจังหวัด ลงใน total เพื่อเอาไว้คำนวนภาพรวมด้านล่างขวา
				$totalA=$totalA+$aa;
				$totalB=$totalB+$bb;
				$totalC=$totalC+$cc;
				$totalD=$totalD+$dd;
				$totalE=$$totalE+$ee;
					
					
				//จบการสร้างตัวแปร 
				
					
					
					
					
					//$n=$n+1;
					require("r_get_param.php");
					require("r_get_fs.php");
					
					
					//เก็บค่า รวม ของตัวแปร a b c d e 
					for($i=1;$i<=12;$i++)
				{
					$suma[$i]=$suma[$i]+$a[$i];
					$sumb[$i]=$sumb[$i]+$b[$i];
					$sumc[$i]=$sumc[$i]+$c[$i];
					$sumd[$i]=$sumd[$i]+$d[$i];
					$sume[$i]=$sume[$i]+$e[$i];
					
				}
				
					
					
					
					
				?>
				<tr>
					<td><?="$r[cc]";?>    </td>
					
					
					<td> <? r_data($sumx[10],$r[hospcode],"10",$k_disabled[10]); ?> </td>
					<td> <? r_data($sumx[11],$r[hospcode],"11",$k_disabled[11]) ?></td>
					<td> <? r_data($sumx[12],$r[hospcode],"12",$k_disabled[12]) ?></td>
					<td> <? r_data($sumx[1],$r[hospcode],"01",$k_disabled[1]) ?></td>
					<td> <? r_data($sumx[2],$r[hospcode],"02",$k_disabled[2]) ?></td>
					<td> <? r_data($sumx[3],$r[hospcode],"03",$k_disabled[3]) ?></td>
					<td> <? r_data($sumx[4],$r[hospcode],"04",$k_disabled[4]) ?></td>
					<td> <? r_data($sumx[5],$r[hospcode],"05",$k_disabled[5]) ?></td>
					<td> <? r_data($sumx[6],$r[hospcode],"06",$k_disabled[6]) ?></td>
					<td> <? r_data($sumx[7],$r[hospcode],"07",$k_disabled[7]) ?></td>
					<td> <? r_data($sumx[8],$r[hospcode],"08",$k_disabled[8]) ?></td>
					<td> <? r_data($sumx[9],$r[hospcode],"09",$k_disabled[9]) ?></td>
					
					<td><?php echo round($total[$r[hospcode]],2) ;?></td>
				</tr>
			<?php
					//clear ค่า ใน array ก่อนไปคำนวน จังหวัดอื่น
					$sumx=array();
				}
				?>
				
				
				<?
					
				
					
				
				
				//ดึง $fs จากไฟล์ require("r_get_fs.php"); ที่เรียกไว้ด้านบน มาคำนวน 
				
						if($fs == 'a')
					{
						
						
						if($totalB>0)
							{
								$totalAll=($totalA/$totalB)*100;
								}
						
						
						
						
						
						
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($sumb[$i]>0){
								$sumx[$i]=($suma[$i]/$sumb[$i])*100;
								}
						
						}
					}
					
					if($fs == 'b')
					{
						
						
						if($totalB>0){
								$totalAll=($totalA/$totalB)*100000;
								}
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($sumb[$i]>0){
								$sumx[$i]=($suma[$i]/$sumb[$i])*100000;
								}
						
						}
					}
					
					
					if($fs == 'c')
					{
						
							
						if(($totalB+$totalD)>0){
								$totalAll=(($totalA+$totalC)/($totalB+$totalD))*100;
								}
						
						
						
								for($i=1;$i<=12;$i++)
  						{
							
							if(($sumb[$i]+$sumd[$i])>0){
								$sumx[$i]=(($suma[$i]+$sumc[$i])/($sumb[$i]+$sumd[$i]))*100;
								}
						
						}
					}

						if($fs == 'd')
					{
						
							
						if($totalD>0){
								$totalAll=(($totalA+$totalB+$totalC)/$totalD)*100;
								}
						
						
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($sumd[$i]>0){
								$sumx[$i]=(($suma[$i]+$sumb[$i]+$sumc[$i])/$sumd[$i])*100;
								}
						
						}
					}
					
						if($fs == 'e')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($sumd[$i]>0){
								$sumx[$i]=(($suma[$i]+$sumb[$i])/$sumc[$i])*100;
								}
						
						}
					}
					
					
if($fs == 'f')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($sumb[$i]>0){
								$sumx[$i]=($suma[$i]/$sumb[$i])*1000;
								}
						
						}
					}

				if($fs == 'g')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($sumb[$i]>0){
								$sumx[$i]=($suma[$i]/$sumd[$i])*100;
								}
						
						}
					}

				if($fs == 'h')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($sumb[$i]>0){
								$sumx[$i]=($sumc[$i]/$sumd[$i])*100;
								}
						
						}
					}

				if($fs == 'i')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							if($sumb[$i]>0){
								$sumx[$i]=(($suma[$i]-$sumb[$i])/$sumb[$i])*100;
								}
						
						}
					}
				if($fs == 'j')
					{
						
							
						
								for($i=1;$i<=12;$i++)
  						{
							
							
								$sumx[$i]=$suma[$i];
								
						
						}
					}


				
				// จบการคำนวนสูตร sumary ด้านล่าง
				
			
				
				?>
					<tr>
					<td>รวม    </td>
					
					
					<td> <?php echo round($sumx[10],2) ;?>
					</td>
					<td>   <?php echo round($sumx[11],2) ;?>
					
					</td>
					<td> <?php echo round($sumx[12],2) ;?>
					</td>
					<td> <?php echo round($sumx[1],2) ;?>
					</td>
					<td> <?php echo round($sumx[2],2) ;?>
					</td>
					<td> <?php echo round($sumx[3],2) ;?>
					</td>
					<td> <?php echo round($sumx[4],2) ;?>
					</td>
					<td> <?php echo round($sumx[5],2) ;?>
					</td>
					<td> <?php echo round($sumx[6],2) ;?>
					</td>
					<td> <?php echo round($sumx[7],2) ;?>
					</td>
					<td> <?php echo round($sumx[8],2) ;?>
					</td>
					<td>
					<?php echo round($sumx[9],2) ;?>
				
					</td>
					<td><? echo round($totalAll,2) ;?>
			 </td>
					<?
						$sumx=array(); //clear array
						?>
				</tr>
				
			</tbody>
		</table>

	</div>
</div>

      
      <!--end table-->
      
    <!-- small success-->
     <?
			 require("r_small_success.php");
			 ?>
      <!--end small success-->
      
      
	      </div>
	 </div>
</div>




<!-- Chart code -->
     
<?
$tg=getsqldata('select kpi_target cc from kpi_head where kpi_id="'.$_GET[content].'"');
$i="";
if($x == 1){
	$lineco = "green";
	?>
	<script>
	AmCharts.addInitHandler(function(chart) {
		// check if there are graphs with autoColor: true set
		for(var i = 0; i < chart.graphs.length; i++) {
		  var graph = chart.graphs[i];
		  if (graph.autoColor !== true)
			continue;
		  var colorKey = "autoColor-"+i;
		  graph.lineColorField = colorKey;
		  graph.fillColorsField = colorKey;
		  for(var x = 0; x < chart.dataProvider.length; x++) {
			var color = chart.colors[x];
			var f1 = chart.dataProvider[x].income;
			var f2 = chart.dataProvider[x].expenses;
			if(f1 >= f2){
				//alert("yes")
				  chart.dataProvider[x][colorKey] = "lime";
			}
			else{
				//alert("no")
				chart.dataProvider[x][colorKey] = "#ff3333";
			}
			//alert(f1)
	  
			//chart.dataProvider[x][colorKey] = color;
			//chart.dataProvider[x][colorKey] = "<?php echo $i?>";
		  }
		}
	  }, ["serial"]);
</script>
<?php
}
elseif ($x == 2){
	$lineco = "red";
	?>
	<script>
	AmCharts.addInitHandler(function(chart) {
		// check if there are graphs with autoColor: true set
		for(var i = 0; i < chart.graphs.length; i++) {
		  var graph = chart.graphs[i];
		  if (graph.autoColor !== true)
			continue;
		  var colorKey = "autoColor-"+i;
		  graph.lineColorField = colorKey;
		  graph.fillColorsField = colorKey;
		  for(var x = 0; x < chart.dataProvider.length; x++) {
			var color = chart.colors[x];
			var f1 = chart.dataProvider[x].income;
			var f2 = chart.dataProvider[x].expenses;
			if(f1 < f2){
				//alert("yes")
				  chart.dataProvider[x][colorKey] = "lime";
			}
			else{
				//alert("no")
				chart.dataProvider[x][colorKey] = "#ff3333";
			}
			//alert(f1)
	  
			//chart.dataProvider[x][colorKey] = color;
			//chart.dataProvider[x][colorKey] = "<?php echo $i?>";
		  }
		}
	  }, ["serial"]);
</script>
<?php
}

?>
    
    <script>
    
   var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "addClassNames": true,
  "theme": "light",
  "autoMargins": false,
  "marginLeft":60,
  "marginRight": 8,
  "marginTop": 10,
  "marginBottom": 26,
  "balloon": {
    "adjustBorderColor": false,
    "horizontalPadding": 10,
    "verticalPadding": 8,
    "color": "#ffffff"
  },

  "dataProvider": [ {
    "province": "นครฯ",
    "income": <? echo round("$total[00062]",2) ;?>,
    "expenses": <?="$tg";?>,
	  "avg": <? echo round("$totalAll",2) ;?>
	 
  }, {
    "province": "กระบี่",
    "income": <? echo round("$total[00063]",2) ;?>,
    "expenses": <?="$tg";?>,
	  "avg": <? echo round("$totalAll",2) ;?>
  },{
    "province": "พังงา",
    "income": <? echo round("$total[00064]",2) ;?>,
    "expenses": <?="$tg";?>,
	   "avg": <? echo round("$totalAll",2) ;?>
  }, {
    "province": "ภูเก็ต",
    "income": <? echo round("$total[00065]",2) ;?>,
    "expenses": <?="$tg";?>,
	   "avg": <? echo round("$totalAll",2) ;?>
  }, {
    "province": "สฎ.",
    "income": <? echo round("$total[00066]",2) ;?>,
    "expenses": <?="$tg";?>,
	   "avg": <? echo round("$totalAll",2) ;?>
  }, {
    "province": "ระนอง",
    "income": <? echo round("$total[00067]",2) ;?>,
    "expenses": <?="$tg";?>,
	   "avg": <? echo round("$totalAll",2) ;?>
    
  }, {
    "province": "ชุมพร",
    "income": <? echo round("$total[00068]",2) ;?>,
    "expenses": <?="$tg";?>,
	   "avg": <? echo round("$totalAll",2) ;?>
},	   {
    "province": "เขต",
    "income": <? echo round("$totalAll",2) ;?>,
    "expenses": <?="$tg";?>,
	   "avg": <? echo round("$totalAll",2) ;?>
	  
    
   
  } ],
  "valueAxes": [ {
    "axisAlpha": 0,
    "position": "left"
  } ],
  "startDuration": 1,
  "graphs": [ {
    "alphaField": "alpha",
    "balloonText": "<span style='font-size:12px;'>[[title]] จ.[[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
    "fillAlphas": 1,
    "title": "ผลงาน",
    "type": "column",
    "valueField": "income",
    "dashLengthField": "dashLengthColumn",
	"autoColor": true
  }, {
    "id": "graph2",
    "balloonText": "<span style='font-size:12px;'>[[title]] :<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
    "bullet": "round",
    "lineThickness": 3,
    "bulletSize": 7,
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFFFF",
    "useLineColorForBulletBorder": true,
    "bulletBorderThickness": 3,
    "fillAlphas": 0,
    "lineAlpha": 1,
	"lineColor": "<?php echo $lineco ?>",
    "title": "เป้าหมาย",
    "valueField": "expenses",
    "dashLengthField": "dashLengthLine",
  }, {
    "id": "graph3",
    "balloonText": "<span style='font-size:12px;'>[[title]] :<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
    "bullet": "square",
    "lineThickness": 3,
    "bulletSize": 4,
    "bulletBorderAlpha": 1,
    "bulletColor": "#FFFF",
    "useLineColorForBulletBorder": true,
    "bulletBorderThickness": 3,
    "fillAlphas": 0,
    "lineAlpha": 1,
    "title": "ค่าเฉลี่ยเขต",
    "valueField": "avg",
    "dashLengthField": "dashLengthLine",
	  "lineColor":"black"
  } ],
  "categoryField": "province",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "tickLength": 0
  },
  "export": {
    "enabled": true
  }
} );
</script> 
    
    
     
     