<h1><?php echo $this->pageTitle;?></h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'discipline-to-teacher-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'specialty'); ?>
        <?php echo $form->dropDownList($specialty,'id_specialty', Specialty::getAll(), array('empty' => 'Выбирите специальность')); ?>
    </div>

    <div id="forSpecialty">
    <?php if(!$model->isNewRecord){
        $this->renderPartial('_forSpecialty', array('model'=>$model, 'form'=>$form, 'groups'=>$groups, 'disciplins'=>$disciplins));
    } ?>
    </div>

    <div class="row id_discipline">
        <?php echo $form->labelEx($model,'sem'); ?>
        <?php echo $form->dropDownList($model,'sem', DisciplineToTeacher::getAllSem(), array('empty' => 'Выбирите семестр')); ?>
        <?php echo $form->error($model,'sem'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'id_teacher'); ?>
        <?php echo $form->dropDownList($model,'id_teacher', User::getAllTeacher(), array('empty' => 'Выбирите преподователя')); ?>
        <?php echo $form->error($model,'id_teacher'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Назначить' : 'Изменить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script>
    $('#Specialty_id_specialty').change(function() {
        if($(this).val() > 0){
            $.ajax({
                type: 'POST',
                url: location,
                data:{  id_specialty: $(this).val()},
                success: function(data){
                    $('#forSpecialty').html(data);
                }
            });
        } else
            $('#forSpecialty').html('');        
    });
</script>