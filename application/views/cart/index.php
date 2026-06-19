<div class="container mt-4">
    <h4>🛒 Keranjang Belanja</h4>

    <?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger" style="margin-top: 15px;"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Total</th>
                <th>Atur</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($keranjang as $item): ?>
                <tr>
                    <td><img src="<?= base_url('uploads/' . $item['options']['foto']); ?>" width="60"></td>
                    <td><?= $item['name'] ?></td>
                    <td>Rp <?= number_format($item['price']) ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>Rp <?= number_format($item['subtotal']) ?></td>
                   <td>
                        <form action="<?= site_url('cart/update') ?>" method="post">
                        <input type="hidden" name="rowid" value="<?= $item['rowid'] ?>">
                        
                        <button type="submit" name="action" value="minus">−</button>

                        <input type="text" name="qty" value="<?= $item['qty'] ?>" readonly style="width: 30px; text-align: center;">

                        <button type="submit" name="action" value="plus">+</button>
                    </form>
                   </td> 
                    <td><a href="<?= site_url('cart/hapus/' . $item['rowid']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus produk ini?')">Hapus</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
          <a href="<?= site_url() ?>" class="btn btn-secondary">← Lanjut Belanja</a>

        <h5>Total: Rp <?= number_format($this->cart->total()) ?></h5>

        <a href="<?= site_url('checkout') ?>" class="btn btn-primary">Lanjut ke Checkout</a>
    </div>
</div>