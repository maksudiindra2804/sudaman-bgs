<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('riwayat')); ?>:</b>
	<?php echo CHtml::encode($data->riwayat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun1')); ?>:</b>
	<?php echo CHtml::encode($data->tahun1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun2')); ?>:</b>
	<?php echo CHtml::encode($data->tahun2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip')); ?>:</b>
	<?php echo CHtml::encode($data->nip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no')); ?>:</b>
	<?php echo CHtml::encode($data->no); ?>
	<br />


</div>