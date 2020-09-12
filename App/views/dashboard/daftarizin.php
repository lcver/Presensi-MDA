<div class="pt-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <?php $bgcolor = ['6a8caf','4baea0','f67280','99d8d0','be9fe1','eb8242','9cf196','484c7f','722F37']; ?>
                <?php $counData = count($data['kategori']); for ($a=0; $a < $counData; $a++) :?>
                <div class="col-md-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary" style="background:#<?=$bgcolor[$a]?>!important">
                            <?=$data['jumlahdata'][$a]['jumlah']?>
                        </span>
                        <div class="info-box-content">
                            <a href="<?=BASEURL?>pengurus/daftarizin/<?=$data['jumlahdata'][$a]['idKategori']?>">
                            <span class="info-box-text"><?=$data['kategori'][$a]['jenis']=="tpq" ? strtoupper($data['kategori'][$a]['jenis']) : ""?> <?=$data['kategori'][$a]['kategori']?></span>
                            </a>
                            <span class="info-box-number"><?=$data['kategori'][$a]['subKategori']?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>