<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_karier')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_karier),array('view','id'=>$data->id_karier)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_talent')); ?>:</b>
	<?php echo CHtml::encode($data->id_talent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip')); ?>:</b>
	<?php echo CHtml::encode($data->nip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jabatan')); ?>:</b>
	<?php echo CHtml::encode($data->id_jabatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_lengkap')); ?>:</b>
	<?php echo CHtml::encode($data->nama_lengkap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_data')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_pelatihan')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_pelatihan); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deskripsi')); ?>:</b>
	<?php echo CHtml::encode($data->deskripsi); ?>
	<br />

	*/ ?>

</div>