<div class="container mt-5">
    <h3>Detail Penjualan Pesanan #<?= $penjualan['header']->id ?></h3>
    <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($penjualan['header']->tanggal_pesanan)) ?></p>
    <p><strong>Status:</strong> <?= $penjualan['header']->status ?></p>
    <p><strong>Alamat Kirim:</strong> <?= $penjualan['header']->alamat ?></p>
    <p><strong>No HP:</strong> <?= $penjualan['header']->no_hp ?></p>
    <p><strong>Total Bayar:</strong> Rp <?= number_format($penjualan['header']->total_bayar,0,',','.') ?></p>

    <h5>Produk yang Terjual</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($penjualan['detail'] as $d): ?>
            <tr>
                <td><?= $d->nama_produk ?></td>
                <td><?= $d->jumlah ?></td>
                <td>Rp <?= number_format($d->harga,0,',','.') ?></td>
                <td>Rp <?= number_format($d->jumlah * $d->harga,0,',','.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= site_url('toko') ?>" class="btn btn-secondary">Kembali</a>
</div>
