 <div class="card">
	<div class="card-header" data-background-color="purple">
		<h4 class="title thsarabunnew">Small Success</h4>
		<p class="category">
		<!--Here is a subtitle for this table-->
		
		<!--End subtitle for this table-->
		
		</p>
	</div>
	<div class="card-content table-responsive table-full-width">
		<table class="table">
		<tr>
			<th>จังหวัด</th>
			<th>ไตรมาส 1</th>
			<th>ไตรมาส 2</th>
			<th>ไตรมาส 3</th>
			<th>ไตรมาส 4</th>
		</tr>	
			<?
			$s= "select name from hospcode";
			$q=mysql_query($s);
			while($r=mysql_fetch_array($q)){
			?>
		<tr>
			<td><?="$r[name]";?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>		
			<?
			}
			?>
			
		</table>
	 </div>
	 
</div>