<?php
/* @var $this UserController */
/* @var $model User */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал Пользователей</h1>


<?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?=CHtml::form();?>
<?=CHtml::submitButton('Разбанить', array('name' => 'noban'));?>
<?=CHtml::submitButton('Забанить', array('name' => 'ban'));?></br>
<?=CHtml::submitButton('Администратор', array('name' => 'admin'));?>
<?=CHtml::submitButton('Пользователь', array('name' => 'user'));?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'selectableRows' => 2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('class'=> 'CCheckBoxColumn', 'id' => 'user_id'),
		'username',
		'created' => array(
			'name' => 'created',
			'value' => 'date("j.m.Y H:i", $data->created)',
			'filter' => false,
			),
		'ban' => array(
			'name' => 'ban',
			'value' => '($data->ban == 1) ? "Забанен":"Не забанен"',
			'filter' => array('1' => 'Забанен', '0' => 'Не забанен'),
			),
		'role' => array(
			'name' => 'role',
			'value' => '($data->role == 1) ? "Администратор":"Пользователь"',
			'filter' => array('1' => 'Администратор', '0' => 'Пользователь'),
			),
		'email',
		array(
			'class'=>'CButtonColumn',
			'viewButtonOptions' => array('style' => 'display: none'),
		),
	),
)); ?>
<?=CHtml::endform();?>
