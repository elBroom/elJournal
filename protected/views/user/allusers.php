<?php $this->pageTitle = 'Список пользователей'?>
<h1><?php echo $this->pageTitle;?></h1>

<?php echo CHtml::link('Добавть нового пользователя', array("user/create")); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$users->search(),
    'filter'=>$users,
    'emptyText' => 'В базе нет пользователей',
    'columns'=>array(
        'login',
        'email',
        array(
        	'name' => 'role',
            'filter' => false,
        ),
        array(
            'class'=>'CButtonColumn',
            'template' => '{update}{delete}', 
            'updateButtonUrl' => 'Yii::app()->createUrl("user/updaterole", array("id"=>$data->id_user))', 
        ),
    ),
)); ?>