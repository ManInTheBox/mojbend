<?php
$form = $this->beginWidget('ActiveForm', array(
            'id' => 'password-reset-form',
        ));
?>
<?php echo $form->errorSummary($passwordResetForm); ?><br />

<h3><?php echo t('Password Reset'); ?></h3>

<?php echo $form->label($passwordResetForm, 'email'); ?>
<?php echo $form->textField($passwordResetForm, 'email'); ?>

<?php
$this->widget('application.extensions.recaptcha.EReCaptcha',
        array('model' => $passwordResetForm,
            'attribute' => 'captchaCode',
            'language' => 'en_US',
            'theme' => 'white',
            'publicKey' => '6LdTbsMSAAAAAPbZUwY_1vPFfAv1YIesfrBOAJdY'))
?>

<?php echo CHtml::submitButton('Submit'); ?>
<?php $this->endWidget(); ?>