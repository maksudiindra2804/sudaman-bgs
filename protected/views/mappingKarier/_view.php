<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_mapping')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_mapping),array('view','id'=>$data->id_mapping)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mapping')); ?>:</b>
	<?php echo CHtml::encode($data->mapping); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('child_mapping')); ?>:</b>
	<?php echo CHtml::encode($data->child_mapping); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_data')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_data); ?>
	<br />


</div>