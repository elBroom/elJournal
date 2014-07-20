<?php $this->pageTitle = 'Список дисциплин';?>
<h1><?php echo $this->pageTitle;?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'estimate-grid',    
    'dataProvider'=>$model->search($criteria),
    'emptyText' => 'Вы не изучаете не один предмет',
    'columns'=>array(
        array(
        	'name' => 'discipline.discipline.title',
        	'type'=>'raw',
        	'value' => '$data->discipline->discipline->title',
    	),
        array(
            'name' => 'ФИО преподавателя',
            'type'=>'raw',
            'value' => '$data->user->surname." ".$data->user->firstname." ".$data->user->middlename',
        ),      
    ),
)); ?>