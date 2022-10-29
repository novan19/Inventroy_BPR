
<body> 
<br>
    <head>
        <h1><center>Backup Data </center></h1>
    </head>
    <br>
    <div class="d-sm-flex align-items-center justify-content-between ml-5 mr-5 mb-4">
        <a href="<?= base_url();?>Backup/backup" title="Backup Database" class="btn btn-success btn-block" >
            <i class="fas fa-print"></i> Backup Data
        </a>
    </div>
<br>
    <head>
        <h1><center>Restore Data </center></h1>
    </head>
<br>
    <form action="<?= base_url(); ?>restore/restore" method="POST" enctype="multipart/form-data">
       <center> <input type="file" name="datafile" title="Pilih File"><br><br>
        <div class="d-sm-flex align-items-center justify-content-between ml-5 mr-5 mb-4">
        <input type="submit" class="btn btn-success btn-block" value="Klik untuk Restore"></center></div>
    </form>
</body>

<!-- End of Main Content -->

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/backup.js"></script>
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