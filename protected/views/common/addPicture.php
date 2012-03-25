<?php $this->renderFlash(); ?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id' => 'add-picture-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

<?php echo $form->errorSummary($picture); ?>

<table>
    <tr>
        <td><?php echo $form->labelEx($picture, 'instance'); ?></td>
        <td><?php echo $form->fileField($picture, 'instance', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($picture, 'title'); ?></td>
        <td><?php echo $form->textField($picture, 'title', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($picture, 'location'); ?></td>
        <td><?php echo $form->textField($picture, 'location', array('style' => 'width: 420px;')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($picture, 'date'); ?></td>
        <td><?php echo $form->textField($picture, 'date', array('style' => 'width: 420px;', 'readonly' => 'readonly')); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($picture, 'description'); ?></td>
        <td><?php echo $form->textArea($picture, 'description', array('style' => 'width: 420px; height: 100px;')); ?></td>
    </tr>
    <tr>
        <td class="button"><?php echo Html::submitButton(t('Pošalji')); ?></td>
        <td class="button"><?php echo l(Html::submitButton(t('Odustani')), $backUrl); ?></td>
    </tr>
</table>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $('#Picture_date').datepicker({
        dateFormat: 'dd.mm.yy',
        changeYear: true,
        yearRange: '1920:<?php echo date('Y'); ?>',
        monthNames: [
            'Januar', 'Februar', 'Mart', 'April',
            'Maj', 'Jun', 'Jul', 'Avgust',
            'Septembar', 'Oktobar', 'Novembar', 'Decembar'
        ],
        dayNamesMin: [
            'Pon', 'Uto', 'Sre',
            'Čet', 'Pet', 'Sub', 'Ned'
        ],
        defaultDate: '01.01.2008'
    });
</script>