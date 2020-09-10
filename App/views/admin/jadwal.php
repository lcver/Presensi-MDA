<div class="col-md-12">
    <div class="col-md-12">
        <?=Flasher::get()?>
    </div>
    <div class="row">
        <div class="col-md-4 bg-transparent" style="border:1px solid transparent;">
            <!-- <div class="card">
                <div class="card-header bg-primary">
                    Daftar Jadwal
                    <a href="">
                        <span class="float-right">more</span>
                    </a>
                </div>
                <div class="card-body"> -->
                    <div class="text-md bg-primary p-2 mb-2 small-box">
                        Daftar Jadwal
                    </div>
                    <?php if(isset($data['jadwal'])) : ?>
                    <?php foreach ($data['jadwal'] as $d) :?>
                        <div class="card <?=$d['status']==2 ? 'bg-primary' : '';?>" id="card-active<?=$d['id']?>">
                            <div class="card-body p-2">
                                <!-- <button type="button" class="btn btn-tool float-right" onclick="btnAjax(<php//$d['id']?>,'<php//BASEURL?>admin/jadwal/delete')" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                                <button class="btn btn-danger btn-sm ml-2 float-right" onclick="btnAjax(<?=$d['id']?>,'<?=BASEURL?>admin/jadwal/delete','delete')"><i class="fas fa-trash-alt"></i></button>
                                <form action="<?=BASEURL?>admin/jadwal/<?=$d['status']==2 ? 'nonaktif' : 'aktivasi' ;?>" method="post">
                                    <input type="hidden" name="id" value="<?=$d['id']?>">
                                    <div class="mt-1 float-left">
                                        <?=date_format(date_create($d['tanggal']),'D, d-m-Y')?>
                                    </div>
                                    <?php if($d['status']==1) :?>
                                        <button type="submit" class="btn btn-primary btn-sm float-right">Enable</button>
                                    <?php else: ?>
                                        <button class="btn btn-danger btn-sm float-right">Disable</button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <?php endif;?>
                    <div class="col-md-12 text-right">
                        <a href="">Lihat semua jadwal</a>
                    </div>
                <!-- </div>
            </div> -->
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jadwal</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="<?=BASEURL?>admin/jadwal/set" method="post">
                                <!-- <ul class="list-unstyled m-0">
                                    <li>
                                        <span class="bg-primary pl-1 pr-1">Sesi 1 : 08.00 ~ 09.00</span>
                                    </li>
                                    <li>
                                        <span class="bg-primary pl-1 pr-1">Sesi 2 : 09.30 ~ 11.00</span>
                                    </li>
                                    <li>
                                        <span class="bg-primary pl-1 pr-1">Sesi 3 : 13.30 ~ 14.30</span>
                                    </li>
                                    <li>
                                        <span class="bg-primary pl-1 pr-1">Sesi 4 : 20.00 ~ 21.30</span>
                                    </li>
                                </ul> -->
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input class="form-control d-inline dateform" type="date" name="presensi_tanggal" required>
                                </div>
                                <button class="btn btn-primary float-right">Set jadwal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</div>