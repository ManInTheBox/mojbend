<h1>Exception Generator</h1>
<p>This generator helps you to quickly generate the skeleton code for a new exception class.</p>
<?php $form=$this->beginWidget('CCodeForm', array('model'=>$model)); ?>
<?php $this->widget('system.web.widgets.CTabView', array('tabs'=>array(
    'tab1'=>array(
	    'title'=>'Component', 'view'=>'__class',
        'data'=>array('model'=>$model,'form'=>$form),
	 ),
    'tab2'=>array('title'=>'Information', 'view'=>'__infos')
)));
?>
<?php $this->endWidget(); ?>
