<?php //var_dump($arrCurriculum); die;
foreach ($arrCurriculum as $value) {	?>
<tr <?php if(!$value['isBlock']) echo 'style="color: black;"';?>>
	<td><?=$value["index"];?></td>
	<?php if($value['isBlock']){ ?>
		<td><?=CHtml::link($value["title"], array("discipline/Create", 'id'=>$value["id"]));?></td>
	<?php } else {?>
		<td><?=CHtml::link($value["title"], array("discipline/Metblock", 'id'=>$value["id"]));?></td>
	<?php } ?>
	<td><?=$value["exam"];?></td>
	<td><?=$value["dif_zachet"];?></td>
	<td><?=$value["zachet"];?></td>
	<td><?=$value["max"]?></td>
	<td><?=$value["sam_rab"];?></td>
	<td><?=$value["all"]?></td>
	<td><?=$value["lection"];?></td>
	<td><?=$value["pr_rab"];?></td>
	<td><?=$value["cours_rab"];?></td>
	<td><?=$value["ucheb_pr"];?></td>
	<td><?=$value["proizv_pr"];?></td>
	<td><?=$value["sem1"];?></td>
	<td><?=$value["sem2"];?></td>
	<td><?=$value["sem3"];?></td>
	<td><?=$value["sem4"];?></td>
	<td><?=$value["sem5"];?></td>
	<td><?=$value["sem6"];?></td>
	<td><?=$value["sem7"];?></td>
	<td><?=$value["sem8"];?></td>
	<td><?=$value["double"];?></td>
</tr>
<?php 
	if(isset($value["child"]))
		$this->renderPartial('_itemCurriculum', array('arrCurriculum' => $value["child"]));
} ?>