<div style="margin-left: 10%;">
<table class="appendo-gii" id="<?php echo $id ?>">
    <thead>
        <tr>
            <th>Tanggal Proyek <span class="required">*</span></th><th>Tanggal Rilis <span class="required">*</span></th><th>Status Proyek <span class="required">*</span></th><th>Keterangan Proyek <span class="required">*</span></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $no=0;
    if ($model->tgl_project == null): ?>
        <tr>
            <td><?php echo CHtml::DateField('tgl_project[]','',array('style'=>'width:200px','placeholder'=>'Tahun Pertama')); ?></td>
            <td><?php echo CHtml::DateField('rilis_project[]','',array('style'=>'width:200px','placeholder'=>'Tahun Kedua')); ?></td>
            <td><?php echo CHtml::dropDownList('status[]',"string",
                array(
                    "On Progress"=>"On Progress",
                    "Done"=>"Done",
                    "On Boarding Project"=>"On Boarding Project",
                ),array('style'=>'width:200px'));
            ?></td>
            <td><?php echo CHtml::textArea('nama_project[]','',array('style'=>'width:400px','rows'=>3,'placeholder'=>'Jenis/Nama Proyek')); ?></td>

        </tr>
    <?php else: ?>
        <?php for($i = 0; $i < sizeof($model->tgl_project); ++$i): ?>
            <tr>
                <td><?php echo CHtml::DateField('tgl_project[]',$model->tgl_project[$i],array('style'=>'width:120px')); ?></td>
                <td><?php echo CHtml::DateField('rilis_project[]',$model->rilis_project[$i],array('style'=>'width:120px')); ?></td>
                <td><?php echo CHtml::dropDownList('status[]',$model->status[$i],
                    array(
                    "On Progress"=>"On Progress",
                    "Done"=>"Done",
                    "On Boarding Project"=>"On Boarding Project",
                    ),array('style'=>'width:100px'));
                ?></td>
                <td><?php echo CHtml::textField('nama_project[]',$model->nama_project[$i],array('style'=>'width:120px')); ?></td>
            </tr>
        <?php endfor; ?>
        <tr>
            <td><?php echo CHtml::DateField('tgl_project[]','',array('style'=>'width:120px')); ?></td>
            <td><?php echo CHtml::DateField('rilis_project[]','',array('style'=>'width:120px')); ?></td>
            <td> <?php echo CHtml::dropDownList('status[]',"string",
                array(
                    "On Progress"=>"On Progress",
                    "Done"=>"Done",
                    "On Boarding Project"=>"On Boarding Project",
                    ),array('style'=>'width:100px'));
            ?></td>
            <td><?php echo CHtml::textArea('nama_project[]','',array('style'=>'width:120px')); ?></td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</div>