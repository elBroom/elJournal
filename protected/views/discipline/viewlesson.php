<?php $this->pageTitle = 'Баллы за занятие по дисциплине: '.$lesson->discipline->discipline->title.' за '.$lesson->date;?>
<h1><?php echo $this->pageTitle;?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'discipline-form',
    'enableAjaxValidation'=>false,
)); ?>
<table>
    <thead>
        <tr>
            <td>Фамилия</td>
            <td>Имя</td>
            <td>Отчество</td>
            <td>Не присутсвовал</td>
            <td>Оценка</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model as $i=> $student) {?>
            <tr>
                <td><?php echo $student->user->firstname; ?></td>
                <td><?php echo $student->user->surname; ?></td>
                <td><?php echo $student->user->middlename; ?></td>
                <td>
                    <?php echo $form->checkBox($student,"[$i]attendance", array('ind'=>$i)); ?>
                    <?php echo $form->error($student,"[$i]attendance"); ?>
                </td>
                <td>
                    <?php echo $form->dropDownList($student,"[$i]estimate",array(
                            '' => '',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ), array('ind'=>$i)); ?>
                    <?php echo $form->error($student,"[$i]estimate"); ?>
                </td>
            </tr>


        <?php } ?>
    </tbody>
</table>

<div class="row buttons">
    <?php echo CHtml::submitButton('Изменить'); ?>
    <?php echo CHtml::button('Отмена', array('onclick' => "window.location='/discipline/$lesson->id_discipline'")); ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script>
    jQuery(document).ready(function(){
        jQuery('input:checkbox[checked=checked]').each(function(){
            var index = jQuery(this).attr('ind');
            jQuery('select[ind='+index+']').prop('disabled', true);
            jQuery('select[ind='+index+']').val('');
        });
    });
    jQuery(document).on('change','input:checkbox',function() {
        var index = jQuery(this).attr('ind');
        if(jQuery(this).attr("checked")=="checked"){            
            jQuery('select[ind='+index+']').prop('disabled', true);
            jQuery('select[ind='+index+']').val('');
        } else{
            jQuery('select[ind='+index+']').prop('disabled', false);
        }
    });
</script>