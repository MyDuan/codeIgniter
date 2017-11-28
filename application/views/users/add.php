<?php echo validation_errors(); ?>

<!--form-->
<?php echo form_open('users/add'); ?>

    <?php echo form_label('名前：', 'name');?>
    <!--text-->
    <?php echo form_input('name');?>
    <?php echo br(1)?>

    <?php echo form_label('性別：', 'gender');?>
    <!--radio-->
    男<?php echo form_radio('gender', '0', TRUE);?>
    女<?php echo form_radio('gender', '1');?>
    <?php echo br(1)?>
    
    <?php echo form_label('身分：', 'identity');?>
    <!--select-->
    <?php echo form_dropdown('identity', array(
        '0'         => '学生',
        '1'           => '教師',
        '2'         => '係員',
        '3'        => '訪問者',
    ));?>
    <?php echo br(1)?>
    
    <?php echo form_submit('submit', '新規作成');?>
</form>

