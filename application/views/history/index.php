<div class="container mt-5">
    <h3>History Pembelian</h3>
    <?php if(empty($pesanan)) : ?>
        <p>Belum ada pesanan.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pesan</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pesanan as $index => $p) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($p->tanggal_pesanan)) ?></td>
                        <td>Rp <?= number_format($p->total_bayar, 0, ',', '.') ?></td>
                        <td><?= $p->status ?></td>
                        <td>
                            <a href="<?= site_url('history/detail/' . $p->id) ?>" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
