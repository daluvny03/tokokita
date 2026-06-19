<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pertanyaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <h4>Detail Pertanyaan</h4>
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Produk</th>
                        <td>: <?= htmlspecialchars($pertanyaan->produk_nama) ?></td>
                    </tr>
                    <tr>
                        <th>Pembeli</th>
                        <td>: <?= htmlspecialchars($pertanyaan->pembeli_nama) ?></td>
                    </tr>
                    <tr>
                        <th>Pertanyaan</th>
                        <td>: <?= nl2br(htmlspecialchars($pertanyaan->isi_pertanyaan)) ?></td>
                    </tr>
                    <tr>
                        <th>Jawaban</th>
                        <td>
                                <form action="<?= site_url('admin/PertanyaanAdmin/jawab') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $pertanyaan->id ?>">
                                    <div class="mb-3">
                                        <input type="text" name="jawaban" class="form-control" rows="4" value=" <?= $pertanyaan->jawaban ?>"></input>
                                    </div> <button type="submit" class="btn btn-primary">Update Jawaban</button>
                                    <a href="<?= site_url('admin/PertanyaanAdmin') ?>" class="btn btn-secondary">Kembali</a>
                                </form>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>: <?= date('d M Y H:i', strtotime($pertanyaan->tanggal_jawaban)) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>