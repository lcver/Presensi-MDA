<div class="container">
    <div class="mb-3 pt-3">
        <h5><a href="<?=isset($data['rekap']) ? BASEURL."rekap" : BASEURL."pengurus" ;?>">
            <i class="fas fa-chevron-left" ></i>
            Kembali
        </a></h5>
    </div>
    <div class="card">
        <div class="card-body">
            <?php foreach ($data['tpq'] as $d) : ?>
            <h3><?=isset($data['rekap']) ? $data['rekap']." TPQ" : "TPQ" ;?> <?=$d['tpq']?></h3>
            <?php endforeach; ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($data['peserta']!==NULL): ?>
                        <?php $no=1; foreach ($data['peserta'] as $d) : ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$d['nama']?></td>
                            <td><?= date_format(date_create($d['curent_timestamp']),'H:i a')?></td>
                        </tr>
                        <?php endforeach ?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>