<?php $this->pageTitle = 'Восстонавление пароля'?>
<h1><?php echo $this->pageTitle;?></h1>

<?php if(Yii::app()->user->hasFlash('newPassword')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('newPassword'); ?>
</div>

<?php else: ?>
<div class="form">
<form action="" method="post">
	<div class="row">
		<label for="LoginForm_email">Введите свой email</label>
		<input name="Email" id="email" type="text" />
		<div class="errorMessage" <?php if(!$error){?>style="display:none"<?php }?>>Такой email на сайте не зарегестрирован.</div>
	</div>
	<div class="row buttons">
		<input type="submit" name="yt0" value="Потвердить" />	
		<?php echo CHtml::button('Отмена', array('onclick' => "window.location='/site/login'")); ?>
	</div>
</form>
</div><!-- form -->
<?php endif; ?>