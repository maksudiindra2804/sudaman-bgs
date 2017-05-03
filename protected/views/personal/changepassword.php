
<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => 'Ubah Password',
        'headerIcon' => 'icon- fa fa-eye',
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'type' => 'success',
                // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'buttons' => $menu2
            ),
        ) 
    )
);?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
  'id'=>'change-password-form',
  'type'=>'horizontal',
  'enableAjaxValidation'=>false,
)); ?>

  <p class="note">Kolom dengan <span class="required">*</span> wajib diisi.</p>

  <?php echo $form->errorSummary($model); ?>
    <div style="margin-top: 1%; margin-left: 2%;">
    <label class="control-label">Password Lama <span class="required">*</span></label>
    </div>

    <div style="margin-top: 1%; margin-left: 10%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo $form->passwordField($model,'passwordLama',array('class'=>'span5','maxlength'=>32,'minlength'=>4)); ?>
    </div>

    <div style="margin-top: 1%; margin-left: 2%;">
    <label class="control-label">Password Baru <span class="required">*</span></label>
    </div>

    <div style="margin-top: 1%; margin-left: 10%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo $form->passwordField($model,'passwordBaru',array('class'=>'span5','maxlength'=>32,'minlength'=>4)); ?>
    </div>

    <div style="margin-top: 1%; margin-left: 2%;">
    <label class="control-label">Ulangi Password <span class="required">*</span></label>
    </div>

    <div style="margin-top: 1%; margin-left: 10%;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo $form->passwordField($model,'passwordUlangi',array('class'=>'span5','maxlength'=>32,'minlength'=>4)); ?>
    </div>

  <?php if (extension_loaded('gd')): ?>
  <div class="row">
  <br/>
  <div style="margin-left: 20%; margin-top: -1%;">
  <?php $this->widget('CCaptcha'); ?>
  </div>
  <div style="margin-left: 21%; margin-top: 1%;">
  <?php echo CHtml::activeTextField($model,'verifyCode',array('placeholder'=>'Tulis kode verifikasi berikut','class'=>'span4')); ?>
  </div>
<?php endif ;?>


  <div style="margin-left: 21%; margin-top: 2%;">
  <?php $this->widget('bootstrap.widgets.TbButton', array(
      'buttonType'=>'submit',
      'type'=>'primary',
            'icon'=>'white refresh',
      'label'=>$model->isNewRecord ? 'Perbarui' : 'Perbarui',
    )); ?>
    </div>

<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>


<?php
Yii::app()->clientScript->registerScript('change-password-form-functions', 
" 
$(document).ready(function(){
    $('#TblPersonal_passwordLama').focus(function(){
        this.type = 'text';
    }).blur(function(){
        this.type = 'password';
    }) 
  $('#TblPersonal_passwordBaru').focus(function(){
        this.type = 'text';
    }).blur(function(){
        this.type = 'password';
    })
    $('#TblPersonal_passwordUlangi').focus(function(){
        this.type = 'text';
    }).blur(function(){
        this.type = 'password';
    })
    
});



");

?>
