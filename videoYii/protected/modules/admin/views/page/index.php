<?php
/* @var $this PageController */
/* @var $model Page */
$this->menu=array(
	array('label'=>'Создание страницы', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#page-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал Страниц</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'content',
		'created' => array(
			'name' => 'created',
			'value' => 'date("j.m.Y H:i", $data->created)',
			'filter' => false,
			),
		'status' => array(
			'name' => 'status',
			'value' => '($data->status == 1) ? "Опубликовано":"Скрыто"',
			'filter' => array('1' => 'Опубликовано', '0' => 'Скрыто'),
			),
		'category_id' => array(
			'name' => 'category_id',
			'value' => '$data->category->title',
			'filter' => Category::all(),
			),
		array(
			'class'=>'CButtonColumn',
			'viewButtonOptions' => array('style' => 'display: none'),
		),
	),
)); ?>
