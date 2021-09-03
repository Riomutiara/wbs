<?php
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        // $data['title'] = 'WBS |';
        // $data['title2'] = 'Dashboard';
        // $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/topbar', $data);
        // $this->load->view('templates/topbar_menu', $data);
        $this->load->view('admin/index');
        // $this->load->view('templates/footer');
    }
} //End Class
