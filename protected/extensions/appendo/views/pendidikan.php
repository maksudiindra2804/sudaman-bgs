        <div style="margin-left: 14%;">
<table class="appendo-gii" id="<?php echo $id ?>">
    <thead>
        <tr>
            <th>Tahun Pertama <span class="required">*</span></th><th>Tahun Kedua <span class="required">*</span></th><th>Riwayat Pendidikan <span class="required">*</span></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $no=0;
    if ($model->tahun1 == null): ?>
        <tr>
            <td><?php echo CHtml::textField('tahun1[]','',array('style'=>'width:120px','placeholder'=>'Tahun Pertama')); ?></td>
            <td><?php echo CHtml::textField('tahun2[]','',array('style'=>'width:120px','placeholder'=>'Tahun Kedua')); ?></td>
            <td><?php echo CHtml::textArea('riwayat[]','',array('style'=>'width:400px','rows'=>3,'placeholder'=>'Jenis Riwayat Pendidikan')); ?></td>

        </tr>
    <?php else: ?>
        <?php for($i = 0; $i < sizeof($model->tahun1); ++$i): ?>
            <tr>
                <td><?php echo CHtml::textField('tahun1[]',$model->tahun1[$i],array('style'=>'width:120px')); ?></td>
                <td><?php echo CHtml::textField('tahun2[]',$model->tahun2[$i],array('style'=>'width:120px')); ?></td>
                <td><?php echo CHtml::textField('riwayat[]',$model->riwayat[$i],array('style'=>'width:120px')); ?></td>
            </tr>
        <?php endfor; ?>
        <tr>
            <td><?php echo CHtml::textField('tahun1[]','',array('style'=>'width:120px')); ?></td>
            <td><?php echo CHtml::textField('tahun2[]','',array('style'=>'width:120px')); ?></td>
            <td><?php echo CHtml::textArea('riwayat[]','',array('style'=>'width:120px')); ?></td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</div>