<div class="row">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Otomatis Sesi</span>
            <span class="info-box-number">
                <?php if(!is_null($data['set_sesi'])) : ?>
                    click to 
                    <?php foreach ($data['set_sesi'] as $d) : ?>
                        <button class="btn <?=$d['auto_active'] == "active" ? "btn-danger" : "btn-success"?> btn-sm no-border p-1" id="btnAuto" data="<?=$d['id']?>">
                        <?php if($d['auto_active'] == "active") : ?>
                            Disable
                        <?php else: ?>
                            Enable
                        <?php endif;?>
                        </button>
                    <?php endforeach; ?>
                <?php else: ?>
                    sesi tidak ditemukan
                <?php endif; ?>
                
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box mb-3">
        <?php if($data['set_sesi']!=null): ?>
        <?php foreach ($data['set_sesi'] as $d): ?>
            <span class="info-box-icon <?=$d['status']==1 ? "bg-gradient-dark" : "bg-success" ?> elevation-1"><i class="fas fa-clock"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">
                    Sesi
                    <span class="text-bold"><?= $d['sesi'] ?></span>
                </span>
                <span class="info-box-number">
                    <?=date_format(date_create($d['waktu_mulai']), "h:i")." - ".date_format(date_create($d['waktu_selesai']), "h:i")?>
                        <?php if($d['auto_active']=="active") : ?>
                            <span class="bg-info p-1 rounded">auto</span>
                        <?php else : ?>
                            <?php if($d['status']==1): ?>
                                <button class="btn btn-primary btn-sm no-border p-1" id="enSesi" data="<?=$d['id']?>">Enable</button>
                            <?php elseif($d['status']==2): ?>
                                <button class="btn btn-danger btn-sm no-border p-1" id="disSesi" data="<?=$d['id']?>">disable</button>
                            <?php endif; ?>
                        <?php endif?>
                        <!-- <span class="bg-primary p-1 text-bold rounded">auto</span> -->
                </span>
            </div>
            <!-- /.info-box-content -->
        <?php endforeach?>
        <?php else: ?>
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-clock"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">
                    Sesi ~
                </span>
                <span class="info-box-number">
                    sesi tidak ditemukan
                </span>
            </div>
            <!-- /.info-box-content -->
        <?php endif?>
        </div>
        <!-- /.info-box -->
    </div>

    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Jadwal</span>
            <span class="info-box-number">
                <?php
                    if(!is_null($data['jadwal'])):
                        foreach ($data['jadwal'] as $d) : 
                ?>
                    <?=$d['tanggal']?>
                <?php
                        endforeach;
                    else:
                ?>
                    <span class="text-bold">Tidak Ada Jadwal Aktif</span>
                <?php endif; ?>
                <!-- <button class="btn btn-danger btn-sm no-border p-1">disable</button> -->
                <!-- <span class="bg-primary p-1 text-bold rounded">auto</span> -->
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h5 class="card-title">Rekap Laporan Presensi</h5>
        <span class="bg-danger p-1 ml-2 rounded">prototype</span>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
        </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <p class="text-center">
                <strong>Abesensi : 15, Januari 2014 - sekarang</strong>
            </p>

            <div class="chart">
                <!-- Sales Chart Canvas -->
                <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
            </div>
            <!-- /.chart-responsive -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- ./card-body -->
        <div class="card-footer">
        <div class="row">
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                <h5 class="description-header">56</h5>
                <span class="description-text">KEHADIRAN HARI INI</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                <h5 class="description-header">334</h5>
                <span class="description-text">KEHADIRAN MINGGU INI</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                <h5 class="description-header">1324</h5>
                <span class="description-text">KEHADIRAN BULAN INI</span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
            <div class="description-block">
                <span class="description-percentage text-primary"><i class="fas fa-caret-down"></i></span>
                <h5 class="description-header">3000</h5>
                <span class="description-text">TOTAL KEHADIRAN</span>
            </div>
            <!-- /.description-block -->
            </div>
        </div>
        <!-- /.row -->
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header border-0">
            <h3 class="card-title">Laporan Pimpinan Anak Cabang</h3>
            <span class="bg-danger p-1 ml-2 rounded">prototype</span>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
                </a>
            </div>
            </div>
            <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                <th>Nama</th>
                <th>Total</th>
                <th>Kehadiran</th>
                <th>More</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>
                    PAC Cempaka Baru
                </td>
                <td>15</td>
                <td>
                    <small class="text-success mr-1">
                    <i class="fas fa-arrow-up"></i>
                    12%
                    </small>
                </td>
                <td>
                    <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                    </a>
                </td>
                </tr>
                <tr>
                <td>
                    PAC Podomoro
                </td>
                <td>49</td>
                <td>
                    <small class="text-warning mr-1">
                    <i class="fas fa-arrow-down"></i>
                    20%
                    </small>
                </td>
                <td>
                    <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                    </a>
                </td>
                </tr>
                <tr>
                <td>
                    PAC Johar Baru
                </td>
                <td>22</td>
                <td>
                    <small class="text-danger mr-1">
                    <i class="fas fa-arrow-down"></i>
                    3%
                    </small>
                </td>
                <td>
                    <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                    </a>
                </td>
                </tr>
                <tr>
                <td>
                   PAC Menteng
                </td>
                <td>30</td>
                <td>
                    <small class="text-success mr-1">
                    <i class="fas fa-arrow-up"></i>
                    63%
                    </small>
                </td>
                <td>
                    <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                    </a>
                </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

    <div class="col-md-4">
        <!-- Info Boxes Style 2 -->
        <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fas fa-tag"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Inventory <span class="bg-white text-bold p-1 ml-2 rounded">prototype</span></span>
            <span class="info-box-number">5,200</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="far fa-heart"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Mentions <span class="bg-white text-bold p-1 ml-2 rounded">prototype</span></span>
            <span class="info-box-number">92,050</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-danger">
            <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Downloads <span class="bg-white text-bold p-1 ml-2 rounded">prototype</span></span>
            <span class="info-box-number">114,381</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="far fa-comment"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Direct Messages <span class="bg-white text-bold p-1 ml-2 rounded">prototype</span></span>
            <span class="info-box-number">163,921</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->