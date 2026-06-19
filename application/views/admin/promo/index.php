<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
  <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<div class="container mt-4">
  <a href="<?= site_url('admin/promo/tambah') ?>" class="btn btn-primary mb-3">Tambah Promo</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama Promo</th>
        <th>Poster</th>
        <th>Status</th>
        <th>Link</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($promo as $i => $row): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= $row->nama_promo ?></td>
          <td><img src="<?= base_url('uploads/promo/' . urlencode($row->poster)) ?>" width="100"></td>

          <td><?= $row->status ?></td>
          <td><?= $row->link ?></td>
          <td>
            <a href="<?= site_url('admin/promo/edit/' . $row->id_promo) ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="<?= site_url('admin/promo/hapus/' . $row->id_promo) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>