<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href="#"><small><img src="/sudaman_bgs/images/banner-crt2.png" width="100">&nbsp;&nbsp;&nbsp;Human Resources System </small></a>
          
          <div class="nav-collapse">
			<?php
            $code = new EncrptionUrl;
            $decrypt = $code->encode(Yii::app()->user->getId());
            $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        //public
                        array('label'=>'<i class="fa fa-home"></i>&nbsp; Home', 'url'=>array('/site/index')),
                        array('label'=>'<i class="fa fa-pencil-square"></i>&nbsp; Registrasi', 'url'=>array('/personal/registrasi'),'visible'=>Yii::app()->user->isGuest),

                        //employees
                        array('label'=>'<i class="fa fa-user"></i>&nbsp; Data Personal <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==3,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'Biodata Diri', 'url'=>array('/personal/viewuser','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==3),
                            array('label'=>'Riwayat Pendidikan', 'url'=>array('/personal/addpendidikan','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==3),
                            array('label'=>'Riwayat Pekerjaan', 'url'=>array('/personal/addproject','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==3),
                        )),

                        array('label'=>'<i class="fa fa-clock-o"></i>&nbsp; Absensi Lembur <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==3,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'Absensi Lembur', 'url'=>array('/tblAbsensi/create','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==3),
                        array('label'=>'Data Absen Lembur', 'url'=>array('/tblAbsensi/viewabsuser','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==3),
                        )),

                        array('label'=>'<i class="fa fa-check-square"></i>&nbsp; Data Talenta', 'url'=>array('/datatalent/viewuser','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==3),

                        //Admin menu
                        array('label'=>'<i class="fa fa-group"></i>&nbsp; Data Pegawai <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==1,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'Data Pegawai', 'url'=>array('/personal/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                            array('label'=>'Riwayat Pendidikan', 'url'=>array('/datapendidikan/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                            array('label'=>'Riwayat Pekerjaan', 'url'=>array('/dataproject/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                            array('label'=>'Data Absensi', 'url'=>array('/tblAbsensi/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                        )),

                        array('label'=>'<i class="fa fa-bar-chart-o"></i>&nbsp; Manajemen Karier <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==1,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'Data Karier Pegawai', 'url'=>array('/datakarier/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                        array('label'=>'Mapping Kompetensi', 'url'=>array('/mappingkarier/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                        )),

                        array('label'=>'<i class="fa fa-money"></i>&nbsp; Data Kompensasi <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==1,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'Data Kompensasi Pegawai', 'url'=>array('/datakompensasi/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                        array('label'=>'Mapping Kompetensi', 'url'=>array('/mappingkarier/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                        )),

                        array('label'=>'<i class="fa fa-check-square"></i>&nbsp; Manajemen Talenta <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==1,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'Data Talenta Pegawai', 'url'=>array('/datatalent/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                        array('label'=>'Data Trainner', 'url'=>array('/datatrainner/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                        array('label'=>'Data Pelatihan', 'url'=>array('/datapelatihan/admin','id'=>$decrypt),'visible'=>Yii::app()->user->getLevel()==1),
                        )),

                        //Setting
                        array('label'=>'<i class="fa fa-cogs"></i>&nbsp; Pengaturan <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==3,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'<i class="fa fa-sign-in"></i>&nbsp; Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'<i class="fa fa-cog"></i>&nbsp; Reset Password', 'url'=>array('/personal/changepassword'), 'visible'=>Yii::app()->user->getLevel()==3),
                        array('label'=>'<i class="fa fa-power-off"></i>&nbsp; Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                        )),

                        //public
                        array('label'=>'<i class="fa fa-cogs"></i>&nbsp; Pengaturan <span class="caret"></span>', 'url'=>'#', 'visible'=>Yii::app()->user->getLevel()==1,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'<i class="fa fa-cog"></i>&nbsp; Reset Password', 'url'=>array('/personal/changepassword'), 'visible'=>Yii::app()->user->getLevel()==3),
                        array('label'=>'<i class="fa fa-power-off"></i>&nbsp; Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                        )),

                        //admin
                        array('label'=>'<i class="fa fa-cogs"></i>&nbsp; Pengaturan <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==1,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'<i class="fa fa-sign-in"></i>&nbsp; Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'<i class="fa fa-cog"></i>&nbsp; Reset Password', 'url'=>array('/personal/changepassword'), 'visible'=>Yii::app()->user->getLevel()==1),
                        array('label'=>'<i class="fa fa-power-off"></i>&nbsp; Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                        )),
                        array('label'=>'<i class="fa fa-sign-in"></i>&nbsp; Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        
                        //owner

                        array('label'=>'<i class="fa fa-cogs"></i>&nbsp; Pengaturan <span class="caret"></span>', 'url'=>'#','visible'=>Yii::app()->user->getLevel()==2,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                        array('label'=>'<i class="fa fa-cog"></i>&nbsp; Reset Password', 'url'=>array('/personal/changepassword'), 'visible'=>Yii::app()->user->getLevel()==2),
                        array('label'=>'<i class="fa fa-power-off"></i>&nbsp; Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                        )),
                        
                        
                        
                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">

           <form class="navbar-search pull-right" action="">

           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->