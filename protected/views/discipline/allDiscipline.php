<?php $this->pageTitle = 'Список дисциплин'?>
<h1><?php echo $this->pageTitle;?></h1>

<?php echo CHtml::link('Назначить дисциплину для преподавателя', array("discipline/changediscip")); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$discipline->search(),
    'filter'=>$discipline,
    'emptyText' => 'В базе нет дисциплин',
    'columns'=>array(
        'id_discipline' => array(
            'name' => 'id_discipline',
            'value' => '$data->discipline->title',
            //'filter' =>
        ),
        'id_group' => array(
            'name' => 'id_group',
            'value' => '$data->group->title',
            'filter' => Group::getAll(),
        ),
        'id_teacher' => array(
            'name' => 'id_teacher',
            'value' => '$data->teacher->surname." ".$data->teacher->firstname." ".$data->teacher->middlename',
            'filter' => User::getAllTeacher(),
        ),
        'sem' => array(
            'name' => 'sem',
            'value' => '$data->sem',
            'filter' => DisciplineToTeacher::getAllSem(),
        ),
        array(
            'class'=>'CButtonColumn',
            'template' => '{update}{delete}',
            'updateButtonUrl' => 'Yii::app()->createUrl("discipline/changediscip", array("id"=>$data->id_notice))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("discipline/deletediscip", array("id"=>$data->id_notice))', 
        ),
    ),
)); ?>