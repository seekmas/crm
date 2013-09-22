<?php 
$ci = & get_instance();
$total = array('airfare' => 0 , 'hotels' => 0 ,'meals' => 0 ,'transport' => 0 ,'misc' => 0 , );
$calc = array('airfare' , 'hotels' , 'meals' , 'transport' , 'misc');
?>
<div class="alert alert-info"><i class="icon-list"></i> 项目报销成本列表</div>

<table class="table table-bordered table-condensed">

	<tr>
		<td>Rec Date</td>
		<td>Airfare</td>
		<td>Hotels</td>
		<td>Meals/Ent</td>
		<td>Transport</td>
		<td>Misc</td>
		<td>Type</td>
		<td>Explanation</td>
		<td>User Name</td>
	</tr>
	
	<?php foreach ($item as $r) :?>

		<?php
			foreach ($r as $key => $value) {
				if( in_array( $key , $calc))
					$total[$key]+=$value;
			}
		?>
	<tr>
		<td><?php echo date( 'Y-m-d' , strtotime( $r['RecDate']));?></td>
		<td><?php echo $r['airfare'];?></td>
		<td><?php echo $r['hotels'];?></td>
		<td><?php echo $r['meals'];?></td>
		<td><?php echo $r['transport'];?></td>
		<td><?php echo $r['misc'];?></td>
		<td><?php echo $r['type'];?></td>
		<td><?php echo $r['explanation'];?></td>
		<td><?php echo $ci->common->get_username_by_id( $r['userid']);?></td>
		<td><a href="<?php echo site_url('reimburse/edit/'.$r['epid']);?>">View</a></td>
	</tr>
	<?php endforeach ?>

	<tr>
		<td>Total : <?php echo array_sum( $total);?></td>
		<td><?php echo $total['airfare'];?></td>
		<td><?php echo $total['hotels'];?></td>
		<td><?php echo $total['meals'];?></td>
		<td><?php echo $total['transport'];?></td>
		<td><?php echo $total['misc'];?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>

</table>