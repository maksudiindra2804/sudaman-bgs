<?php
$currController 	= Yii::app()->controller->id;
$currControllers	= explode('/', $currController);
$currAction			= Yii::app()->controller->action->id;
$currRoute 			= Yii::app()->controller->getRoute();
$currRoutes			= explode('/', $currRoute);

$menu=array();
if(in_array($currAction,array('index','view','createmaster','update','admin','calendar','import')))
$menu[]=array('label'=>'Daftar Absensi Lembur','url'=>array('index'),'icon'=>'fa fa-list-ol','active'=>($currAction=='index')?true:false);

if(in_array($currAction,array('index','view','createmaster','update','admin','calendar','import')))
$menu[]=array('label'=>'Tambah Data','url'=>array('createmaster'),'icon'=>'fa fa-pencil','active'=>($currAction=='createmaster')?true:false);

if(in_array($currAction,array('index','view','createmaster','update','admin','calendar','import')))
$menu[]=array('label'=>'Data Absensi Lembur','url'=>array('admin'),'icon'=>'fa fa-book','active'=>($currAction=='admin')?true:false);

