<?php echo CHtml::link('Добавть новый тип урока', array("discipline/typelesson")); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'type-lesson-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id_typeLesson',
        'title',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',            
            'updateButtonUrl' => 'Yii::app()->createUrl("discipline/typelesson", array("id"=>$data->id_typeLesson))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("discipline/deletetypelesson", array("id"=>$data->id_typeLesson))',
        ),
    ),
)); ?>