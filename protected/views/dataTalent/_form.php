<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'data-talent-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Kolom dengan tanda <span class="required">*</span> harus di isi.</p>

	<?php echo $form->errorSummary($model); ?>

<div style="float: left; margin-top: 1%;">	

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Pilih Jabatan <br/>Pegawai <span class="required">*</span></label>
	</div>

	<div style="margin-top: -8%; margin-left: 29%;">
	<?php echo $form->labelEx($model,''); ?>
	<?php
	echo $form->DropDownList($model,'id_jabatan',
		CHtml::listData(TblJabatan::model()->findAll(array('order'=>'nama_jabatan asc')),'id_jabatan','nama_jabatan'),
		array(
			'prompt'=>'Pilih Jabatan',
			'class'=>'span5',
			'ajax' => array(
				'type'=>'POST',
				'url'=>CController::createUrl('DataTalent/lookuppegawai'), //selectjur adalah actionSelectjur di ProfilController.
				'update'=>'#'.CHtml::activeId($model,'nip'), //jurusan_id = field jurusan_id
				'beforeSend'=>'function() { 
					$("#DataTalent_nip").find("option").remove();
					$("#DataTalent_nama_lengkap").find("option").remove();
				}',
				//Bila tidak menggunakan ini, maka yg terupdate hanya jurusan (bawaan 'update').
				)
			)
		);
		?>
		<?php echo $form->error($model,'id_jabatan'); ?>
	</div>

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Pilihan NIP <br/>Pegawai </label>
	</div>

	<div style="margin-top: -8%; margin-left: 29%;">
	<?php echo $form->labelEx($model,''); ?>
	<?php echo $form->dropDownList($model,'nip',
		(!$model->isNewRecord) ? $model->lookuppegawai() :array(),
		array(
			'class'=>'span5',
			'prompt'=>'Pilih Pegawai',
			)
			); ?> 

			<?php echo $form->error($model,'nip'); ?>
	</div>

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Pilih Jenis <br/>Pelatihan <span class="required">*</span></label>
	</div>

	<div style="margin-top: -8%; margin-left: 29%;">
	<?php 
	echo $form->dropDownList($model,'id_pelatihan', 
		CHtml::listData(DataPelatihan::model()->findAll(array('order'=>'jenis asc')),
			'id_pelatihan','jenis','status'),
			array('prompt'=>'Pilih Jenis Pelatihan','class'=>'span5')
		);
	;?>
	</div>

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Kategori <br/>Pelatihan <span class="required">*</span></label>
	</div>

	<div style="margin-top: -8%; margin-left: 29%;">
	<?php 
	echo $form->dropDownList($model,'id_kategori', 
		CHtml::listData(DataKategori::model()->findAll(array('order'=>'kategori asc')),
			'id_kategori','kategori'),
			array('prompt'=>'Pilih Kategori','class'=>'span5')
		);
	;?>
	</div>

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Status <br/>Pelatihan <span class="required">*</span></label>
	</div>

	<div style="margin-top: -8%; margin-left: 29%;">
	<?php echo $form->dropDownList($model,'status',DataTalent::getStatus(),array('prompt'=>'Pilih Status','class'=>'span5'));?>
	</div>

	<div style="margin-top: 1%; margin-left: 1%;">
	<label class="control-label">Pilih Trainner <br/>Pelatihan <span class="required">*</span></label>
	</div>

	<div style="margin-top: -8%; margin-left: 29%;">
	<?php 
	echo $form->dropDownList($model,'kode_trainner', 
		CHtml::listData(DataTrainner::model()->findAll(array('order'=>'nama_trainner asc')),
			'kode_trainner','nama_trainner'),
			array('prompt'=>'Pilih Trainner Pelatihan','class'=>'span5')
		);
	;?>
	</div>
</div>

<div style="float: right; margin-top: 1%;">

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Tanggal Mulai <br/>Pelatihan <span class="required">*</span></label>
	</div>

	<div style="margin-left: -4%; margin-top: -8%;">
	<?php $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
        'model' => $model,
        'attribute' => 'tgl_mulai',
        'options' => array(), //DateTimePicker options
        'htmlOptions' => array('class'=>'span5','placeholder'=>'Atur Tanggal & Waktu'),
    ));
	?>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Tanggal Selesai <br/>Pelatihan <span class="required">*</span></label>
	</div>
	
	<div style="margin-left: -4%; margin-top: -8%;">
	<?php $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
        'model' => $model,
        'attribute' => 'tgl_selesai',
        'options' => array(), //DateTimePicker options
        'htmlOptions' => array('class'=>'span5','placeholder'=>'Atur Tanggal & Waktu'),
    ));
	?>
	</div>

	<div style="margin-left: -34%; margin-top: 3%;">
	<label class="control-label">Tempat Pelatihan </label>
	</div>

	<div style="margin-left: -4%; margin-top: -6%;">
	<?php echo $form->textField($model,'tempat',array('class'=>'span5','placeholder'=>'Tempat Pelatihan Talenta'));?>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Durasi Pelatihan <br/><small>(Perhari)</small> </label>
	</div>

	<div style="margin-left: -4%; margin-top: -8%;">
	<?php echo $form->textField($model,'durasi',array('class'=>'span1','placeholder'=>'Jam'));?>
	</div>

	<div style="margin-left: -34%; margin-top: 1%;">
	<label class="control-label">Keterangan Pelatihan <br/><small>(Wajib di isi)</small> </label>
	</div>

	<div style="margin-left: -4%; margin-top: -9%;">
	<?php echo $form->textArea($model,'keterangan',array('class'=>'span5','placeholder'=>'Keterangan Pelatihan'));?>
	</div>

	<div style="margin-left: -4%; margin-top: 8%;">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Ubah',
		)); ?>
</div>
</div>


<?php $date=date("Y-m-d H:i:s"); echo $form->hiddenField($model,'tgl_data',array('class'=>'span4','value'=>$date)); ?>


<?php $this->endWidget(); ?>
<?php
Yii::app()->clientScript->registerScript('data-talent-functions', "
$('#Personal_jenis_jenjang').change(function(){
        showHideSignedInput();
});
function showHideSignedInput() {
		 if ($('#Personal_jenis_jenjang').val() == 'Perguruan Tinggi') {
                $('#perguruan').show();
        }
        else if ($('#Personal_jenis_jenjang').val() == 'SMA/SMK' ) {
                $('#perguruan').hide();
        }

}
showHideSignedInput();
");
?>