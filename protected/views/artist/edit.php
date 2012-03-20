<?php $this->renderFlash(); ?>

<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'group-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($artist); ?>

<table>
    <tr>
        <td><?php echo $form->labelEx($artist, 'list_artist_type_id'); ?></td>
        <td><?php echo $form->dropDownList($artist, 'list_artist_type_id'); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($artist, 'description'); ?></td>
        <td><?php echo $form->textArea($artist, 'description'); ?></td>
    </tr>
    <tr>
        <td class="button"><?php echo Html::submitButton(t('Sačuvaj izmene')); ?></td>
    </tr>
</table>

<?php $this->endWidget(); ?>