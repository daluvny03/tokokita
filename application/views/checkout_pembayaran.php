<!DOCTYPE html>
<html>
<head>
    <title>Bayar Pesanan</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo getenv('MIDTRANS_SERVER_KEY'); ?>"></script>
</head>
<body>

<h3>Silakan lakukan pembayaran</h3>
<p>Nomor pesanan: <strong><?= $order_id ?></strong></p>
<button id="pay-button">Bayar Sekarang</button>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        snap.pay("<?= $snapToken ?>", {
            onSuccess: function(result){
                alert("Pembayaran berhasil");
                window.location.href = "<?= site_url('checkout/bayar/' ) ?>";
            },
            onPending: function(result){
                alert("Menunggu pembayaran");
                window.location.href = "<?= site_url('checkout/bayar/' ) ?>";
            },
            onError: function(result){
                alert("Pembayaran gagal");
                window.location.href = "<?= site_url('checkout/bayar/' ) ?>";
            }
        });
    };
</script>

</body>
</html>
