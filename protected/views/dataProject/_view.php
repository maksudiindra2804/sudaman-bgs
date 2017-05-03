<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_project')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_project),array('view','id'=>$data->id_project)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_project')); ?>:</b>
	<?php echo CHtml::encode($data->nama_project); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_project')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_project); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rilis_project')); ?>:</b>
	<?php echo CHtml::encode($data->rilis_project); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip')); ?>:</b>
	<?php echo CHtml::encode($data->nip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no')); ?>:</b>
	<?php echo CHtml::encode($data->no); ?>
	<br />


</div>