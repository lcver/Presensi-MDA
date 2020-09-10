<div class="mb-3 pt-3">
    <h5><a href="<?=BASEURL?>pengurus">
        <i class="fas fa-chevron-left" ></i>
        Kembali
    </a></h5>
</div>
<div class="card card-outline card-indigo">
    <div class="card-header">
        Data Rekap Tahun 2020
    </div>
    <div class="card-body">
        <div class="row">
        <?php if(!is_null($data)) : ?>
            <?php foreach ($data as $d) : ?>
                <div class="col-md-4">
                    <a href="<?=BASEURL?>rekap/data/<?=$d['idJadwal']?>" class="">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary" style="background:#<?=$bgcolor[$a]?>!important">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-md">Jadwal <?=date_format(date_create($d['tanggal']),'d/m/Y')?></span>
                            <span class="info-box-number text-sm">Total Presensi : <?=$d['total']?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>
</div>