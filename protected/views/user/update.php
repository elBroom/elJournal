<?php $this->pageTitle = 'Изменение роли пользователя ' . $user->login?>
<h1><?php echo $this->pageTitle;?></h1>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-update-form',
    'enableAjaxValidation'=>false,
)); ?>
	<?php foreach($roles as $role){?>
	<div class="row">
	    <input 
		<?php 
		foreach($user->journalRoles as $one){
			if($role->name == $one->name){ ?>
				checked
			<?php }} ?>
	    name="Role[<?=$role->id_role;?>]" id="Role_<?=$role->id_role;?>" value="1" type="checkbox">
	    <label for="Role_<?=$role->id_role;?>" style="display:inline"><?=$role->name;?></label>	    
	</div>
	<?php } ?>
	
	<?php if($student){?>
	<div id="showFormStudent">
		<?php echo $form->errorSummary($student); ?>
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
	<?php } ?>

	<div class="row buttons">
        <?php echo CHtml::submitButton('Изменить'); ?>
        <?php echo CHtml::button('Отмена', array('onclick' => "window.location='/user/allusers'")); ?>
    </div>
	<?php $this->endWidget(); ?>
</div>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script>
    $(document).ready(function(){
        toggleFormStudent();
    });
    $('#Role_3').change(function(){
        toggleFormStudent();
    });
    function toggleFormStudent(){
        if($('#Role_3').attr("checked")=="checked")
           $('#showFormStudent').show();
        else
            $('#showFormStudent').hide();
    }
</script>