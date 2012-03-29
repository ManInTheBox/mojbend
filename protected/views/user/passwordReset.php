<?php
$form = $this->beginWidget('ActiveForm', array(
            'id' => 'password-reset-form',
        ));
?>
<?php echo $form->errorSummary($passwordResetForm); ?><br />

<h3><?php echo t('Nova lozinka'); ?></h3>
<p>
    <?php echo t('Unesite vašu email adresu i mi ćemo vam poslati detaljna uputstva. Samo pratite uputstva u e-mail poruci.'); ?>
</p>

<table>
    <tr>
        <td><?php echo $form->labelEx($passwordResetForm, 'email'); ?></td>
        <td><?php echo $form->textField($passwordResetForm, 'email', array('size' => 65)); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($passwordResetForm, 'captchaCode'); ?></td>
        <td>
            <?php
            $this->widget('ext.recaptcha.EReCaptcha',
                    array('model' => $passwordResetForm,
                        'attribute' => 'captchaCode',
                        'language' => 'en_US',
                        'theme' => 'white',
                        'publicKey' => '6Lfnfc8SAAAAAEd3GSzfwYeF99Fyy1ACiAwQPCi0'))
            ?>
        </td>
    </tr>
    <tr>
        <td class="button"><?php echo CHtml::submitButton(t('Resetuj lozinku')); ?></td>
    </tr>
</table>
<?php $this->endWidget(); ?>