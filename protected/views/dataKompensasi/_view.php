<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id_kompensasi')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_kompensasi),array('view','id'=>$data->id_kompensasi)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nip')); ?>:</b>
	<?php echo CHtml::encode($data->nip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_lengkap')); ?>:</b>
	<?php echo CHtml::encode($data->nama_lengkap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jabatan')); ?>:</b>
	<?php echo CHtml::encode($data->id_jabatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_talent')); ?>:</b>
	<?php echo CHtml::encode($data->id_talent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_karier')); ?>:</b>
	<?php echo CHtml::encode($data->id_karier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_absen')); ?>:</b>
	<?php echo CHtml::encode($data->id_absen); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis_reward')); ?>:</b>
	<?php echo CHtml::encode($data->jenis_reward); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan_reward')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan_reward); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_data')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_data); ?>
	<br />

	*/ ?>

</div>