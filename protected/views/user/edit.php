<?php echo $this->renderFlash(); ?>

<div class="form">

<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary(array($user, $person)); ?>

	<div class="row">
		<?php echo $form->labelEx($person,'first_name'); ?>
		<?php echo $form->textField($person,'first_name'); ?>
		<?php echo $form->error($person,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'last_name'); ?>
		<?php echo $form->textField($person,'last_name'); ?>
		<?php echo $form->error($person,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'birth_date'); ?>
		<?php echo $form->textField($person,'birth_date'); ?>
		<?php echo $form->error($person,'birth_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'gender'); ?>
		<?php echo $form->dropDownList($person, 'gender', $person->getGenderOptions()); ?>
		<?php echo $form->error($person,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'email'); ?>
		<?php echo $form->textField($user,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($user,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'password'); ?>
		<?php echo $form->passwordField($user,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($user,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user, 'is_artist'); ?>
                <?php echo $form->checkBox($user, 'is_artist'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($user->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>