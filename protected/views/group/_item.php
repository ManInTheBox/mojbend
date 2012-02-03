<div class="view">

	<?php echo l(e($data->name), array('/group/view', 'gid'=>$data->id)); ?><br />
	<?php echo e($data->description); ?><br />
	<?php echo e($data->founded_date); ?><br />
        <?php echo l(t('Become a fan'), array('/group/newFan', 'gid' => $data->id)); ?><br />

</div>