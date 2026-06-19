<div class="container mt-4">
    <h4>Manajemen Diskon</h4>
    <a href="<?= site_url('admin/diskon/create') ?>" class="btn btn-primary btn-sm mb-3">Tambah Diskon</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>nama</th>
                <th>Produk</th>
                <th>Tipe</th>
                <th>Nilai</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($diskon as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->nama_produk ?? 'Semua Produk' ?></td>
                    <td><?= $row->tipe ?></td>
                    <td>
                        <?= $row->tipe == 'persen' ? $row->nilai . '%' : 'Rp ' . number_format($row->nilai) ?>
                    </td>
                    <td><?= $row->mulai ?> s.d <?= $row->selesai ?></td>
                    <td>
                        <a href="<?= site_url('admin/diskon/edit/' . $row->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= site_url('admin/diskon/hapus/' . $row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus diskon ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

