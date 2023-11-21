<div class="container">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

    <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>mahasiswa/tambah" class="btn btn-primary">Tambah
                Data Mahasiswa</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <h3>Daftar Mahasiswa</h3>
            <?php if (empty($mahasiswa)) : ?>
            <div class="alert alert-danger" role="alert">
                data mahasiswa tidak ditemukan.
            </div>
            <?php endif; ?>
            <ul class="list-group">
                <?php foreach ($mahasiswa as $mhs) : ?>
                <li class="list-group-item">
                    <?= $mhs['nama']; ?>
                    <a href="<?= base_url(); ?>mahasiswa/hapus/<?= $mhs['id']; ?>"
                        class="badge badge-danger float-right tombol-hapus">Hapus</a>
                    <a href="<?= base_url(); ?>mahasiswa/ubah/<?= $mhs['id']; ?>"
                        class="badge badge-success float-right">Ubah</a>
                    <a href="<?= base_url(); ?>mahasiswa/detail/<?= $mhs['id']; ?>"
                        class="badge badge-primary float-right">Detail</a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>