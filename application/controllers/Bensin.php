<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Bensin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_model');
    }

    public function index()
    {
        $data['title'] = 'Form BBM';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();
        $data['nopol'] = $this->Data_model->getAllNopol();

        $this->form_validation->set_rules('no_polisi', 'Plat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        if ($this->form_validation->run() == false) {
            $data['bensin'] = $this->db->get('bensin')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bensin/index', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->from('bensin');
            $this->db->order_by('id', 'desc');
            $transaksiTerakhir = $this->db->get()->row();
            $saldoTerakhir = $transaksiTerakhir->saldo;

            $data = [
                'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                'plat' => htmlspecialchars($this->input->post('no_polisi', true)),
                'masuk' => '-',
                'harga' => htmlspecialchars($this->input->post('harga', true)),
                'saldo' => $saldoTerakhir - htmlspecialchars($this->input->post('harga', true))
            ];

            $this->db->insert('bensin', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Form anda telah berhasil dibuat!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('bensin/addbensin');
        }
    }

    public function deposit()
    {
        $data['title'] = 'Deposit';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('masuk', 'Deposit', 'required');

        if ($this->form_validation->run() == false) {
            $data['bensin'] = $this->db->get('bensin')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bensin/deposit', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->from('bensin');
            $this->db->order_by('id', 'desc');
            $transaksiTerakhir = $this->db->get()->row();
            $saldoTerakhir = $transaksiTerakhir->saldo;

            $data = [
                'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                'plat' => '-',
                'masuk' => htmlspecialchars($this->input->post('masuk', true)),
                'harga' => '-',
                'saldo' => $saldoTerakhir + htmlspecialchars($this->input->post('masuk', true))
            ];

            $this->db->insert('bensin', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Form anda telah berhasil dibuat!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('bensin/addbensin');
        }
    }

    public function addbensin()
    {
        $data['title'] = 'Daftar Laporan BBM';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();


        $data['bensin'] = $this->db->get('bensin')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bensin/addbensin', $data);
        $this->load->view('templates/footer');
    }

    public function export_excel()
    {

        $data['bensin'] = $this->db->get('bensin')->result_array();

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
        $objectPHPExcel->getActiveSheet()->setCellValue('B1', 'Tanggal');
        $objectPHPExcel->getActiveSheet()->setCellValue('C1', 'No Polisi');
        $objectPHPExcel->getActiveSheet()->setCellValue('D1', 'Pembelian');
        $objectPHPExcel->getActiveSheet()->setCellValue('E1', 'Pemakaian');
        $objectPHPExcel->getActiveSheet()->setCellValue('F1', 'Saldo');

        $baris = 2;
        $x = 1;

        foreach ($data['bensin'] as $d) {
            $objectPHPExcel->getActiveSheet()->setCellValue('A' . $baris, $x);
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . $baris, $d['tanggal']);
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . $baris, $d['plat']);
            $objectPHPExcel->getActiveSheet()->setCellValue('D' . $baris, $d['masuk']);
            $objectPHPExcel->getActiveSheet()->setCellValue('E' . $baris, $d['harga']);
            $objectPHPExcel->getActiveSheet()->setCellValue('F' . $baris, $d['saldo']);

            $x++;
            $baris++;
        }

        $writer = IOFactory::createWriter($objectPHPExcel, 'Xlsx');
        ob_end_clean();

        $filename = "Daftar Laporan BBM" . date("d-m-Y") . '.xlsx';

        $objectPHPExcel->getActiveSheet()->setTitle("Daftar Laporan BBM");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');


        $writer->save('php://output');

        exit;
    }

    public function delete($id)
    {
        $this->Data_model->hapusDataLaporan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan berhasil dihapus!!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
		<span aria-hidden="true">&times;</span>
		</button></div>');
        redirect('bensin/addbensin');
    }
}
