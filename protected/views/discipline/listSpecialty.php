<?php echo CHtml::link('Добавть новую специальность', array("discipline/specialty")); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'type-lesson-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'code',
        'title',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',            
            'updateButtonUrl' => 'Yii::app()->createUrl("discipline/specialty", array("id"=>$data->id_specialty))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("discipline/deletespecialty", array("id"=>$data->id_specialty))',
        ),
    ),
)); ?>