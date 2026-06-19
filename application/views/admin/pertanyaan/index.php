<!DOCTYPE html> <html lang="id"> <head> <meta charset="UTF-8"> <title>Manajemen Pertanyaan - Admin</title> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> </head> <body> <div class="container mt-4"> <h3>Manajemen Pertanyaan</h3> <?php if ($this->session->flashdata('success')) : ?> <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div> <?php endif; ?>
    <table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Produk</th>
            <th>Pembeli</th>
            <th>Pertanyaan</th>
            <th>Jawaban</th>
            <th>Waktu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($pertanyaan)) : ?>
        <?php $no = 1; foreach ($pertanyaan as $row) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlentities($row->produk_nama) ?></td>
                <td><?= htmlentities($row->pembeli_nama) ?></td>
                <td><?= htmlentities($row->isi_pertanyaan) ?></td>
                <td><?= $row->jawaban ? htmlentities($row->jawaban) : '<em>Belum dijawab</em>' ?></td>
                <td><?= date('d/m/Y H:i', strtotime($row->tanggal_dibuat)) ?></td>
                <td>
                    <a href="<?= site_url('admin/PertanyaanAdmin/detail/' . $row->id) ?>" class="btn btn-sm btn-info">Lihat</a>
                    <a href="<?= site_url('admin/PertanyaanAdmin/delete/' . $row->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pertanyaan ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr><td colspan="7" class="text-center">Tidak ada data pertanyaan.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div> </body> </html>