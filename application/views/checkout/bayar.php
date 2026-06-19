<!DOCTYPE html>
<html>
<head>
    <title>Bayar Pesanan</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-cmSF5FPgFQDmjJBS"></script>
</head>
<body>

<h3>Silakan lakukan pembayaran</h3>
<p>Nomor pesanan: <strong><?= $order_id ?></strong></p>
<button id="pay-button">Bayar Sekarang</button>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        snap.pay("<?= $snap_token ?>", {
            onSuccess: function(result){
                alert("Pembayaran berhasil");
                window.location.href = "<?= base_url('checkout/sukses/') ?>";
            },
            onPending: function(result){
                alert("Menunggu pembayaran");
                window.location.href = "<?= base_url('checkout/sukses/') ?>";
            },
            onError: function(result){
                alert("Pembayaran gagal");
                window.location.href = "<?= base_url('checkout/gagal/') ?>";
            }
        });
    };
</script>

</body>
</html>
