<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">Daftar Orang</h1>
            <form action="" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Orang" name="keyword" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="sumbit">CARI</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class=" table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1 + (7 * ($currentPage - 1)) ?>
                    <?php foreach ($orang as $t) : ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $t['nama']; ?></td>
                            <td><?= $t['alamat']; ?></td>
                            <td><a href="" class="btn btn-success">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'orang_pagination'); ?>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>