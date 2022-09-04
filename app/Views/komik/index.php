<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/komik/tambah" class="btn btn-success mt-3">Tambah Data Komik</a>
            <h1 class="mt-2">Daftar Komik</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <?php if (session()->getFlashdata('pesanHapus')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('pesanHapus'); ?>
                </div>
            <?php endif ?>
            <table class=" table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1 ?>
                    <?php foreach ($komik as $k) : ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <?php if ($k['sampul'] == null) : ?>
                                <td><img src="/img/kosong.png" class="sampul"></td>
                            <?php else :  ?>
                                <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="sampul"></td>
                            <?php endif ?>
                            <td><?= $k['judul']; ?></td>
                            <td><a href="/komik/<?= $k['slug']; ?>" class="btn btn-success">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>