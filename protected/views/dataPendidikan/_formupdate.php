<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'data-pendidikan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Kolom dengan tanda <span class="required">*</span> harus di isi.</p>

	<?php echo $form->errorSummary($model); ?>
<?php $nip=$model->nip; 
        $no=0;
        $connection=new CDbConnection('mysql:host=localhost;dbname=sudaman','root','');
        $connection->active=true; // open connection
        $idd=Yii::app()->user->getId();
        $que="select * from data_pendidikan where nip='$nip'";
        $command=$connection->createCommand($que);
        $reader=$command->query();
    ?>

	<div style="width: 1100px;">
		<table class="table table-hover table-bordered" style="margin-left: 8%;">
  			<thead class="thead-default">
    			<tr style="background:#6caace; color:#fff; border: 1px solid #D5D5D5;">
      				<th><center>#</center></th>
      				<th><center>Tahun Ke-1</center></th>
      				<th><center>Tahun Ke-2</center></th>
      				<th><center>Riwayat Pendidikan</center></th>
    			</tr>
  			</thead>
  		<tbody>
              <?php
                foreach($reader as $row){
                    ?>
    			<tr>
      				<th scope="row"><center><?php echo $no=$no+1?></center></th>
     				<td><?php echo $row['tahun1'];?></td>
      				<td><?php echo $row['tahun2'];?></td>
      				<td><?php echo $row['riwayat'];?></td>
    			</tr>
                        <?php
                }
            ?>
  		</tbody>
		</table>
	</div>

	<div style="margin-left: 3%; margin-top: 3%;">
	<label class="control-label">NIP Anda <span class="required">*</span></label>
	</div>

	<div style="margin-left: 12%; margin-top: -2.2%;">
	<?php echo $form->textField($model,'nip',array('class'=>'span5','placeholder'=>'NIP','minLength'=>5));?>
	</div>
		<div style="width: 850px; margin-left: 2%;">
	    <?php $this->widget('application.extensions.appendo.JAppendo',array(
        	'id' => 'repeateEnum',        
        	'model' => $model2,
        	'viewName' => 'pendidikan',
        	'labelDel' => 'Hapus Kolom',
       		// 'cssFile' => 'css/jquery.appendo2.css'
    	)); ?>
    	</div>

<div class="form-actions">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Ubah',
		)); ?>
</div>

<?php $this->endWidget(); ?>
