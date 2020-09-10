<div class="pb-3">
    <div class="card">
        <div class="card-body">
            <?php if($data['status_jadwal']!==null) : ?>
            <div class="row">
            <!-- PIE CHART -->
                <div class="col-md-5">
                    <div id="pieCard" class="card card-primary" onload="pieChart()">
                        <div class="card-header">
                            <h3 class="card-title">Persentase Daerah</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                    <?php $bgcolor = ['6a8caf','4baea0','f67280','99d8d0','be9fe1','eb8242','9cf196','484c7f']; ?>
                        <?php $counData = count($data['tpq']); for ($a=0; $a < $counData; $a++) :?>
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary" style="background:#<?=$bgcolor[$a]?>!important">
                                    <?=$data['jumlahdata'][$a]['jumlah']?>
                                </span>
                                <div class="info-box-content">
                                    <a href="<?=BASEURL?>pengurus/tpq/<?=$data['jumlahdata'][$a]['idtpq']?>">
                                    <span class="info-box-text">TPQ <?=$data['tpq'][$a]['tpq']?></span>
                                    </a>
                                    <span class="info-box-number"><?=$data['tpq'][$a]['desa']?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <?php endfor; ?>
                        <div class="col-md-12">
                            <div class="info-box col-md-6">
                                <div class="info-box-content float-right">
                                    <span class="info-box-text text-bold pt-3">
                                        <h5>Jumlah kehadiran :</h5>
                                    </span>
                                </div>
                                <span class="info-box-icon bg-primary" style="background:#c3bef0!important;">
                                    <?=$data['total']?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php else :?>
                <h3 class="text-danger">Sesi Belum Dimulai</h3>
            <?php endif;?>
        </div>
        <div class="card-footer">
            <a href="<?=BASEURL?>rekap" class="btn btn-primary">Absensi Sebelumnya</a>
        </div>
    </div>
    <!-- /.card -->
</div>
<script>
    // 'http://localhost/project/Abdar/public/pengurus/jumlah'
    window.onload = function(event) {pieChart('<?=BASEURL?>pengurus/jumlah')}
</script>