<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('nip')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nip),array('view','id'=>$data->nip)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absen_datang')); ?>:</b>
	<?php echo CHtml::encode($data->absen_datang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>