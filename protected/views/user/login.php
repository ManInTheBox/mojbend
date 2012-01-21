<?php $this->renderFlash(); ?>

<div class="form">
<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'login-form',
)); ?>

	<div class="row">
		<?php echo $form->labelEx($loginForm,'email'); ?>
		<?php echo $form->textField($loginForm,'email'); ?>
		<?php echo $form->error($loginForm,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($loginForm,'password'); ?>
		<?php echo $form->passwordField($loginForm,'password'); ?>
		<?php echo $form->error($loginForm,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($loginForm,'rememberMe'); ?>
		<?php echo $form->label($loginForm,'rememberMe'); ?>
		<?php echo $form->error($loginForm,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->