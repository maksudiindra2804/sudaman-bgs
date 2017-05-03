<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('nik')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nik),array('view','id'=>$data->nik)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absen_time')); ?>:</b>
	<?php echo CHtml::encode($data->absen_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>