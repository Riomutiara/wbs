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
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function tabelUsulanJabatan()
    {
        $fetch_data = $this->Admin_model->make_datatables_usulan_jabatan();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = '<div>' . $row->nama_pegawai . ' <br>
                                 ' . $row->nip . ' <br>                                                                 
                                 </div>';
            $sub_array[] = $row->nama_bidang;
            $sub_array[] = $row->nama_jabatan;
            if ($row->status_riwayat_jabatan == 0) {
                $sub_array[] = '<span class="badge badge-warning">Usulan</span>';
            } elseif ($row->status_riwayat_jabatan == 1) {
                $sub_array[] = '<span class="badge badge-success">Aktif</span>';
            }elseif ($row->status_riwayat_jabatan == 2) {
                $sub_array[] = '<span class="badge badge-secondary">Non-aktif</span>';
            }elseif ($row->status_riwayat_jabatan == 3) {
                $sub_array[] = '<span class="badge badge-danger">Ditolak</span>';
            }
            $sub_array[] = '<a href="#" class="verifikasi_usulan mr-1" id="' . $row->id_riwayat_jabatan . '" data-toggle="tooltip" title="Verifikasi"> <i class="fa fa-check"></i> </a>
            <a href="#" class="tolak_usulan text-danger mr-1" id="' . $row->id_riwayat_jabatan . '" data-toggle="tooltip" title="Tolak"> <i class="fa fa-times"></i> </a>
            <a href="#" class="non_aktif_usulan text-warning" id="' . $row->id_riwayat_jabatan . '" data-toggle="tooltip" title="Non-aktifkan"> <i class="fa fa-lock"></i> </a>';

            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Admin_model->get_all_data_usulan_jabatan(),
            "recordsFiltered"     => $this->Admin_model->get_filtered_data_usulan_jabatan(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function verifikasiUsulanJabatan()
    {
        $data = array(
            'status_riwayat_jabatan' => 1,
        );
        $this->Admin_model->verifikasi_usulan_jabatan($_POST['id'], $data);
        echo 'Usulan Jabatan berhasil diverifikasi!';
    }
    
    public function tolakUsulanJabatan()
    {
        $data = array(
            'status_riwayat_jabatan' => 3,
        );
        $this->Admin_model->tolak_usulan_jabatan($_POST['id'], $data);
        echo 'Jabatan berhasil ditolak!';
    }

    public function nonAktifUsulan()
    {
        $data = array(
            'status_riwayat_jabatan' => 2,
        );
        $this->Admin_model->non_aktif_usulan($_POST['id'], $data);
        echo 'Jabatan berhasil dinon-aktifkan!';
    }

    public function fetchUsulanJabatan()
    {
        $output = array();
        $data = $this->Admin_model->fetch_single_usulan_jabatan($_POST['id']);

        foreach ($data as $row) {
            $output['nip'] = $row->nip;
            $output['id_pegawai'] = $row->id_pegawai;
            // $output['tanggal_lahir'] = $row->tanggal_lahir;
            // $output['tempat_lahir'] = $row->tempat_lahir;
            // $output['jenis_kelamin'] = $row->jenis_kelamin;
            // $output['alamat'] = $row->alamat;
            // $output['jenis_jabatan'] = $row->jenis_jabatan;
            // $output['hp'] = $row->hp;
            // $output['bidang'] = $row->id_bidang;
            // $output['jabatan'] = $row->id_jabatan;
            // $output['pendidikan'] = $row->pendidikan;
            // $output['input_anggaran'] = $row->input_anggaran;
            // $output['status_user'] = $row->status_user;
            // $output['role'] = $row->role_id;
            // $output['username'] = $row->username;
            // $output['is_active'] = $row->is_active;
        }
        echo json_encode($output);
    }






    // ---------------------------------------------------------------
    // ---------------------------------------------------------------
    // ---------------------------------------------------------------
    // INPUT PEGAWAI 
    // ---------------------------------------------------------------

    public function inputPegawai()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Input Pegawai';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['bidang'] = $this->db->get('bidang')->result_array();
        $data['jabatan'] = $this->db->get('jabatan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('admin/input_pegawai', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPegawai()
    {
        if ($_POST['action'] == 'add') {
            $data = array(
                'nip'           => $this->input->post('nip'),
                'nama_pegawai'  => $this->input->post('nama_pegawai'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'tempat_lahir'  => $this->input->post('tempat_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat'        => $this->input->post('alamat'),
                'jenis_jabatan' => $this->input->post('jenis_jabatan'),
                'hp'            => $this->input->post('hp_pegawai'),
                'id_bidang'     => $this->input->post('bidang'),
                'id_jabatan'    => $this->input->post('jabatan'),
                'pendidikan'    => $this->input->post('pendidikan'),
                'input_anggaran' => $this->input->post('input_anggaran'),
                'status_user'   => $this->input->post('status_user')
            );
            $this->Admin_model->tambah_pegawai($data);
            echo 'Data Pegawai telah disimpan!';
        }

        if ($_POST['action'] == 'edit') {
            $data = array(
                'nip'           => $this->input->post('nip'),
                'nama_pegawai'  => $this->input->post('nama_pegawai'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'tempat_lahir'  => $this->input->post('tempat_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat'        => $this->input->post('alamat'),
                'jenis_jabatan' => $this->input->post('jenis_jabatan'),
                'hp'            => $this->input->post('hp_pegawai'),
                'id_bidang'     => $this->input->post('bidang'),
                'id_jabatan'    => $this->input->post('jabatan'),
                'pendidikan'    => $this->input->post('pendidikan'),
                'input_anggaran' => $this->input->post('input_anggaran'),
                'status_user'   => $this->input->post('status_user')
            );
            $this->Admin_model->edit_pegawai($_POST['id'], $data);
            echo 'Data Pegawai berhasil diedit!';
        }
    }

    public function tabelPegawai()
    {
        $fetch_data = $this->Admin_model->make_datatables_pegawai();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = '<p><strong>' . $row->nama_pegawai . '</strong><br>
                            ' . $row->nip . '<br>
                            ' . $row->tempat_lahir . ',' . $row->tanggal_lahir . '</p>';
            $sub_array[] = $row->nama_bidang;
            $sub_array[] = $row->nama_jabatan;
            if ($row->jenis_kelamin == 1) {
                $sub_array[] = '<p>Laki-laki</p>';
            } elseif ($row->jenis_kelamin == 2) {
                $sub_array[] = '<p>Perempuan</p>';
            }

            if ($row->is_active == 1) {
                $sub_array[] = '<span class="badge badge-primary">Aktif</span>';
            } elseif ($row->is_active == 2) {
                $sub_array[] = '<span class="badge badge-warning">Tidak aktif</span>';
            } elseif ($row->is_active == null) {
                $sub_array[] = '<span class="badge badge-danger">Belum terdaftar</span>';
            }

            $sub_array[] = '<a href="#" class="edit" id="' . $row->id_user_details . '" data-toggle="tooltip" title="Edit"> <i class="ft-edit"></i> </a>
            <a href="#" class="akses text-danger" id="' . $row->id_user_details . '" data-toggle="tooltip" title="Akses Login"> <i class="ft-unlock"></i> </a>';
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Admin_model->get_all_data_pegawai(),
            "recordsFiltered"     => $this->Admin_model->get_filtered_data_pegawai(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function fetchSinglePegawai()
    {
        $output = array();
        $data = $this->Admin_model->fetch_single_pegawai($_POST['id']);

        foreach ($data as $row) {
            $output['nip'] = $row->nip;
            $output['nama_pegawai'] = $row->nama_pegawai;
            $output['tanggal_lahir'] = $row->tanggal_lahir;
            $output['tempat_lahir'] = $row->tempat_lahir;
            $output['jenis_kelamin'] = $row->jenis_kelamin;
            $output['alamat'] = $row->alamat;
            $output['jenis_jabatan'] = $row->jenis_jabatan;
            $output['hp'] = $row->hp;
            $output['bidang'] = $row->id_bidang;
            $output['jabatan'] = $row->id_jabatan;
            $output['pendidikan'] = $row->pendidikan;
            $output['input_anggaran'] = $row->input_anggaran;
            $output['status_user'] = $row->status_user;
            $output['role'] = $row->role_id;
            $output['username'] = $row->username;
            $output['is_active'] = $row->is_active;
        }
        echo json_encode($output);
    }

    public function aksesUSerLogin()
    {
        $password = $this->input->post('password2', TRUE);

        if ($_POST['action2'] == 'tambah_akses') {
            $data = array(
                'role_id'           => $this->input->post('role'),
                'id_user_detail'    => $this->input->post('id2'),
                'username'          => $this->input->post('username'),
                'password'          => password_hash($password, PASSWORD_DEFAULT),
                'nama_akun'         => $this->input->post('nama_pegawai2'),
                'image'             => 'default.jpg',
                'is_active'         => $this->input->post('status_login')
            );
            $this->Admin_model->tambah_akses($data);
            echo 'Akses Pegawai telah berhasil disimpan!';
        }

        if ($_POST['action2'] == 'edit_akses') {
            $data = array(
                'role_id'           => $this->input->post('role'),
                'id_user_detail'    => $this->input->post('id2'),
                'username'          => $this->input->post('username'),
                'password'          => password_hash($password, PASSWORD_DEFAULT),
                'nama_akun'         => $this->input->post('nama_pegawai2'),
                'image'             => 'default.jpg',
                'is_active'         => $this->input->post('status_login')
            );
            $this->Admin_model->edit_akses($this->input->post('id2'), $data);
            echo 'Akses Pegawai telah berhasil diedit!';
        }
    }

















    // ---------------------------------------------------------------
    // ---------------------------------------------------------------
    // ---------------------------------------------------------------
    // INPUT BIDANG 
    // ---------------------------------------------------------------
    public function inputBidang()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Input Bidang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('admin/input_bidang', $data);
        $this->load->view('templates/footer');
    }

    public function tabelBidang()
    {
        $fetch_data = $this->Admin_model->make_datatables_bidang();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_bidang;
            $sub_array[] = '<a href="#" class="delete text-danger" id="' . $row->id_bidang . '" data-toggle="tooltip" title="Hapus"> <i class="ft-trash"></i> </a>';

            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Admin_model->get_all_data_bidang(),
            "recordsFiltered"     => $this->Admin_model->get_filtered_data_bidang(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function tambahBidang()
    {
        $data = array(
            'nama_bidang'   => $this->input->post('nama_bidang')
        );
        $this->Admin_model->tambah_bidang($data);
        echo 'Bidang telah disimpan!';
    }

    public function hapusBidang()
    {
        $this->Admin_model->hapus_bidang($_POST['id']);
        echo 'Bidang berhasil dihapus';
    }
















    // ---------------------------------------------------------------
    // ---------------------------------------------------------------
    // ---------------------------------------------------------------
    // INPUT JABATAN 
    // ---------------------------------------------------------------
    public function inputJabatan()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Input Jabatan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('admin/input_jabatan', $data);
        $this->load->view('templates/footer');
    }

    public function tabelJabatan()
    {
        $fetch_data = $this->Admin_model->make_datatables_jabatan();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_jabatan;
            $sub_array[] = '<a href="#" class="delete text-danger" id="' . $row->id_jabatan . '" data-toggle="tooltip" title="Hapus"> <i class="ft-trash"></i> </a>';

            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Admin_model->get_all_data_jabatan(),
            "recordsFiltered"     => $this->Admin_model->get_filtered_data_jabatan(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function tambahJabatan()
    {
        $data = array(
            'nama_jabatan'   => $this->input->post('nama_jabatan')
        );
        $this->Admin_model->tambah_jabatan($data);
        echo 'Jabatan telah disimpan!';
    }

    public function hapusJabatan()
    {
        $this->Admin_model->hapus_jabatan($_POST['id']);
        echo 'Jabatan berhasil dihapus';
    }
} //End Class
