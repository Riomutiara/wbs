<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required', ['required' => 'Username wajib diisi.']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Password wajib diisi.']);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login';
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        // $ruangan = $this->db->get_where('ruangan_user', ['id_user_details' => $user['id_user_detail']])->row_array();
        // $submenu = $this->db->get_where('user_access_submenu', ['id_user_detail' => $user['id_user_detail']])->row_array();
        // $submenu2 = $this->db->get_where('user_sub_menu', ['id_submenu' => $submenu['id_submenu']])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        // 'role_id' => $user['role_id'],
                        'id_user_detail' => $user['id_user_detail'],
                        // 'id_ruangan' => $ruangan['id_ruangan'],
                        // 'id_submenu' => $submenu2['id_submenu']
                    ];
                    $this->session->set_userdata($data);
                    // if ($user['role_id'] == 1) {
                    //     redirect('master');
                    // }
                    // if ($user['role_id'] == 2) {
                    redirect('admin');
                    // } else {
                    //     redirect('user');
                    //     // redirect('' . $submenu2['url'] . '');
                    // }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password Anda Salah.!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    User Tidak Aktif.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>'
                );
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            User tidak terdaftar.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        <h3 class="text-success"><i class="fa fa-exclamation-triangle"></i> Success</h3> Anda Berhasil Logout!
    </div>');

        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = 'Akses tidak dizinkan';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('auth/blocked', $data);
    }
}
