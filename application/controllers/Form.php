<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_model');
    }

    public function index()
    {
        $data['title'] = 'Form Peminjaman Mobil';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('NPP', 'NPP', 'required');
        $this->form_validation->set_rules('unit_kerja', 'Unit Kerja', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
        $this->form_validation->set_rules('start', 'start', 'required');
        $this->form_validation->set_rules('end', 'end', 'required');

        if ($this->form_validation->run() == false) {
            $data['form'] = $this->db->get('form')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('form/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('nama', true)),
                'NPP' => htmlspecialchars($this->input->post('NPP', true)),
                'unit_kerja' => htmlspecialchars($this->input->post('unit_kerja', true)),
                'tujuan' => htmlspecialchars($this->input->post('tujuan', true)),
                'start' => htmlspecialchars($this->input->post('start', true)),
                'end' => htmlspecialchars($this->input->post('end', true))
            ];

            $this->db->insert('form', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Form anda telah terdaftar!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('form');
        }
    }


    public function form2($id)
    {

        $data['title'] = 'Form konfirmasi';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();
        $data['input'] = $this->Data_model->getFormById($id);
        $data['nopol'] = $this->Data_model->getAllNopol();


        $this->form_validation->set_rules('no_polisi', 'No Polisi', 'required');
        $this->form_validation->set_rules('driver', 'Driver', 'required');


        if ($this->form_validation->run() == false) {
            $data['form'] = $this->db->get('form')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('form/form2', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Data_model->konfirmasi();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Form telah dikonfirmasi!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('added');
        }
    }

    public function form3($id)
    {

        $data['title'] = 'Form konfirmasi';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();
        $data['input'] = $this->Data_model->getFormPById($id);
        $data['nopol'] = $this->Data_model->getAllNopol();

        $this->form_validation->set_rules('ket', 'ket', 'required');

        if ($this->form_validation->run() == false) {
            $data['form'] = $this->db->get('form')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('form/form3', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Data_model->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengembalian telah dikonfirmasi!!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('added/laporan');
        }
    }
}
