<?php
$form = $this->beginWidget('ActiveForm', array(
            'id' => 'password-reset-form',
        ));
?>
<?php echo $form->errorSummary($passwordResetForm); ?><br />

<h3><?php echo t('Nova lozinka'); ?></h3>
<p>
    <?php echo t('Unesite vasu email adresu i mi cemo vam poslati dalja uputstva.'); ?>
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
                        'publicKey' => '6LdTbsMSAAAAAPbZUwY_1vPFfAv1YIesfrBOAJdY'))
            ?>
        </td>
    </tr>
    <tr>
        <td class="button"><?php echo CHtml::submitButton(t('Resetuj lozinku')); ?></td>
    </tr>
</table>
<?php $this->endWidget(); ?>