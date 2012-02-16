<?php
$form = $this->beginWidget('ActiveForm', array(
            'id' => 'lost-password-form',
        ));
?>

<?php echo $form->errorSummary($lostPasswordForm); ?><br/>


<h3><?php echo t('Password Reset'); ?></h3>

<?php echo $form->label($lostPasswordForm, 'new_password'); ?>
<?php echo $form->passwordField($lostPasswordForm, 'new_password'); ?>

<?php echo $form->label($lostPasswordForm, 'new_password_repeat'); ?>
<?php echo $form->passwordField($lostPasswordForm, 'new_password_repeat'); ?>

<?php echo $form->hiddenField($lostPasswordForm, 'user_id'); ?>
<?php echo $form->hiddenField($lostPasswordForm, 'token'); ?>

<?php echo CHtml::submitButton('Send'); ?>
<?php $this->endWidget(); ?>