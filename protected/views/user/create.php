<?php $this->pageTitle = 'Создание нового пользователя'?>
<h1><?php echo $this->pageTitle;?></h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->errorSummary($student); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'login'); ?>
        <?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'login'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'firstname'); ?>
        <?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'firstname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'surname'); ?>
        <?php echo $form->textField($model,'surname',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'surname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'middlename'); ?>
        <?php echo $form->textField($model,'middlename',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'middlename'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'setRole'); ?>
        <?php echo $form->dropDownList($model,'setRole', Role::getAll()); ?>
        <?php echo $form->error($model,'setRole'); ?>
    </div>

    <div id="showFormStudent">
        <div class="row">
        <?php echo $form->labelEx($student,'id_specialty'); ?>
        <?php echo $form->dropDownList($student,'id_specialty', Specialty::getAll(), array('empty'=>'Выберите специальность')); ?>
        <?php echo $form->error($student,'id_specialty'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($student,'year_income'); ?>
            <?php echo $form->textField($student,'year_income',array('size'=>4,'maxlength'=>4)); ?>
            <?php echo $form->error($student,'year_income'); ?>
        </div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Создать'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script>
    $(document).ready(function(){
        toggleFormStudent();
    });
    $('#User_setRole').change(function(){
        toggleFormStudent();
    });
    function toggleFormStudent(){
        if($('#User_setRole').val() == 3)
           $('#showFormStudent').show();
        else
            $('#showFormStudent').hide();
    }
</script>