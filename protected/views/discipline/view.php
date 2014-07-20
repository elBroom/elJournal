<?php $this->pageTitle = 'Журнал проведения занятий по дисциплине: '.$discipline->discipline->title;?>
<h1><?php echo $this->pageTitle;?></h1>

<?php echo CHtml::link('Добавть новое занятий', array("discipline/changelesson", "idDis"=>$discipline->id_notice)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'lesson-grid',
    'dataProvider'=>$model->search($criteria),
    'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'emptyText' => 'По выбранной дисциплине не проводилось ни одно занятие',
    'columns'=>array(
        'date' => array(
            'name' => 'date',
            'value' => '$data->date',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'id' => 'date',
                    'attribute' => 'date',
                    'language' => 'ru',
                    'htmlOptions' => array('style' => 'width: 80px;'),
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'changeYear' => true),
                    
                ), true),
        ),
        'type' => array(
            'name' => 'type',
            'value' => '$data->typeLesson->title',
            'filter' => TypeLesson::getAll(),
        ),
        array(
            'name' => 'counStudents',
            'value' => '$data->counStudents . " студет(а)"',
            'filter' => false,
        ),
        array(
            'class'=>'CButtonColumn',
            'template' => '{update}{view}{delete}',
            'updateButtonUrl' => 'Yii::app()->createUrl("discipline/changelesson", array("idDis"=>$data->discipline->id_notice, "idLess"=>$data->id_lesson))',
            'viewButtonUrl' => 'Yii::app()->createUrl("discipline/viewlesson", array("id"=>$data->id_lesson))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("discipline/deletelesson", array("id"=>$data->id_lesson))',
        ),
    ),
)); ?>
<script>
    function reinstallDatePicker() {
        jQuery('#date').datepicker({ dateFormat: "yy-mm-dd"});
        $.datepicker.setDefaults($.datepicker.regional['ru']);
    }
</script>