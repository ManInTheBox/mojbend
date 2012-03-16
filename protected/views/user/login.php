<?php $this->renderFlash(); ?>

<!--<div class="form">-->
    <?php
    $form = $this->beginWidget('ActiveForm', array(
                'id' => 'login-form',
            ));
    ?>

    <?php echo $form->errorSummary($loginForm); ?>

    <table>
        <tr>
            <td><?php echo $form->labelEx($loginForm, 'email'); ?></td>
            <td><?php echo $form->textField($loginForm, 'email', array('size' => 55)); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($loginForm, 'password'); ?></td>
            <td><?php echo $form->passwordField($loginForm, 'password', array('size' => 55)); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->label($loginForm, 'rememberMe'); ?></td>
            <td><?php echo $form->checkBox($loginForm, 'rememberMe'); ?></td>
        </tr>

        <tr>
            <td class="button">
                <?php echo CHtml::submitButton('Uloguj se'); ?>
            </td>
        </tr>

    </table>
        <?php $this->endWidget(); ?>
<!--</div> form -->