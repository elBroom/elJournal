<?php
/* @var $this CommentController */
/* @var $model Comment */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал Комментариев</h1>


<?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'content',
		'status' => array(
			'name' => 'status',
			'value' => '($data->status == 1) ? "Опубликовано":"Скрыто"',
			'filter' => array('1' => 'Опубликовано', '0' => 'Скрыто'),
			),
		'page_id' => array(
			'name' => 'page_id',
			'value' => '$data->page->title',
			'filter' => Page::all(),
			),
		'created' => array(
			'name' => 'created',
			'value' => 'date("j.m.Y H:i", $data->created)',
			'filter' => false,
			),
		'user_id' => array(
			'name' => 'user_id',
			'value' => '$data->user->username',
			'filter' => User::all(),
			),
		'guest' => array(
			'name' => 'guest',
			'value' => '($data->guest == 1) ? "Гость":"Пользователь"',
			'filter' => array('1' => 'Гость', '0' => 'Пользователь'),
			),
		array(
			'class'=>'CButtonColumn',
			'updateButtonOptions' => array('style' => 'display: none'),
		),
	),
)); ?>
