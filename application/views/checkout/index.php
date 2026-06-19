<div class="container mt-5">
    <h4>Checkout</h4>

    <div class="row">
        <!-- FORM CHECKOUT -->
        <div class="col-md-8">
            <form action="<?= site_url('checkout/proses') ?>" method="post" id="checkoutForm">
                <div class="mb-3">
                    <label>Nama Penerima</label>
                    <input type="text" name="nama" class="form-control" value="<?= $pembeli['nama_pembeli']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= $pembeli['no_hp']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" id="alamat_tujuan" class="form-control" value="<?= $pembeli['alamat']; ?>">
                </div>
                <div class="mb-3">
                    <label>Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control" value="<?= $pembeli['kode_pos']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label>Kurir</label>
                    <select name="kurir" class="form-select" required>
                        <option value="">-- Pilih Kurir --</option>
                        <option value="jne" <?= isset($kurir) && $kurir == 'jne' ? 'selected' : '' ?>>JNE</option>
                        <option value="tiki" <?= isset($kurir) && $kurir == 'tiki' ? 'selected' : '' ?>>TIKI</option>
                        <option value="pos" <?= isset($kurir) && $kurir == 'pos' ? 'selected' : '' ?>>POS</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="diskon_id" class="form-label">Gunakan Kupon</label>
                    <select name="diskon_id" id="diskon_id" class="form-select" disabled>
                        <option value="">-- Pilih Kupon --</option>
                        <?php foreach ($diskon_aktif as $diskon): ?>
                            <option value="<?= $diskon->nilai ?>">
                                <?= $diskon->nama ?> -
                                <?= ($diskon->tipe == 'persen')
                                    ? $diskon->nilai . '%'
                                    : 'Rp ' . number_format($diskon->nilai, 0, ',', '.') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <!-- Hidden Fields -->
                <input type="hidden" name="kota_asal" id="kota_asal" value="<?= $kode_pos['kodepos']; ?>">
                <input type="hidden" name="berat" value="1000">
                <input type="hidden" name="provinsi" id="provinsi" value="<?= $pembeli['provinsi'] ?? '' ?>">
                <input type="hidden" name="kota" id="kabupaten" value="<?= $pembeli['kota'] ?? '' ?>">
                <input type="hidden" name="kecamatan" id="kecamatan" value="<?= $pembeli['kecamatan'] ?? '' ?>">
                <input type="hidden" name="kode_pos" id="kode_pos" value="<?= $pembeli['kode_pos'] ?? '' ?>">
                <input type="hidden" name="kota_tujuan" id="city_id">
                <input type="hidden" name="ongkir" id="ongkir" value="<?= $ongkir ?? 0 ?>">
                <input type="hidden" name="diskon" id="diskon" value="0">

                <button type="submit" class="btn btn-primary" id="btnBayar" disabled>Bayar Sekarang</button>
            </form>
        </div>

        <!-- RINGKASAN BELANJA -->
        <div class="col-md-4">
            <h4>Ringkasan Belanja</h4>
            <hr>
            <table class="table table-bordered">
                <tr>
                    <td>Produk</td>
                    <td><?= $this->cart->total_items() ?> Produk</td>
                </tr>
                <tr>
                    <td>Total Berat</td>
                    <td>1000gr</td>
                </tr>
                <tr>
                    <td>Total Harga</td>
                    <td>Rp<?= number_format($this->cart->total()) ?></td>
                </tr>
                <tr>
                    <td>Ongkir</td>
                    <td><span id="tampil_ongkir">Rp.0</span></td>
                </tr>
                <tr>
                    <td>Diskon</td>
                    <td><span id="tampil_diskon">Rp.0</span></td>
                </tr>
                <tr>
                    <td>Total Pembayaran</td>
                    <td id="total_bayar">Rp<?= number_format($this->cart->total() + ($ongkir ?? 0)) ?></td>
                    <input type="hidden" name="total_bayar" id="total_bayar" value=" <?= $this->cart->total() + ($ongkir ?? 0) ?>">
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- jQuery UI & Ajax -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $(document).ready(function() {

        function hitungTotalBayar() {
        var total_cart = <?= $this->cart->total() ?>;
        var ongkir = parseInt($('#ongkir').val()) || 0;
        var diskon = parseInt($('#diskon_id').val()) || 0;
        $('#diskon').val(diskon);

        var total_bayar = (total_cart + ongkir) - diskon;
        console.log(total_bayar, total_cart, diskon, ongkir)
        $('#total_bayar').text("Rp " + total_bayar.toLocaleString('id-ID'));
        $('#total_bayar_fix').val(total_bayar);
    }
        $('[name="kurir"]').on('change', function() {
            hitungOngkir();
        });
        // Saat Diskon Berubah
        $('[name="diskon_id"]').on('change', function(){
            var diskon1=$('[name="diskon_id"]').val();
            var diskon=parseInt(diskon1)
            $('#tampil_diskon').empty(); 
            $('#tampil_diskon').append('Rp.' + diskon.toLocaleString('id-ID'))
            hitungTotalBayar();
        });
        // Saat Kurir dipilih
        

        // Hitung ongkir
        function hitungOngkir() {
            var city_id = $('#city_id').val();
            var kurir = $('[name="kurir"]').val();
            var berat = 1000;
            var asal = $('#kota_asal').val();
            var kode_pos = $('#kode_pos').val();
            console.log(asal, berat, kurir, kode_pos)
            if (kurir) {
                $.ajax({
                    url: "<?= site_url('ongkir/ongkir') ?>",
                    method: "POST",
                    data: {
                        kota_asal: asal,
                        kode_pos: kode_pos,
                        kurir: kurir,
                        berat: berat
                    },
                    success: function(data) {
                        var ongkir = parseInt(data);
                        $('#ongkir').val(ongkir);
                        $('#tampil_ongkir').text("Rp." + ongkir.toLocaleString('id-ID'));
                        $('#btnBayar').prop('disabled', false);
                        $('#diskon_id').prop('disabled', false);
                        // Hitung total pembayaran 
                        var total_keranjang = <?= $this->cart->total() ?>;
                        var total_bayar = total_keranjang + ongkir;
                        $('#total_bayar').text("Rp." + total_bayar.toLocaleString('id-ID'));
                    }
                });
            }
        }
    });
    

</script>
