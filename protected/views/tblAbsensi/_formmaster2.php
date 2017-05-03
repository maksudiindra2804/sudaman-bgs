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

	<div style="margin-left:19%; margin-top:-2.5%;">
	<?php $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
        'model' => $model,
        'attribute' => 'absen_datang',
        'options' => array(), //DateTimePicker options
        'htmlOptions' => array('class'=>'span5','placeholder'=>'Atur Tanggal & Waktu'),
    ));
	?>
	</div>

	<div style="margin-left:10%; margin-top:1%;">
	<label class="control-label">NIP Pegawai <span class="required">*</span></label>
	</div>
	
	<div style="margin-left:19%; margin-top:-2.5%;">
	<?php echo $form->labelEx($model,''); ?>
 	<?php
 		echo $form->DropDownList($model,'nip',
 		CHtml::listData(Personal::model()->findAll(),'nip','nip','nama_lengkap'),
 			array(
   				'prompt'=>'Pilih NIP',
   				'class'=>'span5',
   				'ajax' => array(
     			'type'=>'POST',
     			'url'=>CController::createUrl('TblAbsensi/lookupnip'), //selectjur adalah actionSelectjur di ProfilController.
     				//'update'=>'#'.CHtml::activeId($model,'id_kotkab'), //jurusan_id = field jurusan_id
     				//'beforeSend'=>'function() { 
       				//$("#TblPersonal_kotkab_id").find("option").remove();

     				//}',
     				//Bila tidak menggunakan ini, maka yg terupdate hanya jurusan (bawaan 'update').
   				)
 			)
 		);
 	?>
	</div>

	<div style="margin-left:10%; margin-top:1%;">
	<label class="control-label">Status <span class="required">*</label>
	</div>

	<div style="margin-left:19%; margin-top:-2.5%;">
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

<div style="margin-left: 65%; margin-top: -20%;">
<div style="text-align:center;width:400px;padding:1em 0;"> <h2><a style="text-decoration:none;" href="http://www.zeitverschiebung.net/en/timezone/asia--jakarta"><span style="color:gray;"></span><br />Bandung, Jawa Barat</a></h2> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&timezone=Asia%2FJakarta" width=100%" height="150" frameborder="0" seamless></iframe></div>
</div>

	<div  id="keterangan1">
	<div style="margin-left:10%; margin-top:-3.5%;">
	<label class="control-label">Keterangan</label>
	</div>

	<div style="margin-left:19%; margin-top:-2.5%;">
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