<?php
/* @var $this DisciplineController */
/* @var $model Discipline */
/* @var $form CActiveForm */
?>

<div class="form" id="updateStudent">
<!-- <form action="" method="POST"> -->
    <div class="addStusent">
        <label for="outDisp">Проходят обучение</label>
        <select name="user[]" id="outDisp" multiple>
            <?php 
            foreach ($outUsers as $user) {?>
                <option value="<?=$user['id_user']?>">
                    <?=$user['firstname']?> 
                    <?=$user['surname']?> 
                    <?=$user['middlename']?>
                </option>
           <?php } ?>
    </select>
    </div>
    <button id="addUser"> >>> </button>
    <button id="delUser"> <<< </button>

    <div class="addStusent">
        <label for="inDisp">Кандидаты на обучение</label>
        <select name="user[]" id="inDisp" multiple>
            <?php 
            foreach ($inUsers as $user) {?>
                <option value="<?=$user['id_user']?>">
                    <?=$user['firstname']?> 
                    <?=$user['surname']?> 
                    <?=$user['middlename']?>
                </option>
           <?php } ?>
        </select>
    </div>
    <?php echo CHtml::button('Отмена', array('onclick' => "window.location='/discipline/list'")); ?>
<!-- </form> -->

</div><!-- form -->

<script>
    $('#addUser').click(function() {
        console.log('add');
        $.ajax({
            type: 'POST',
            url: location,
            data:{  user: $('#outDisp').val(),
                    addUser: true},
            success: function(data){
                $('#updateStudent').html(data);
            }
        });
        return false;
    });
    $('#delUser').click(function() {
        if(!confirm('Вы уверены, что хотите удалить данного студента из списка?')) return false;
        $.ajax({
            type: 'POST',
            url: location,
            data:{  user: $('#inDisp').val(),
                    delUser: true},
            success: function(data){
                $('#updateStudent').html(data);
            }
        });
        return false;
    });
</script>
