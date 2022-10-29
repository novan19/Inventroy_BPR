<?php foreach($data as $d): ?>
<?php
function format($tanggal){
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[1] . '/' . $pecahkan[2] . '/' . $pecahkan[0];
}
?> 

<!-- Begin Page Content -->
<div class="container-fluid"> 

    <form action="<?= base_url() ?>barangMasuk/proses_ubah" name="myForm" method="POST" enctype="multipart/form-data"
        onsubmit="return validateForm()"> 


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="d-sm-flex">
                <a href="<?= base_url() ?>barang_masuk" class="btn btn-md btn-circle btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
                &nbsp;
                <h1 class="h2 mb-0 text-gray-800">Ubah Barang Masuk</h1>
            </div>

            

            <button type="submit" class="btn btn-success btn-md btn-icon-split">
                <span class="text text-white">Simpan Perubahan</span>
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
            </button>

        </div>

        <div class="d-sm-flex  justify-content-between mb-0">
            <div class="col-lg-6 mb-4">
                <!-- form -->
                <div class="card border-bottom-secondary shadow mb-4">
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Form Barang Masuk</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">

                            <!-- ID Transaksi -->
                            <div class="form-group"><label>ID Barang Masuk</label>
                                <input class="form-control" name="idbm" value="<?= $d->id_barang_masuk ?>" type="text"
                                    placeholder="" autocomplete="off" readonly>
                            </div>

                            <!-- Barang -->
                            <div class="form-group"><label>Nama Barang</label>
                                <input name="barang" type="hidden" value="<?= $d->id_barang ?>">
                                <input class="form-control" name="preview" type="text" value="<?= $d->nama_barang ?>"
                                    autocomplete="off" readonly>
                            </div>

                            <!-- Tgl Masuk -->
                            <div class="form-group"><label>Tanggal Masuk</label>
                                <input class="form-control" name="tgl" id="datepicker" value="<?= format($d->tgl_masuk) ?>"
                                    type="text" placeholder="" autocomplete="off">
                            </div>

                            <!-- opsi Supplier -->
                            <?php if($jmlsupplier > 0): ?>
                            <div class="form-group"><label>Supplier</label>
                                <select name="supplier" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($supplier as $s): ?>

                                    <?php if($d->id_supplier == $s->id_supplier): ?>
                                    <option value="<?= $s->id_supplier ?>" selected><?= $s->nama_supplier ?></option>
                                    <?php else: ?>
                                    <option value="<?= $s->id_supplier ?>"><?= $s->nama_supplier ?></option>
                                    <?php endif; ?>

                                    <?php endforeach ?>
                                </select>
                            </div>
                            <?php else: ?>
                            <div class="form-group"><label>Supplier</label>
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
                                <input class="form-control" name="total1" id="total1" type="number" placeholder="" value="<?= $d->total ?>" >
                            </div>

                            <!-- Harga -->
                            <div class="form-group"><label>Total Harga Barang Bulan Sebelumnya</label>
                                <input class="form-control" name="total" id="total" type="number" placeholder="" value="" >
                            </div>

                            <!-- Stok Barang -->
                            <div class="form-group"><label>Stok Barang</label>
                                <input class="form-control" name="stok" id="stok" type="number" placeholder="" value="<?= $d->stok ?>">
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="form-group"><label>Jumlah Masuk</label>
                                <input name="jmlmasuklama" type="hidden" value="<?= $d->jumlah_masuk ?>">
                                <input class="form-control" id="jmlmasuk" name="jmlmasuk" type="number"
                                    value="<?= $d->jumlah_masuk ?>">
                            </div>

                            <!-- Total Harga Barang -->
                            <div class="form-group"><label>Harga Barang</label>
                                <input class="form-control" name="harga" id="harga" type="number" placeholder="" value="<?= $d->harga ?>" readonly>
                            </div>

                        </div>


                        <br>
                    </div>
                </div>

            </div>

             <div class="col-lg-7 mb-4">
                
               <!-- <div class="card border-bottom-secondary shadow mb-4">
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Preview</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">

                            <center>
                                <img id="preview" width="200px"
                                    src="<?= base_url() ?>assets/upload/barang/<?= $d->foto ?>" alt="">
                            </center>

                            <br>

                            <label><b>Nama Barang</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="judul"><?= $d->nama_barang ?></h6>
                            
                            <hr class="sidebar-divider">

                            <label><b>Stok Barang</b></label>
                            <br>
                            <h6 class="h6 text-gray-800" id="stok"><?= $d->stok ?></h6>
                           
                            <hr class="sidebar-divider">


                        </div>
                    </div>
                </div>file -->

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
        $("#harga").val(e);
    });

    $("#jmlmasuk").keyup(function(){
        var a = parseInt($("#total").val());
        var b = parseInt($("#total1").val());
        var c = parseInt($("#stok").val());
        var d = parseInt($("#jmlmasuk").val());
        var e = ((a+b)/(c+d));
        $("#harga").val(e);
    });
    $("#total1").keyup(function(){
        var a = parseInt($("#total").val());
        var b = parseInt($("#total1").val());
        var c = parseInt($("#stok").val());
        var d = parseInt($("#jmlmasuk").val());
        var e = ((a+b)/(c+d));
        $("#harga").val(e);
    });

    $("#stok").keyup(function(){
        var a = parseInt($("#harga").val());
        var b = parseInt($("#harga1").val());
        var c = parseInt($("#stok").val());
        var d = parseInt($("#jmlmasuk").val());
        var e = ((a+b)/(c+d));
        $("#harga").val(e);
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

<?php endforeach; ?>