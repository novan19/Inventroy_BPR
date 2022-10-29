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

    <form action="<?= base_url() ?>barangMasuk/proses_tambah" name="myForm" method="POST" enctype="multipart/form-data"
        onsubmit="return validateForm()">
 

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="d-sm-flex">
                <a href="<?= base_url() ?>barang_masuk" class="btn btn-md btn-circle btn-secondary">
                    <i class="fas fa-arrow-left"></i> 
                </a>
                &nbsp;
                <h1 class="h2 mb-0 text-gray-800">Tambah Barang Masuk</h1>
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
                <div class="card border-bottom-primary shadow mb-4">
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Form Barang Masuk</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">

                            <!-- ID Transaksi -->
                            <div class="form-group"><label>ID Barang Masuk</label>
                                <input class="form-control" name="idbm" value="<?= $kode ?>" type="text" placeholder=""
                                    autocomplete="off" readonly>
                            </div>

                            <!-- Tgl Masuk -->
                            <div class="form-group"><label>Tanggal Masuk</label>
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
                                </select><br>
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
 
                            <!-- opsi Supplier --> 
                            <?php if($jmlsupplier > 0): ?>
                            <div class="form-group"><label>Pemasok</label>
                                <select name="supplier" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($supplier as $s): ?>
                                    <option value="<?= $s->id_supplier ?>"><?= $s->nama_supplier ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <?php else: ?>
                            <div class="form-group"><label>Pemasok</label>
                                <input type="hidden" name="supplier">
                                <div class="d-sm-flex justify-content-between">
                                    <span class="text-danger"><i>(Belum Ada Data supplier!)</i></span>
                                    <a href="<?= base_url() ?>supplier" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Harga -->
                            <div class="form-group"><label>Total Harga Barang</label>
                                <input class="form-control" name="total1" id="total1" type="number" placeholder="" value="" >
                            </div>

                            <!-- Harga -->
                            <div class="form-group"><label>Total Harga Barang Bulan Sebelumnya</label>
                                <input class="form-control" name="total" id="total" type="number" placeholder="" value="" >
                            </div>

                            <!-- Stok Barang -->
                            <div class="form-group"><label>Stok Barang</label>
                                <input class="form-control" name="stok" id="stok" type="number" placeholder="" value="">
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="form-group"><label>Jumlah Masuk</label>
                                <input class="form-control" name="jmlmasuk" id="jmlmasuk" type="number" placeholder="" value="">
                            </div>

                            <!-- Total Harga Barang -->
                            <div class="form-group"><label>Harga Barang</label>
                                <input class="form-control" name="harga" id="harga" type="number" placeholder="" value="" readonly>
                            </div>

                            

                        </div>


                        <br>
                    </div>
                </div>

            </div>

            <div class="col-lg-7 mb-4">
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
 <!-- file
                <div class="card border-bottom-primary shadow ">
                    <div class="card-header py-2 bg-secondary">
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
<script src="<?= base_url(); ?>assets/js/barangMasuk.js"></script>
<script src="<?= base_url(); ?>assets/js/validasi/formbarangmasuk.js"></script>
<script src="<?= base_url(); ?>assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/plugin/chosen/chosen.jquery.min.js"></script>

<script type="text/javascript">
    $("#total").keyup(function(){
        var a = parseInt($("#total").val());
        var b = parseInt($("#total1").val());
        var c = parseInt($("#stok").val());
        var d = parseInt($("#jmlmasuk").val());
        var e = ((a+b)/(c+d));
        $("#harga").val(e.toFixed(0));
    });

    $("#jmlmasuk").keyup(function(){
        var a = parseInt($("#total").val());
        var b = parseInt($("#total1").val());
        var c = parseInt($("#stok").val());
        var d = parseInt($("#jmlmasuk").val());
        var e = ((a+b)/(c+d));
        $("#harga").val(e.toFixed(0));
    });
    $("#total1").keyup(function(){
        var a = parseInt($("#total").val());
        var b = parseInt($("#total1").val());
        var c = parseInt($("#stok").val());
        var d = parseInt($("#jmlmasuk").val());
        var e = ((a+b)/(c+d));
        $("#harga").val(e.toFixed(0));
    });

    $("#stok").keyup(function(){
        var a = parseInt($("#harga").val());
        var b = parseInt($("#harga1").val());
        var c = parseInt($("#stok").val());
        var d = parseInt($("#jmlmasuk").val());
        var e = ((a+b)/(c+d));
        $("#harga").val(e.toFixed(0));
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