<?php
function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',  
        'September',
        'Oktober',
        'November',
        'Desember' 
    );
    $pecahkan = explode('-', $tanggal); 

    // variabel pecahkan 1 = tanggal
    // variabel pecahkan 0 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <form action="<?= base_url() ?>barangKeluar/proses_tambah" name="myForm" method="POST" enctype="multipart/form-data"
        onsubmit="return validateForm()">
 
 
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="d-sm-flex">
                <a href="<?= base_url() ?>barang_keluar" class="btn btn-md btn-circle btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
                &nbsp;  
                <h1 class="h2 mb-0 text-gray-800">Tambah Barang Keluar</h1>
            </div>

            <button type="submit" class="btn btn-primary btn-md btn-icon-split">
                <span class="text text-white">Simpan Data</span>
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span> 
            </button>

        </div>

        <div class="d-sm-flex  justify-content-between mb-0">
            <div class="col-lg-5 mb-4">
                <!-- form -->
                <div class="card border-bottom-secondary shadow mb-4">
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Form Barang Masuk</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">

                            <!-- ID Transaksi -->
                            <div class="form-group"><label>ID Barang Keluar</label>
                                <input class="form-control" name="idbk" value="<?= $kode ?>" type="text" placeholder=""
                                    autocomplete="off" readonly>
                            </div>

                            <!-- Tgl Keluar -->
                            <div class="form-group"><label>Tanggal Keluar</label>
                                <input class="form-control" name="tgl" id="datepicker" value="<?= $tglnow ?>" type="text" placeholder=""
                                    autocomplete="off">
                            </div>

                            <!-- opsi barang -->
                            <?php if($jmlbarang > 0): ?>
                            <div class="form-group"><label>Barang</label>
                                <select name="barang" class="form-control chosen" onchange="ambilBarang()">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($barang as $b): ?>
                                    <option value="<?= $b->id_barang ?>"><?= $b->nama_barang ?></option>
                                    <?php endforeach ?>
                                </select>

                            </div>

                            <!-- Harga Barang -->
                            <div class="form-group"><label>Harga Barang</label>
                                <input class="form-control" name="harga" id="harga" type="number" placeholder="" value="">
                            </div>

                            <?php else: ?>
                            <div class="form-group"><label>Barang</label>
                                <input type="hidden" name="barang">
                                <div class="d-sm-flex justify-content-between">
                                    <span class="text-danger"><i>(Belum Ada Data Barang!)</i></span>
                                    <a href="<?= base_url() ?>barang" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- opsi KCB -->
                            <?php if($jmlkcb > 0): ?>
                            <div class="form-group"><label>Kantor Cabang</label>
                                <select name="kcb" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($kcb as $k): ?>
                                    <option value="<?= $k->id_kcb ?>"><?= $k->nama_kcb ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <?php else: ?>
                            <div class="form-group"><label>Kantor Cabang</label>
                                <input type="hidden" name="kcb">
                                <div class="d-sm-flex justify-content-between">
                                    <span class="text-danger"><i>(Belum Ada Data Kantor Cabang !)</i></span>
                                    <a href="<?= base_url() ?>kcb" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Jumlah Barang -->
                            <div class="form-group"><label>Jumlah Keluar</label>
                                <input class="form-control" name="jmlbarang" id="jmlbarang" type="number" placeholder="" value="">
                            </div>

                            <!-- Total -->
                            <div class="form-group"><label>Total Nominal</label>
                                <input class="form-control" name="total" id="total" type="number" placeholder="" value="" readonly>
                            </div>

                        </div>


                        <br>
                    </div>
                </div>

            </div>

            <div class="col-lg-7 mb-4">
                <!-- file -->
                <div class="card border-bottom-primary shadow mb-2">
                    <a href="<?= base_url() ?>barangKeluar/tambah" ></a>
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Data Barang</h6>
                    </div>
                    <div class="card-body">
                        <table class="table" id="dtHorizontalExample" >
                        <thead>
                            <tr>
                                <th width="1%">Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Harga Barang</th>
                                <th>Stok Barang</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php  foreach ($bm as $bm): ?>
                            <tr>
                                <td><?= tgl_indo($bm->tgl_masuk) ?></td>
                                <td><?= $bm->nama_barang ?></td>
                                <td>Rp. <?= $bm->harga ?></td>
                                <td><?= $bm->stok ?></td>
                                
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div> 

                <!--<div class="card border-bottom-primary shadow mb-4">
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Detail Barang</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">

                            <center>
                                <img id="preview" width="150px" src="<?= base_url() ?>assets/upload/barang/box.png"
                                    alt="">
                            </center>
                            <label><b>Nama Barang</b></label>
                            <h6 class="h6 text-gray-800" id="judul">-</h6>
                            
                            <hr class="sidebar-divider">

                            <label><b>Stok Barang</b></label>
                            <h6 class="h6 text-gray-800" id="stok">-</h6>
                            
                            <hr class="sidebar-divider">


                        </div>
                    </div>
                </div>-->

            </div>
        </div>


    </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/barangKeluar.js"></script>
<script src="<?= base_url(); ?>assets/js/validasi/formbarangkeluar.js"></script>
<script src="<?= base_url(); ?>assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/plugin/chosen/chosen.jquery.min.js"></script>

<script type="text/javascript">
    $("#harga").keyup(function(){
        var a = parseInt($("#harga").val());
        var b = parseInt($("#jmlbarang").val());
        var c = a*b;
        $("#total").val(c);
    });

    $("#jmlbarang").keyup(function(){
        var a = parseInt($("#harga").val());
        var b = parseInt($("#jmlbarang").val());
        var c = a*b;
        $("#total").val(c);
    });
</script>

<script>
$('.chosen').chosen({
    width: '100%',

});

$('#datepicker').datepicker({
    autoclose: true
});
</script>

<?php if($this->session->flashdata('Pesan')): ?>

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