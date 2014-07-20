<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->menu=array(
	array('label'=>'Удаление Комментарий', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Журнал Комментарий', 'url'=>array('index')),
);
?>

<h1>Просмотр Комментария #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'content',
		'status',
		'page_id',
		'created',
		'user_id',
		'guest',

	),
)); ?>
