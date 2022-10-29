<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); 
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
        $this->load->model('barang_model');
        $this->load->model('barangKeluar_model');
      }

  public function barang_pdf()
    {
      $tglawal = $this->input->post('tglawal');
      $tglakhir = $this->input->post('tglakhir');

      if($tglawal != '' && $tglakhir != ''){
        $data['data'] = $this->barang_model->lapdata($tglawal, $tglakhir)->result();
      }
      else{
        $data['data'] = $this->barang_model->dataJoin()->result();
      }
 
      $data['tglawal'] = $tglawal;
      $data['tglakhir'] = $tglakhir;

      $data['judul'] = 'Laporan Data Barang';
      $mpdf = new \Mpdf\Mpdf();
      $html = $this->load->view('laporan/barang_pdf',$data,true);
      $mpdf->WriteHTML($html);
      $tgl = date('Ymd_his');
      $namaFile = 'Barang_'.$tgl.'.pdf';
      $mpdf->Output($namaFile, 'D');

    }

    public function barang_excel()
    {

    $data = $this->barang_model->dataJoin()->result();
    
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'No');
      $sheet->setCellValue('B1', 'ID Barang');
      $sheet->setCellValue('C1', 'Nama Barang');
      $sheet->setCellValue('D1', 'Kategori Barang');
      $sheet->setCellValue('E1', 'Satuan Barang');

      $column= 2;
      foreach ($data as $key => $value) {
        $sheet->setCellValue('A'.$column, ($column-1));
        $sheet->setCellValue('B'.$column, $value->id_barang);
        $sheet->setCellValue('C'.$column, $value->nama_barang);
        $sheet->setCellValue('D'.$column, $value->kategori_barang);
        $sheet->setCellValue('E'.$column, $value->nama_satuan);
        $column++;
      }

      $sheet->getStyle('A1:E1')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('ffff00');
      $styleArray = [
        'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
              'color' => ['argb' => 'ff0000'],
            ],
          ],
        ];
        $sheet->getStyle('A1:E'.($column-1))->applyFromArray($styleArray);

      $sheet->getColumnDimension('A')->setAutoSize(true);
      $sheet->getColumnDimension('B')->setAutoSize(true);
      $sheet->getColumnDimension('C')->setAutoSize(true);
      $sheet->getColumnDimension('D')->setAutoSize(true);
      $sheet->getColumnDimension('E')->setAutoSize(true);
      

      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename=barang.xlsx');
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
      exit();

    }
}