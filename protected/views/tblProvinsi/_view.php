<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('provinsi_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->provinsi_id),array('view','id'=>$data->provinsi_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_provinsi')); ?>:</b>
	<?php echo CHtml::encode($data->nama_provinsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />


</div>