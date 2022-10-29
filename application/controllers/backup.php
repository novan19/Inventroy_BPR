<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {


    public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('download');
    $this->load->library('pagination');
    $this->load->helper('cookie');
    $this->load->model('restore_model');

  }
    
    public function index()
    {
        $data['title'] = 'Backup & Restore Data';
        

        $this->load->view('templates/header', $data);
        $this->load->view('backup/index');
        $this->load->view('templates/footer');
        
    }

    public function backup(){
        $this->load->dbutil();
        $this->load->helper('download');
        $dateFormat = date('d - m - Y');

        $config = [
            'format' => 'zip',
            'filename' => 'Backup Database - '.$dateFormat.'.sql',
            'add_drop' => TRUE,
            'add_insert' => TRUE,
            'newline' => "\n",
            'foreign_key_checks' => FALSE
        ];

        $backup =& $this->dbutil->backup($config);
        $dbName = 'Backup Database - '.$dateFormat.'.zip';
        force_download($dbName, $backup);
    }

}

/* End of file Backup.php */
