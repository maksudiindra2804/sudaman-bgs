<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_auth')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_auth),array('view','id'=>$data->id_auth)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_role')); ?>:</b>
	<?php echo CHtml::encode($data->id_role); ?>
	<br />


</div>