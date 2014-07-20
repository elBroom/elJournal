<?php $this->pageTitle = 'Список групп'?>
<h1><?php echo $this->pageTitle;?></h1>

<?php echo CHtml::link('Добавть новую группу', array("user/changegroup")); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$groups->search(),
    'filter'=>$groups,
    'emptyText' => 'В базе нет групп',
    'columns'=>array(
        'title',
        array(
            'name' => 'id_speciality',
            'value' => '$data->idSpecialty->title',
            'filter' => Specialty::getAll(),
            ),
        'year_income',
        array(
            'class'=>'CButtonColumn',
            'template' => '{update}{delete}', 
            'updateButtonUrl' => 'Yii::app()->createUrl("user/changegroup", array("id"=>$data->id_group))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("user/deletegroup", array("id"=>$data->id_group))', 
        ),
    ),
)); ?>