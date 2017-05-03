<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_talent')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_talent),array('view','id'=>$data->id_talent)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jabatan')); ?>:</b>
	<?php echo CHtml::encode($data->id_jabatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip')); ?>:</b>
	<?php echo CHtml::encode($data->nip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_lengkap')); ?>:</b>
	<?php echo CHtml::encode($data->nama_lengkap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pelatihan')); ?>:</b>
	<?php echo CHtml::encode($data->id_pelatihan); ?>
	<br />


</div>