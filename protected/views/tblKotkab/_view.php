<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_kotkab')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_kotkab),array('view','id'=>$data->id_kotkab)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provinsi_id')); ?>:</b>
	<?php echo CHtml::encode($data->provinsi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_kotkab')); ?>:</b>
	<?php echo CHtml::encode($data->nama_kotkab); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />


</div>