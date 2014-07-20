<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="mainmenu">
	<?php $this->widget('zii.widgets.CMenu',array(
		'items'=>array(
			array('label'=>'Статистика', 'url'=>array('/user/statistics')),
			array('label'=>'Изменить профиль', 'url'=>array('/user/updateme')),
			array('label'=>'Изменить пароль', 'url'=>array('/user/changepassword')),
			//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
		),
	)); ?>
</div><!-- mainmenu -->
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		if(Yii::app()->user->checkAccess('admin')){
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Работа с пользователями',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
					array('label'=>'Список групп', 'url'=>array('/user/allgroups')),
					array('label'=>'Список пользователей', 'url'=>array('/user/allusers')),
					),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		}
		if(Yii::app()->user->checkAccess('metodist')){
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Работа с учебным планом',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
					array('label'=>'Список специальностей', 'url'=>array('/discipline/listspecialty')),
					array('label'=>'Список "Тип урока"', 'url'=>array('/discipline/listtypelesson')),
					array('label'=>'Учебный план', 'url'=>array('/discipline/curriculum')),
					array('label'=>'Добавить учебный план', 'url'=>array('/discipline/addcurriculum')),					
					array('label'=>'Дисциплины', 'url'=>array('/discipline/listdiscip')),					
					),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		}
		if(Yii::app()->user->checkAccess('teacher')){
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Работа с журналом',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
					array('label'=>'Список дисциплин', 'url'=>array('/discipline/list')),
					array('label'=>'Отчет по дисциплинам', 'url'=>array('/discipline/showprogress')),

					),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		}
		if(Yii::app()->user->checkAccess('student')){
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Отчеты по дисциплинам',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
					array('label'=>'Список дисциплин', 'url'=>array('/discipline/studentdiscipline')),
					array('label'=>'Отчет по дисциплинам', 'url'=>array('/discipline/studentprogress')),
					),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		}
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>