<?php echo validation_errors(); ?>

<!--hidden-->
<?php $hidden = array('id' => $duanuser['id']);?>

<!--form-->
<?php echo form_open('users/edit/', '', $hidden); ?>
    
    <?php echo form_label('名前：', 'name');?>
    <!--text-->
    <?php echo form_input('name', $duanuser['name']);?>
    <?php echo br(1)?>

    <?php echo form_label('性別：', 'gender');?>
    <!--radio-->
    <?php if ($duanuser['gender'] == '0'): ?>
        男<?php echo form_radio('gender', '0', TRUE);?>
        女<?php echo form_radio('gender', '1');?>
    <?php elseif ($duanuser['gender'] == '1'): ?>
        男<?php echo form_radio('gender', '0');?>
        女<?php echo form_radio('gender', '1', TRUE);?>
    <?php endif;?>
    <?php echo br(1)?>
    
    <?php echo form_label('身分：', 'identity');?>
    <!--select-->
    <?php echo form_dropdown('identity', array(
        '0'         => '学生',
        '1'           => '教師',
        '2'         => '係員',
        '3'        => '訪問者',
    ), $duanuser['identity']);?>
    <?php echo br(1)?>
    
    <?php echo form_submit('submit', '編集');?>
    
</form>

