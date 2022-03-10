<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Pendaftaran User Baru';
        $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function registration()
    {

        $this->form_validation->set_rules('NPP', 'NPP', 'required|trim|is_unique[user.NPP]', [
            'is_unique' => 'Nomor NPP ini sudah terdaftar!!'
        ]);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password harus sama!!',
            'min_length' => 'Password minimal 8 character'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi Peminjam Kendaraan';
            $data['user'] = $this->db->get_where('user', ['NPP' => $this->session->userdata('NPP')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index');
            $this->load->view('templates/footer');
        } else {
            $data = [

                'NPP' => htmlspecialchars($this->input->post('NPP', true)),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()


            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun anda berhasil didaftarkan. Silakan Login!!!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin');
        }
    }
}
