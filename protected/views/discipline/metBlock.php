<?php
/* @var $this MetBlockController */
/* @var $model MetBlock */
/* @var $form CActiveForm */
?>
<h1><?php echo $this->pageTitle;?></h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'met-block-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'index'); ?>
        <?php echo $form->textField($model,'index',array('size'=>8,'maxlength'=>8)); ?>
        <?php echo $form->error($model,'index'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'id_speciality'); ?>
        <?php echo $form->dropDownList($model,'id_speciality', Specialty::getAll(), array('empty'=>'Выберите пункт')); ?>
        <?php echo $form->error($model,'id_speciality'); ?>
    </div>
    
    <div id="parent">        
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Сохранить' : 'Изменить'); ?>
        <?php echo CHtml::button('Отмена', array('onclick' => "window.location='/discipline/addcurriculum'")); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script>
    $('#MetBlock_id_speciality').change(function() {
        $.ajax({
            type: 'POST',
            url: location,
            data:{  id_speciality: $(this).val()},
            success: function(data){
                $('#parent').html(data);
            }
        });
    });
</script>