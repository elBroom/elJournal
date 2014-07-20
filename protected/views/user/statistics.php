<?php $this->pageTitle = 'Статистика'?>
<h1><?php echo $this->pageTitle;?></h1>
<?php if($model){?>
	<?php if(count($model) > 1){?>
		Последние посещения:<br>
	<?php }else{?>
		Последние посещение:<br>
	<?php } ?>
	<?php foreach ($model as $visit) {
		echo date('d-m-Y h:i:s',$visit->date)?><br>
		
<?php }} ?>
