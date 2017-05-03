<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'data-project-form',
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Data dengan tanda <span class="required">*</span> harus di isi.</p>

	<?php echo $form->errorSummary($model); ?>

<?php $nip=$model->nip; 
        $no=0;
        $connection=new CDbConnection('mysql:host=localhost;dbname=sudaman','root','');
        $connection->active=true; // open connection
        $idd=Yii::app()->user->getId();
        $que="select * from data_project where nip='$nip'";
        $command=$connection->createCommand($que);
        $reader=$command->query();
    ?>

	<div style="width: 1100px;">
		<table class="table table-hover table-bordered" style="margin-left: 8%;">
  			<thead class="thead-default">
    			<tr style="background:#6caace; color:#fff; border: 1px solid #D5D5D5;">
      				<th><center>#</center></th>
      				<th><center>Nama Proyek</center></th>
      				<th><center>Tanggal Proyek</center></th>
      				<th><center>Tanggal Rilis Proyek</center></th>
      				<th><center>Status Proyek</center></th>
    			</tr>
  			</thead>
  		<tbody>
              <?php
                foreach($reader as $row){
                    ?>
    			<tr>
      				<th scope="row"><center><?php echo $no=$no+1?></center></th>
     				<td><?php echo $row['nama_project'];?></td>
      				<td><?php echo $row['tgl_project'];?></td>
      				<td><?php echo $row['rilis_project'];?></td>
      				<td><?php echo $row['status'];?></td>
    			</tr>
                        <?php
                }
            ?>
  		</tbody>
		</table>
	</div>

	<div style="margin-left: 1; margin-top: 3%;">
	<label class="control-label">NIP Anda <span class="required">*</span></label>
	</div>

	<div style="margin-left: 7%; margin-top: -2.2%;">
	<?php echo $form->textField($model,'nip',array('class'=>'span5','placeholder'=>'NIP','minLength'=>5));?>
	</div>

		<div style="width: 1235px; margin-left: -3.5%;">
	    <?php $this->widget('application.extensions.appendo.JAppendo',array(
        	'id' => 'repeateEnum',        
        	'model' => $model2,
        	'viewName' => 'project',
        	'labelDel' => 'Hapus Kolom',
       		// 'cssFile' => 'css/jquery.appendo2.css'
    	)); ?>
    	</div>

<div class="form-actions">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'icon'=>'white plus',
			'label'=>$model->isNewRecord ? 'Simpan' : 'Ubah',
		)); ?>
</div>

<?php $this->endWidget(); ?>
