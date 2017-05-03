<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tbl-absensi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Kolom dengan tanda <span class="required">*</span> tidak boleh kosong.</p>

	<?php echo $form->errorSummary($model); ?>
	<br>

	<div style="margin-left:10%; margin-top:2%;">
	<label class="control-label">Waktu Absen <span class="required">*</span></label>
	</div>

	<div style="margin-left:21%; margin-top:-2.5%;">
	<?php $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
        'model' => $model,
        'attribute' => 'absen_time',
        'options' => array(), //DateTimePicker options
        'htmlOptions' => array('class'=>'span5','placeholder'=>'Atur Tanggal & Waktu'),
    ));
	?>
	</div>

	<div style="margin-left:10%; margin-top:1%;">
	<label class="control-label">Absen Pulang <span class="required">*</span></label>
	</div>

	<div style="margin-left:21%; margin-top:-2.5%;">
	<?php $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
        'model' => $model,
        'attribute' => 'pulang_time',
        'options' => array(), //DateTimePicker options
        'htmlOptions' => array('class'=>'span5','placeholder'=>'Atur Tanggal & Waktu'),
    ));
	?>
	</div>

	<div style="margin-left:10%; margin-top:1%;">
	<label class="control-label">Total Jam <span class="required">*</span></label>
	</div>

	<div style="margin-left:21%; margin-top:-2.5%;">		
	<?php echo $form->textField($model,'total_jam',array('class'=>'span5'));?>
	</div>

	<div style="margin-left:10%; margin-top:1%;">
	<label class="control-label">NIK Pegawai <span class="required">*</span></label>
	</div>
	
	<div style="margin-left:21%; margin-top:-2.5%;">
	<?php echo $form->labelEx($model,''); ?>
 	<?php
 		echo $form->DropDownList($model,'nik',
 		CHtml::listData(TblPersonal::model()->findAll(),'nik','nik','name'),
 			array(
   				'prompt'=>'Pilih NIK',
   				'class'=>'span5',
   				'ajax' => array(
     			'type'=>'POST',
     			'url'=>CController::createUrl('TblAbsensi/lookupnik'), //selectjur adalah actionSelectjur di ProfilController.
     				//'update'=>'#'.CHtml::activeId($model,'id_kotkab'), //jurusan_id = field jurusan_id
     				//'beforeSend'=>'function() { 
       				//$("#TblPersonal_kotkab_id").find("option").remove();

     				//}',
     				//Bila tidak menggunakan ini, maka yg terupdate hanya jurusan (bawaan 'update').
   				)
 			)
 		);
 	?>
 	<?php echo $form->error($model,'provinsi_id'); ?>
	</div>

	<div style="margin-left:10%; margin-top:1%;">
	<label class="control-label">Status <span class="required">*</label>
	</div>

	<div style="margin-left:21%; margin-top:-2.5%;">
		<?php
	$selections = array(
		'Alpha'=>'Alpha',
		'Ijin'=>'Ijin',
		'Sakit'=>'Sakit',
		'Lembur'=>'Lembur',

	);
	?>
	<?php echo $form->dropDownList($model, 'status', $selections,array('class'=>'span5','placeholder'=>'Pilih Satus Absen')); ?>
	<?php echo $form->error($model,'status'); ?>
	</div>

	<div  id="keterangan1">
	<div style="margin-left:10%; margin-top:1%;">
	<label class="control-label">Keterangan</label>
	</div>

	<div style="margin-left:21%; margin-top:-2.5%;">
	<?php echo $form->textArea($model,'keterangan',array('class'=>'span5','placeholder'=>'Keterangan untuk pegawai yang sakit atau ijin')); ?>
	</div>

	</div>

<div class="form-actions">
<div style="margin-top: 1%; margin-left: 19.2%;">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Simpan',
		)); ?>

</div>
</div>
<?php $this->endWidget(); ?>
<?php
Yii::app()->clientScript->registerScript('tbl-absensi-form-functions', "
$('#TblAbsensi_status').change(function(){
        showHideSignedInput();
});
function showHideSignedInput() {
        if ($('#TblAbsensi_status').val() == 'Alpha') {
                $('#keterangan1').hide();
        }
        else if ($('#TblAbsensi_status').val() == 'Ijin' ) {
                $('#keterangan1').show();
        }
        else if ($('#TblAbsensi_status').val() == 'Sakit' ) {
                $('#keterangan1').show();
        }
        else if ($('#TblAbsensi_status').val() == 'Lembur' ) {
                $('#keterangan1').hide();
        }

}
showHideSignedInput();
");
?>