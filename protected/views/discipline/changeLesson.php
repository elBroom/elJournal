<h1><?php echo $this->pageTitle;?></h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'lesson-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_discipline'); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'date',
                        'language'=>'ru',
                        'htmlOptions' => array('style' => 'width: 80px;'),
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'changeYear' => true),)); ?>

        <?php echo $form->error($model,'date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model,'type', TypeLesson::getAll(), array('empty'=>'Выбирите тип урока')); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Изменить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->