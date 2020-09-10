<div class="col-md-12">
    <?=Flasher::get()?>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sesi</h4>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-group">
                    <form action="<?=BASEURL?>admin/sesi/set" method="post">
                        <div class="form-group">
                            <label class="text-md">Jadwal</label>
                            <select class="custom-select" name="presensi_jadwal">
                                <?php foreach ($data['jadwal'] as $d) : ?>
                                <option value="<?=$d['id']?>"><?=date_format(date_create($d['tanggal']),'D, d-m-Y')?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Acara : </label>
                            <input class="form-control d-inline" type="text" name="presensi_sesi">
                        </div>
                        <div class="form-group">
                            <!-- <label for="">Tanggal</label>
                            <input class="form-control d-inline dateform" type="date" name="presensi_tanggal" required> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Mulai :</label>
                                    <input class="form-control timepicker-minute" type="time" name="presensi_waktu_mulai" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Selesai :</label>
                                    <input class="form-control timepicker-minute" type="time" name="presensi_waktu_selesai" required>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary float-right">Set Sesi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.col -->

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Presensi Asrama</h4>
    </div>
    <div class="card-body">
        <div class="row">
        <?php if(isset($data['sesi'])) : ?>
        <?php $no=1; foreach ($data['sesi'] as $d) :?>
            <div class="col-md-4">
                <div class="alert alert-info alert-dismissible" id="card-active<?=$d['id']?>">
                        <button type="button" class="close" onclick="btnAjax(<?=$d['id']?>,'<?=BASEURL?>admin/sesi/delete','delete')" >&times;</button>
                    <span class="jadwal-card">
                        <i class="icon fas fa-calendar"></i>
                            <?= $d['sesi'] ?>
                    </span>
                    <p class="schedule">
                        <?= date_format(date_create($d['tanggal']),'d,F Y')?>
                    </p>
                    <p class="schedule" >
                        <?= date_format(date_create($d['waktu_mulai']),'h.i a')?>
                         s/d 
                        <?= date_format(date_create($d['waktu_selesai']),'h.i a')?>
                    </p>
                </div>
            </div>
        <?php
            endforeach;
            endif;
        ?>
        </div>
    </div>
</div>