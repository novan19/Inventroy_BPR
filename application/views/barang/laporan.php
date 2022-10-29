<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Data Barang</h1>
    </div>

    <div class="col-lg-12 mb-4" id="container">

        <!-- Illustrations -->
        <div class="card border-bottom-secondary shadow mb-4">
            <div class="card-body">
                <form action="<?= base_url() ?>laporan_barang/barang_pdf" method="POST" target="_blank">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <button type="submit" class="btn btn-md btn-danger btn-icon-split mb-4">
                                <span class="text text-white">Cetak PDF</span>
                                <span class="icon text-white-50">
                                    <i class="fas fa-file-pdf"></i>
                                </span>
                            </button>
                            <a href="<?= base_url() ?>laporan_barang/barang_excel" class="btn btn-md btn-primary btn-icon-split mb-4 ml-2">
                                <span class="text text-white">Cetak Excel</span>
                                <span class="icon text-white-10">
                                    <i class="fas fa-file-excel"></i>
                                </span> 
                            </a>

                        </div>

                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table" id="dtHorizontalExample" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori Barang</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody style="cursor:pointer;" id="tbody">
                            <?php $no=1; foreach ($barang as $b): ?>
                            <tr>
                                <td onclick="detail('<?= $b->id_barang ?>')"><?= $no++ ?>.</td>
                                <td onclick="detail('<?= $b->id_barang ?>')"><img style="border-radius: 5px;"
                                        src="assets/upload/barang/<?= $b->foto ?>" alt="" width="75px"></td>
                                <td onclick="detail('<?= $b->id_barang ?>')"><?= $b->nama_barang ?></td>
                                <td onclick="detail('<?= $b->id_barang ?>')"><?= $b->kategori_barang ?></td>

                                <td onclick="detail('<?= $b->id_barang ?>')"><?= $b->nama_satuan ?></td>
                                <?php if($this->session->userdata('login_session')['level'] == 'admin' || $this->session->userdata('login_session')['level'] == 'gudang') : ?>
                                <td>
                                   
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> 

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/barang.js"></script>
<script src="<?= base_url(); ?>assets/js/laporan/lap_barang.js"></script>

<?php if($this->session->flashdata('Pesan')): ?>
<?= $this->session->flashdata('Pesan') ?>
<?php else: ?>
<script>
$(document).ready(function() {
    let timerInterval
    Swal.fire({
        title: 'Memuat...',
        timer: 1000,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
        onClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {

    })
});
</script>
<?php endif; ?>