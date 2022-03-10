<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Added extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_model');
    }

    public function index()
    {
        $data['title'] = 'Daftar Pinjaman';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();

        $data['pinjam'] = $this->db->get('form')->result_array();
        $data['form_pinjam'] = $this->db->get('form_pinjam')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('added/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->Data_model->hapusDataPinjaman($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan berhasil dihapus!!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
		<span aria-hidden="true">&times;</span>
		</button></div>');
        redirect('added');
    }

    function cetak($id)
    {
        $where = array('form_id' => $id);
        $data['view_Mlaporan'] = $this->Data_model->cetak_laporan($where, 'form')->result();
        $data['view_Dlaporan'] = $this->Data_model->cetak_laporan($where, 'form_pinjam')->result();
        $this->load->view('PrintLaporan', $data);
    }

    public function laporan()
    {
        $data['title'] = 'Daftar Laporan';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();

        $data['form_pinjam'] = $this->db->get('form_pinjam')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('added/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function pengembalian()
    {
        $data['title'] = 'Daftar Laporan';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();

        $data['form_pinjam'] = $this->db->get('form_pinjam')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('added/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function export_excel()
    {

        $data['form_pinjam'] = $this->db->get('form_pinjam')->result_array();

        $objectPHPExcel = new Spreadsheet();

        $objectPHPExcel->getProperties()->setCreator('Admin')
            ->setLastModifiedBy('Admin')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('')
            ->setKeywords('')
            ->setCategory('');

        $objectPHPExcel->setActiveSheetIndex(0);

        $objectPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
        $objectPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama Peminjam');
        $objectPHPExcel->getActiveSheet()->setCellValue('C1', 'NPP');
        $objectPHPExcel->getActiveSheet()->setCellValue('D1', 'Unit Kerja');
        $objectPHPExcel->getActiveSheet()->setCellValue('E1', 'Keperluan/Tujuan');
        $objectPHPExcel->getActiveSheet()->setCellValue('F1', 'Tanggal Jalan');
        $objectPHPExcel->getActiveSheet()->setCellValue('G1', 'Tanggal Kembali');
        $objectPHPExcel->getActiveSheet()->setCellValue('H1', 'Plat Nomor');
        $objectPHPExcel->getActiveSheet()->setCellValue('I1', 'Driver');
        $objectPHPExcel->getActiveSheet()->setCellValue('j1', 'Kondisi');

        $baris = 2;
        $x = 1;

        foreach ($data['form_pinjam'] as $d) {
            $objectPHPExcel->getActiveSheet()->setCellValue('A' . $baris, $x);
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . $baris, $d['name']);
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . $baris, $d['NPP']);
            $objectPHPExcel->getActiveSheet()->setCellValue('D' . $baris, $d['unit_kerja']);
            $objectPHPExcel->getActiveSheet()->setCellValue('E' . $baris, $d['tujuan']);
            $objectPHPExcel->getActiveSheet()->setCellValue('F' . $baris, $d['start']);
            $objectPHPExcel->getActiveSheet()->setCellValue('G' . $baris, $d['end']);
            $objectPHPExcel->getActiveSheet()->setCellValue('H' . $baris, $d['no_polisi']);
            $objectPHPExcel->getActiveSheet()->setCellValue('I' . $baris, $d['driver']);
            $objectPHPExcel->getActiveSheet()->setCellValue('k' . $baris, $d['ket']);

            $x++;
            $baris++;
        }

        $writer = IOFactory::createWriter($objectPHPExcel, 'Xlsx');
        ob_end_clean();

        $filename = "Data Peminjaman Kendaraan" . date("d-m-Y") . '.xlsx';

        $objectPHPExcel->getActiveSheet()->setTitle("Data Peminjaman Kendaraan");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');


        $writer->save('php://output');

        exit;
    }

    public function deleteForm($id)
    {
        $this->Data_model->hapusFormPinjam($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Formulir berhasil dihapus!!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
		<span aria-hidden="true">&times;</span>
		</button></div>');
        redirect('added/laporan');
    }

    public function chat($id)
    {
        $data['title'] = 'Chat Driver';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer');
        $this->Data_model->kirimWA($id);
    }
}
