<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Restore extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('restore_model', 'mrestore');

        date_default_timezone_set('Asia/Jakarta');
    }
     
    public function restore()
    {
        $this->mrestore->dropTable();

        // upload ur file
        $fileUpload = $_FILES['datafile'];
        $fileName = $_FILES['datafile']['name'];

        if (isset($fileUpload)){
            $fileLocated = $fileUpload['tmp_name'];
            $directory = "backupdb/$fileName";
            move_uploaded_file($fileLocated, "$directory");
        }

        // restoring database
        $fileIsi = file_get_contents($directory);
        $string_query = rtrim($fileIsi, "\n;");
        $array_query = explode(";", $string_query);

        foreach($array_query as $query){
            $this->db->query($query);
        }

        unlink($directory);

        echo "<script>alert('Berhasil!');</script>";
        redirect('backup','refresh');
    }

}

/* End of file Restore.php */
