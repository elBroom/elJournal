<?php $this->pageTitle = 'Список дисциплин';?>
<h1><?php echo $this->pageTitle;?></h1>

<?php echo CHtml::link('Добавть новую дисциплину', array("discipline/create")); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'discipline-grid',
    'dataProvider'=>$model->search($criteria),
    'filter'=>$model,
    'emptyText' => 'У Вас нет дисциплин',
    'columns'=>array(
        'id_group'=>array(
            'name' => 'group.title',
            'value' => '$data->group->title',
            //'filter' => Group::getAll(),
        ),
        array(
            'name' => 'discipline.title',
            'value' => '$data->discipline->title',
            //'filter' => $model->allForTeacher(),
        ),
        array(
            'name' => 'counStudents',
            'filter' => false,
        ),
        array(
            'name' => 'sem',
            'filter' => false,
        ),
        array(
            'class'=>'CButtonColumn',
            'template' => '{view}{update}'
        ),
    ),
)); ?>