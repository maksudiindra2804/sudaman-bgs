<!--
<style type="text/css">
    html, body{
  height: 100%;
}
body { 
            background-image: url(/sudaman_bgs/banner/hrm-part-time-img-01.jpg) ;
            background-position: center center;
            background-repeat:  no-repeat;
            background-attachment: fixed;
            background-size:  cover;
            background-color: #999;
  
}

div, body{
  margin: 0;
  padding: 0;
  font-family: exo, sans-serif;
  
}
.wrapper {
  height: 100%; 
  width: 100%; 
}

.message {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  width: 100%; 
  height:45%;
  bottom: 0; 
  display: block;
  position: absolute;
  background-color: rgba(0,0,0,0.6);
  color: #fff;
  padding: 0.5em;
}
</style>
<div class="bg"></div>-->

<div class="row-fluid">
	
    <div style="margin-left: 15%;">
    <div class="span4 offset3">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<center><img src='/sudaman_bgs/images/banner-crt2.png' width='300' height='50' border='3' alt=''/> <br/><h3> &nbsp;&nbsp;PT. Bahana Global Solution</h3></center>",
	));
	
?>

    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
        <div style="margin-left: 3%; margin-top:8%;">
        <label class="control-label">Username <span class="required">*</span></label>
        </div>

        <div style="margin-top: -8%; margin-left: 30%;">
        <div class="row">
            <?php echo $form->textField($model,'username',array('placeholder'=>'Username')); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
        </div>

        <div style="margin-left: 3%; margin-top:4%;">
        <label class="control-label">Password <span class="required">*</span></label>
        </div>

        <div style="margin-top: -8%; margin-left: 30%;">
        <div class="row">
            <?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
        </div>

<?php if (extension_loaded('gd')): ?>
    <div class="row">
    <br/>
    <div style="margin-left: 28%; margin-top: -3%;">
    <?php $this->widget('CCaptcha'); ?>
    </div>
    <div style="margin-left: 30%; margin-top: -1%;">
    <?php echo CHtml::activeTextField($model,'verifyCode',array('placeholder'=>'Kode Verifikasi')); ?>
    </div>
<?php endif ;?>
    
    <div style="margin-left: 30%; margin-top: 2%;">
        <div class="row buttons">
            <?php echo CHtml::submitButton('   Sign In   ',array('class'=>'btn btn btn-primary')); ?>
        </div>
    </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->

<?php $this->endWidget();?>

    </div>
    </div>

</div>