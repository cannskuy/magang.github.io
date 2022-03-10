<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index()
	{
		if ($this->session->userdata('NPP')) {
			redirect('user');
		}

		$this->form_validation->set_rules('NPP', 'NPP', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login Page';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}
	}

	public function tes()
	{

			$data['title'] = 'Regis Page';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('admin/tes');
			$this->load->view('templates/auth_footer');

	}

	private function _login()
	{
		$NPP = $this->input->post('NPP');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['NPP' => $NPP])->row_array();
		if ($user) {
			//  check user aktif
			if ($user['is_active'] == 1) {
				//check password
				if (password_verify($password, $user['password'])) {
					$data = [
						'NPP' => $user['NPP'],
						'role_id' => $user['role_id']
					];

					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('admin');
					} else {
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang anda masukan salah
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
					<span aria-hidden="true">&times;</span>
					</button></div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NPP anda belum aktif, Silakan aktifasi!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
				<span aria-hidden="true">&times;</span>
				</button></div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NPP anda belum terdaftar, Silakan daftar!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
            </button></div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('NPP');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil Logout!!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
		<span aria-hidden="true">&times;</span>
		</button></div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}

	public function registration()
    {


            $data = [

                'NPP' => htmlspecialchars($this->input->post('NPP', true)),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'email' => htmlspecialchars($this->input->post('no_hp', true)),
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
            redirect('auth');
        
    }
}
