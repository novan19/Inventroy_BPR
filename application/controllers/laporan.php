<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
        $this->load->model('barangMasuk_model');
        $this->load->model('barangKeluar_model');
      }

  public function barang_masuk_excel()
    {

    $data = $this->barangMasuk_model->dataJoin()->result();
    
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'No');
      $sheet->setCellValue('B1', 'Tgl Masuk');
      $sheet->setCellValue('C1', 'No Transaksi');
      $sheet->setCellValue('D1', 'Supplier');
      $sheet->setCellValue('E1', 'Nama Barang');
      $sheet->setCellValue('F1', 'Stok Barang');
      $sheet->setCellValue('G1', 'Harga Barang');
      $sheet->setCellValue('H1', 'Jumlah Masuk');
      $sheet->setCellValue('I1', 'Total Nominal');

      $column= 2;
      foreach ($data as $key => $value) {
        $sheet->setCellValue('A'.$column, ($column-1));
        $sheet->setCellValue('B'.$column, $value->tgl_masuk);
        $sheet->setCellValue('C'.$column, $value->id_barang_masuk);
        $sheet->setCellValue('D'.$column, $value->nama_supplier);
        $sheet->setCellValue('E'.$column, $value->nama_barang);
        $sheet->setCellValue('F'.$column, $value->harga);
        $sheet->setCellValue('G'.$column, $value->stok);
        $sheet->setCellValue('H'.$column, $value->jumlah_masuk);
        $sheet->setCellValue('I'.$column, $value->total);
        $column++;
      }

      $sheet->getStyle('A1:I1')->getFill()
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
        $sheet->getStyle('A1:I'.($column-1))->applyFromArray($styleArray);

      $sheet->getColumnDimension('A')->setAutoSize(true);
      $sheet->getColumnDimension('B')->setAutoSize(true);
      $sheet->getColumnDimension('C')->setAutoSize(true);
      $sheet->getColumnDimension('D')->setAutoSize(true);
      $sheet->getColumnDimension('E')->setAutoSize(true);
      $sheet->getColumnDimension('F')->setAutoSize(true);
      $sheet->getColumnDimension('G')->setAutoSize(true);
      $sheet->getColumnDimension('H')->setAutoSize(true);
      $sheet->getColumnDimension('I')->setAutoSize(true);

      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename=barangmasuk.xlsx');
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
      exit();

    }

    public function barang_keluar_excel()
    {

    $data = $this->barangKeluar_model->dataJoin()->result();
    
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'No');
      $sheet->setCellValue('B1', 'Tgl Keluar');
      $sheet->setCellValue('C1', 'No Transaksi');
      $sheet->setCellValue('D1', 'Kantor Cabang');
      $sheet->setCellValue('E1', 'Nama Barang');
      $sheet->setCellValue('F1', 'Harga Barang');
      $sheet->setCellValue('G1', 'Jumlah Keluar');
      $sheet->setCellValue('H1', 'Total Nominal');

      $column= 2;
      foreach ($data as $key => $value) {
        $sheet->setCellValue('A'.$column, ($column-1));
        $sheet->setCellValue('B'.$column, $value->tgl_keluar);
        $sheet->setCellValue('C'.$column, $value->id_barang_keluar);
        $sheet->setCellValue('D'.$column, $value->nama_kcb);
        $sheet->setCellValue('E'.$column, $value->nama_barang);
        $sheet->setCellValue('F'.$column, $value->harga);
        $sheet->setCellValue('G'.$column, $value->jumlah_keluar);
        $sheet->setCellValue('H'.$column, $value->total);
        $column++;
      }

      $sheet->getStyle('A1:H1')->getFill()
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
        $sheet->getStyle('A1:H'.($column-1))->applyFromArray($styleArray);

      $sheet->getColumnDimension('A')->setAutoSize(true);
      $sheet->getColumnDimension('B')->setAutoSize(true);
      $sheet->getColumnDimension('C')->setAutoSize(true);
      $sheet->getColumnDimension('D')->setAutoSize(true);
      $sheet->getColumnDimension('E')->setAutoSize(true);
      $sheet->getColumnDimension('F')->setAutoSize(true);
      $sheet->getColumnDimension('G')->setAutoSize(true);
      $sheet->getColumnDimension('H')->setAutoSize(true);

      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename=barangkeluar.xlsx');
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
      exit();

    }

    public function barang_masuk_pdf()
    {
      $tglawal = $this->input->post('tglawal');
      $tglakhir = $this->input->post('tglakhir');

      if($tglawal != '' && $tglakhir != ''){
        $data['data'] = $this->barangMasuk_model->lapdata($tglawal, $tglakhir)->result();
      }
      else{
        $data['data'] = $this->barangMasuk_model->dataJoin()->result();
      }

      $data['tglawal'] = $tglawal;
      $data['tglakhir'] = $tglakhir;

      $data['judul'] = 'Laporan Barang Masuk';
      $mpdf = new \Mpdf\Mpdf();
      $html = $this->load->view('laporan/barang_masuk_pdf',$data,true);
      $mpdf->WriteHTML($html);
      $tgl = date('Ymd_his');
      $namaFile = 'Barang_masuk_'.$tgl.'.pdf';
      $mpdf->Output($namaFile, 'D');

    }

    public function barang_keluar_pdf()
    {
      $tglawal = $this->input->post('tglawal');
      $tglakhir = $this->input->post('tglakhir');

      if($tglawal != '' && $tglakhir != ''){
        $data['data'] = $this->barangKeluar_model->lapdata($tglawal, $tglakhir)->result();
      }
      else{
        $data['data'] = $this->barangKeluar_model->dataJoin()->result();
      }

      $data['tglawal'] = $tglawal;
      $data['tglakhir'] = $tglakhir;

      $data['judul'] = 'Laporan Barang Keluar';
      $mpdf = new \Mpdf\Mpdf();
      $html = $this->load->view('laporan/barang_keluar_pdf',$data,true);
      $mpdf->WriteHTML($html);
      $tgl = date('Ymd_his');
      $namaFile = 'Barang_keluar_'.$tgl.'.pdf';
      $mpdf->Output($namaFile, 'D');

    }



}