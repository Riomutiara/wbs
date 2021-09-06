<?php

class User extends CI_Controller
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }

    public function index()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Selamat Datang';
        // $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/topbar', $data);
        // $this->load->view('templates/topbar_menu', $data);
        $this->load->view('user/laporan');
        // $this->load->view('templates/footer');
    }

    public function inputLaporan()
    {

        // $data = $this->Dashboard_model->fetch_upload($this->input->post('jadwal_id'));

        $config['upload_path']          = './assets/img/laporan';
        $config['allowed_types']        = '*';
        $config['max_size']             = '10024'; // 10MB
        $config['encrypt_name']            = TRUE;


        $this->load->library('upload', $config);
        // if () {

        // 	$old_file = $this->input->post('dokumen');
        // 	if ($old_file != '') {
        // 		unlink(FCPATH . '/assets/dokumen/dok_kegiatan/' . $old_file);
        // 	}
        // } else {
        // 	echo "Jadwal gagal dikirim, pastikan ukuran dan format file benar (PDF Max. 1 MB)";
        // 	return false;
        // }

        // if ($_POST['action_nilai'] == 'Kirim') {

        $this->upload->do_upload('file_dok_kegiatan');
        $kirim_data = array(

            'file'                => $this->upload->data("file_name"),
            'type'                => $this->upload->data('file_ext'),
            'size'                => $this->upload->data('file_size'),
            'isi_laporan'         => $this->input->post('isi_laporan'),
            'tanggal_kejadian'    => $this->input->post('tanggal_kejadian'),
            'lokasi_kejadian'     => $this->input->post('lokasi_kejadian'),
            'terlapor_nama'       => $this->input->post('nama_terlapor'),
            'terlapor_profesi'    => $this->input->post('jabatan_terlapor'),
            'pelapor_nama'        => $this->input->post('nama_pelapor'),
            'pelapor_umur'        => $this->input->post('umur_pelapor'),
            'pelapor_pekerjaan'   => $this->input->post('pekerjaan_pelapor'),
            'pelapor_ktp'         => $this->input->post('noktp_pelapor'),
            'pelapor_nohp'        => $this->input->post('nohp_pelapor')
        );
        $this->User_model->upload_dokumen($kirim_data);
        // $old_pdf = $this->input->post('dokumen');
        // unlink(FCPATH .'assets/documents/suratpengantar/'.$this->input->post('dokumen'));
        echo "Laporan Anda berhasil dikirim, Terimakasih...";
        // }
    }

    public function tabelUsulanJabatan()
    {
        $fetch_data = $this->User_model->make_datatables_usulan_jabatan();
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
            $sub_array[] = $row->tanggal_mulai_jabatan;
            $sub_array[] = $row->tanggal_akhir_jabatan;
            if ($row->status_riwayat_jabatan == 0) {
                $sub_array[] = '<span class="badge badge-warning">Usulan</span>';
            } elseif ($row->status_riwayat_jabatan == 1) {
                $sub_array[] = '<span class="badge badge-success">Aktif</span>';
            } elseif ($row->status_riwayat_jabatan == 2) {
                $sub_array[] = '<span class="badge badge-secondary">Non-aktif</span>';
            } elseif ($row->status_riwayat_jabatan == 3) {
                $sub_array[] = '<span class="badge badge-danger">Ditolak</span>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_usulan_jabatan(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_usulan_jabatan(),
            "data"                => $data
        );
        echo json_encode($output);
    }











    // // ---------------------------------------------------------------
    // // ---------------------------------------------------------------
    // // ---------------------------------------------------------------
    // // MENU PROFILE 
    // // ---------------------------------------------------------------
    public function dataPribadi()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Data Pribadi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('user/data_pribadi', $data);
        $this->load->view('templates/footer');
    }

    public function updateDataPribadi()
    {
        $data = array(
            'tempat_lahir'  => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'alamat'        => $this->input->post('alamat'),
            'hp'            => $this->input->post('hp'),
            // 'id_bidang'     => $this->input->post('bidang'),
            // 'id_jabatan'    => $this->input->post('jabatan'),
            'pendidikan'    => $this->input->post('pendidikan')
        );
        // $data2 = array(
        //     'id_pegawai'    => $this->input->post('id_user'),
        //     'id_jabatan'    => $this->input->post('jabatan'),
        //     'id_bidang'     => $this->input->post('bidang'),
        //     'tanggal_mulai_jabatan'     => $this->input->post('masa_jabatan'),
        //     'tanggal_akhir_jabatan'     => $this->input->post('masa_jabatan'),
        //     'id_atasan'                 => $this->input->post('atasan_langsung'),
        //     'status_riwayat_jabatan'    => 1
        // );

        $this->User_model->update_data_pribadi($this->input->post('id_user'), $data);
        // $this->User_model->update_data_jabatan($this->input->post('id_user'), $data2);
        echo 'Data Pribadi berhasil diupdate!';
    }

    public function updateDataJabatan()
    {
        $data = array(
            'id_pegawai'    => $this->input->post('id_user2'),
            'id_jabatan'    => $this->input->post('jabatan'),
            'id_bidang'     => $this->input->post('bidang'),
            'tanggal_mulai_jabatan'     => '-',
            'tanggal_akhir_jabatan'     => '-',
            'id_atasan'                 => $this->input->post('atasan_langsung'),
            // 'tanggal_usulan'            => Date('d-m-yyyy'),
            'status_riwayat_jabatan'    => 0,
        );

        $this->User_model->simpan_data_jabatan($data);
        echo 'Data Jabatan berhasil diupdate, konfirmasi Admin untuk melakukan verifikasi jabatan yang Anda usulkan!';
    }



    public function ubahProfil()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Ubah Profil';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('user/ubah_profil', $data);
        $this->load->view('templates/footer');
    }

    public function updateProfil()
    {
        // $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $config['upload_path']          = './assets/images/profile';
        $config['allowed_types']        = 'png|jpg';
        $config['max_size']             = '1024'; // 1024KB


        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {

            $old_file = $this->input->post('image_name');
            if ($old_file != 'default.jpg') {
                unlink(FCPATH . 'assets/images/profile/' . $old_file);
            }
        }
        $new_image = $this->upload->data('file_name');
        $data = array(
            'image'         => $new_image
        );



        $this->User_model->update_profil($this->input->post('id_user'), $data);
        echo 'Data Berhasil diupdate!';
    }




















    // ---------------------------------------------------------------
    // ---------------------------------------------------------------
    // ---------------------------------------------------------------
    // PERJANJIAN KINERJA 
    // ---------------------------------------------------------------
    public function inputSasaran()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Input Sasaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['tahun'] = $this->db->get('tahun')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('user/input_sasaran', $data);
        $this->load->view('templates/footer');
    }

    public function tabelSasaran()
    {
        $fetch_data = $this->User_model->make_datatables_sasaran();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_tahun;
            $sub_array[] = $row->nama_sasaran;
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_sasaran(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_sasaran(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function tambahSasaran()
    {
        if ($_POST['action'] == 'add') {
            $data = array(
                'tahun_id'          => $this->input->post('tahun'),
                'id_user_detail'    => $this->input->post('id_user'),
                'nama_sasaran'      => $this->input->post('sasaran')
            );
            $this->User_model->tambah_sasaran($data);
            echo 'Data disimpan!';
        }
    }

    public function inputIndikator()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Input Indikator';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['tahun'] = $this->db->get('tahun')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('user/input_indikator', $data);
        $this->load->view('templates/footer');
    }

    public function tabelIndikator()
    {
        $fetch_data = $this->User_model->make_datatables_indikator();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_tahun;
            $sub_array[] = $row->nama_indikator;
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_indikator(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_indikator(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function tambahIndikator()
    {
        if ($_POST['action'] == 'add') {
            $data = array(
                'tahun_id'          => $this->input->post('tahun'),
                'id_user_detail'    => $this->input->post('id_user'),
                'nama_indikator'    => $this->input->post('indikator')
            );
            $this->User_model->tambah_indikator($data);
            echo 'Data disimpan!';
        }
    }

    public function perjanjianKinerja()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Input PK';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['tahun'] = $this->db->get('tahun')->result_array();
        // $data['pegawai'] = $this->db->get('user_details')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('user/buat_perjanjian', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPerjanjian()
    {
        $data = array(
            'id_user_detail'    => $this->input->post('user_id'),
            'tahun_id'          => $this->input->post('tahun_id'),
            'id_sasaran'        => $this->input->post('sasaran'),
            'id_indikator'      => $this->input->post('indikator'),
            'target'            => $this->input->post('target')
        );
        $this->User_model->tambah_perjanjian($data);
        echo 'Data disimpan!';
    }

    public function tambahProgram()
    {
        $data = array(
            'id_user_detail'    => $this->input->post('id_user'),
            'tahun_id'          => $this->input->post('tahun'),
            'nama_program'        => $this->input->post('program'),
            'keterangan_program'       => $this->input->post('ket_program'),
        );
        $this->User_model->tambah_program($data);
        echo 'Data disimpan!';
    }

    public function tambahProgram2()
    {
        $data = array(
            'id_user_detail'    => $this->input->post('user_id2'),
            'tahun_id'          => $this->input->post('tahun_id2'),
            'id_program'        => $this->input->post('program'),
            'id_kegiatan'       => $this->input->post('kegiatan'),
            'anggaran_program'  => $this->input->post('anggaran'),
        );
        $this->User_model->tambah_program_kegiatan($data);
        echo 'Data disimpan!';
    }

    public function tabelPerjanjianKinerja()
    {
        $fetch_data = $this->User_model->make_datatables_perjanjian_kinerja();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_sasaran;
            $sub_array[] = $row->nama_indikator;
            $sub_array[] = $row->target;
            $sub_array[] = '<a href="#" class="delete" id="' . $row->id_perjanjian_kinerja . '" data-toggle="tooltip" title="Hapus"> <i class="ft-trash text-danger"></i> </a>';
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_perjanjian_kinerja(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_perjanjian_kinerja(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function tabelProgramKegiatan()
    {
        $fetch_data = $this->User_model->make_datatables_program_kegiatan();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_program;
            $sub_array[] = $row->nama_kegiatan;
            $sub_array[] = number_format($row->anggaran_program);
            $sub_array[] = '<a href="#" class="delete_program" id="' . $row->id_program_kegiatan . '" data-toggle="tooltip" title="Hapus"> <i class="ft-trash text-danger"></i> </a>';
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_program_kegiatan(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_program_kegiatan(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function hapusPerjanjianKinerja()
    {
        $this->User_model->hapus_perjanjian_kinerja($_POST['id']);
        echo 'Data berhasil dihapus!';
    }

    public function hapusProgramKegiatan()
    {
        $this->User_model->hapus_program_kegiatan($_POST['id']);
        echo 'Data berhasil dihapus!';
    }

    // PRINT PERJANJIAN KINERJA
    public function printPK($tahun, $user, $user2, $tanggal)
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Print Perjanjian Kinerja (PK)';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['data_tahun'] = $this->db->get_where('tahun', ['tahun_id' => $tahun])->row_array();
        $data['data_user'] = $this->db->get_where('user_details', ['id_user_details' => $user])->row_array();
        $data['data_atasan'] = $this->db->get_where('user_details', ['id_user_details' => $user2])->row_array();
        $data['tanggal_cetak'] = $tanggal;

        $this->load->view('print/print_pk', $data);
    }



    // SUB MENU KEGIATAN
    public function inputProgram()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Input Program';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['tahun'] = $this->db->get('tahun')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('user/input_program', $data);
        $this->load->view('templates/footer');
    }

    public function tabelProgram()
    {
        $fetch_data = $this->User_model->make_datatables_program();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_tahun;
            $sub_array[] = $row->nama_program;
            $sub_array[] = $row->keterangan_program;
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_program(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_program(),
            "data"                => $data
        );
        echo json_encode($output);
    }




    // SUB MENU ANGGARAN
    public function inputKegiatan()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Input Kegiatan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['tahun'] = $this->db->get('tahun')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('user/input_kegiatan', $data);
        $this->load->view('templates/footer');
    }

    public function tabelKegiatan()
    {
        $fetch_data = $this->User_model->make_datatables_kegiatan();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_tahun;
            $sub_array[] = $row->nama_kegiatan;
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_kegiatan(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_kegiatan(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function tabelLaporan()
    {
        $fetch_data = $this->User_model->make_datatables_laporan();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->id_pengaduan;
            $sub_array[] = $row->tanggal_kejadian;
            $sub_array[] = $row->lokasi_kejadian;
            $sub_array[] = '<button type="button" class="btn btn-warning btn-sm print" id="' . $row->id_pengaduan . '" data-toggle="tooltip" title="Hapus">Print </button>';
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_laporan(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_laporan(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function tambahKegiatan()
    {
        if ($_POST['action'] == 'add') {
            $data = array(
                'tahun_id'           => $this->input->post('tahun'),
                'id_user_detail'     => $this->input->post('id_user'),
                'nama_kegiatan'      => $this->input->post('kegiatan'),
                // 'anggaran_kegiatan'  => $this->input->post('anggaran')
            );
            $this->User_model->tambah_kegiatan($data);
            echo 'Data disimpan!';
        }
    }




















    // // ---------------------------------------------------------------
    // // ---------------------------------------------------------------
    // // ---------------------------------------------------------------
    // // PENGUKURAN KINERJA 
    // // ---------------------------------------------------------------
    public function pengukuranKinerja()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Input Pengukuran Kinerja';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['tahun'] = $this->db->get('tahun')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('user/input_pengukuran', $data);
        $this->load->view('templates/footer');
    }

    public function tabelPengukuranKinerja()
    {
        $fetch_data = $this->User_model->make_datatables_pengukuran_kinerja();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_sasaran;
            $sub_array[] = $row->nama_indikator;
            $sub_array[] = $row->target;

            $sub_array[] = $row->realisasi1;
            $sub_array[] = $row->pencapaian1;
            if ($row->realisasi1 == '') {
                $sub_array[] = '<a href="#" class="realisasi1" id="' . $row->id_perjanjian_kinerja . '" data-toggle="modal" title="Input realisasi"> <i class="ft-file text-primary"></i> 
                </a><br>';
            } else {
                $sub_array[] = '<a href="#" class="edit_realisasi1" id="' . $row->id_perjanjian_kinerja . '" data-toggle="modal" title="Edit realisasi"> <i class="ft-edit-3 text-warning"></i> </a>';
            }

            $sub_array[] = $row->realisasi2;
            $sub_array[] = $row->pencapaian2;
            if ($row->realisasi2 == '') {
                $sub_array[] = '<a href="#" class="realisasi2" id="' . $row->id_perjanjian_kinerja . '" data-toggle="modal" title="Input realisasi"> <i class="ft-file text-primary"></i> 
                            </a><br>';
            } else {
                $sub_array[] = '<a href="#" class="edit_realisasi2" id="' . $row->id_perjanjian_kinerja . '" data-toggle="modal" title="Edit realisasi"> <i class="ft-edit-3 text-warning"></i> </a>';
            }

            $sub_array[] = $row->realisasi3;
            $sub_array[] = $row->pencapaian3;
            if ($row->realisasi3 == '') {
                $sub_array[] = '<a href="#" class="realisasi3" id="' . $row->id_perjanjian_kinerja . '" data-toggle="modal" title="Input realisasi"> <i class="ft-file text-primary"></i> 
                            </a><br>';
            } else {
                $sub_array[] = '<a href="#" class="edit_realisasi3" id="' . $row->id_perjanjian_kinerja . '" data-toggle="modal" title="Edit realisasi"> <i class="ft-edit-3 text-warning"></i> </a>';
            }

            $sub_array[] = $row->realisasi4;
            $sub_array[] = $row->pencapaian4;
            if ($row->realisasi4 == '') {
                $sub_array[] = '<a href="#" class="realisasi4" id="' . $row->id_perjanjian_kinerja . '" data-toggle="modal" title="Input realisasi"> <i class="ft-file text-primary"></i> 
                            </a><br>';
            } else {
                $sub_array[] = '<a href="#" class="edit_realisasi4" id="' . $row->id_perjanjian_kinerja . '" data-toggle="modal" title="Edit realisasi"> <i class="ft-edit-3 text-warning"></i> </a>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_pengukuran_kinerja(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_pengukuran_kinerja(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function tabelInputProgramKegiatan()
    {
        $fetch_data = $this->User_model->make_datatables_input_program_kegiatan();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->nama_program;
            $sub_array[] = $row->nama_kegiatan;
            $sub_array[] = number_format($row->anggaran_program);
            $sub_array[] = $row->keterangan_program;

            $sub_array[] = number_format($row->realisasi1);
            $sub_array[] = $row->pencapaian1;
            if ($row->realisasi1 == '') {
                $sub_array[] = '<a href="#" class="realisasi_kegiatan1" id="' . $row->id_program_kegiatan . '" data-toggle="modal" title="Input realisasi"> <i class="ft-file text-primary"></i> 
                </a><br>';
            } else {
                $sub_array[] = '<a href="#" class="edit_realisasi_kegiatan1" id="' . $row->id_program_kegiatan . '" data-toggle="modal" title="Edit realisasi"> <i class="ft-edit-3 text-warning"></i> </a>';
            }

            $sub_array[] = number_format($row->realisasi2);
            $sub_array[] = $row->pencapaian2;
            if ($row->realisasi2 == '') {
                $sub_array[] = '<a href="#" class="realisasi_kegiatan2" id="' . $row->id_program_kegiatan . '" data-toggle="modal" title="Input realisasi"> <i class="ft-file text-primary"></i> 
                            </a><br>';
            } else {
                $sub_array[] = '<a href="#" class="edit_realisasi_kegiatan2" id="' . $row->id_program_kegiatan . '" data-toggle="modal" title="Edit realisasi"> <i class="ft-edit-3 text-warning"></i> </a>';
            }

            $sub_array[] = number_format($row->realisasi3);
            $sub_array[] = $row->pencapaian3;
            if ($row->realisasi3 == '') {
                $sub_array[] = '<a href="#" class="realisasi_kegiatan3" id="' . $row->id_program_kegiatan . '" data-toggle="modal" title="Input realisasi"> <i class="ft-file text-primary"></i> 
                            </a><br>';
            } else {
                $sub_array[] = '<a href="#" class="edit_realisasi_kegiatan3" id="' . $row->id_program_kegiatan . '" data-toggle="modal" title="Edit realisasi"> <i class="ft-edit-3 text-warning"></i> </a>';
            }

            $sub_array[] = number_format($row->realisasi4);
            $sub_array[] = $row->pencapaian4;
            if ($row->realisasi4 == '') {
                $sub_array[] = '<a href="#" class="realisasi_kegiatan4" id="' . $row->id_program_kegiatan . '" data-toggle="modal" title="Input realisasi"> <i class="ft-file text-primary"></i> 
                            </a><br>';
            } else {
                $sub_array[] = '<a href="#" class="edit_realisasi_kegiatan4" id="' . $row->id_program_kegiatan . '" data-toggle="modal" title="Edit realisasi"> <i class="ft-edit-3 text-warning"></i> </a>';
            }

            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->User_model->get_all_data_input_program_kegiatan(),
            "recordsFiltered"     => $this->User_model->get_filtered_data_input_program_kegiatan(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function fetchSinglePengukuran()
    {
        $output = array();
        $data = $this->User_model->fetch_single_pengukuran($_POST['id']);

        foreach ($data as $row) {
            $output['sasaran'] = $row->nama_sasaran;
            $output['indikator'] = $row->nama_indikator;
            $output['target'] = $row->target;
            $output['realisasi1'] = $row->realisasi1;
            $output['pencapaian1'] = $row->pencapaian1;

            $output['realisasi2'] = $row->realisasi2;
            $output['pencapaian2'] = $row->pencapaian2;

            $output['realisasi3'] = $row->realisasi3;
            $output['pencapaian3'] = $row->pencapaian3;

            $output['realisasi4'] = $row->realisasi4;
            $output['pencapaian4'] = $row->pencapaian4;
        }
        echo json_encode($output);
    }

    public function fetchSingleProgramKegiatan()
    {
        $output = array();
        $data = $this->User_model->fetch_single_program_kegiatan($_POST['id']);

        foreach ($data as $row) {
            $output['program'] = $row->nama_program;
            $output['kegiatan'] = $row->nama_kegiatan;
            $output['anggaran_program'] = $row->anggaran_program;
            $output['keterangan_program'] = $row->keterangan_program;
            $output['realisasi1'] = $row->realisasi1;
            $output['pencapaian1'] = $row->pencapaian1;

            $output['realisasi2'] = $row->realisasi2;
            $output['pencapaian2'] = $row->pencapaian2;

            $output['realisasi3'] = $row->realisasi3;
            $output['pencapaian3'] = $row->pencapaian3;

            $output['realisasi4'] = $row->realisasi4;
            $output['pencapaian4'] = $row->pencapaian4;
        }
        echo json_encode($output);
    }

    public function inputRealisasiDanAnggaran()
    {
        if ($_POST['action'] == 'add') {
            if ($_POST['id_triwulan'] == 1) {
                $data = array(
                    'id_perjanjian1'  => $this->input->post('id_perjanjian'),
                    'realisasi1'      => $this->input->post('realisasi'),
                    'pencapaian1'     => $this->input->post('pencapaian')
                );
                $this->User_model->input_triwulan1($data);
                echo 'Data Triwulan 1 disimpan!';
            } elseif ($_POST['id_triwulan'] == 2) {
                $data = array(
                    'id_perjanjian2'  => $this->input->post('id_perjanjian'),
                    'realisasi2'      => $this->input->post('realisasi'),
                    'pencapaian2'     => $this->input->post('pencapaian')
                );
                $this->User_model->input_triwulan2($data);
                echo 'Data Triwulan II disimpan!';
            } elseif ($_POST['id_triwulan'] == 3) {
                $data = array(
                    'id_perjanjian3'  => $this->input->post('id_perjanjian'),
                    'realisasi3'      => $this->input->post('realisasi'),
                    'pencapaian3'     => $this->input->post('pencapaian')
                );
                $this->User_model->input_triwulan3($data);
                echo 'Data Triwulan III disimpan!';
            } elseif ($_POST['id_triwulan'] == 4) {
                $data = array(
                    'id_perjanjian4' => $this->input->post('id_perjanjian'),
                    'realisasi4'     => $this->input->post('realisasi'),
                    'pencapaian4'    => $this->input->post('pencapaian')
                );
                $this->User_model->input_triwulan4($data);
                echo 'Data Triwulan IV disimpan!';
            }
        }

        if ($_POST['action'] == 'add_anggaran') {
            if ($_POST['id_triwulan'] == 1) {
                $data = array(
                    'id_kegiatan1'  => $this->input->post('id_perjanjian'),
                    'realisasi1'      => $this->input->post('realisasi'),
                    'pencapaian1'     => $this->input->post('pencapaian')
                );
                $this->User_model->input_triwulan_anggaran1($data);
                echo 'Data Triwulan 1 disimpan!';
            } elseif ($_POST['id_triwulan'] == 2) {
                $data = array(
                    'id_kegiatan2'  => $this->input->post('id_perjanjian'),
                    'realisasi2'      => $this->input->post('realisasi'),
                    'pencapaian2'     => $this->input->post('pencapaian')
                );
                $this->User_model->input_triwulan_anggaran2($data);
                echo 'Data Triwulan II disimpan!';
            } elseif ($_POST['id_triwulan'] == 3) {
                $data = array(
                    'id_kegiatan3'  => $this->input->post('id_perjanjian'),
                    'realisasi3'      => $this->input->post('realisasi'),
                    'pencapaian3'     => $this->input->post('pencapaian')
                );
                $this->User_model->input_triwulan_anggaran3($data);
                echo 'Data Triwulan III disimpan!';
            } elseif ($_POST['id_triwulan'] == 4) {
                $data = array(
                    'id_kegiatan4' => $this->input->post('id_perjanjian'),
                    'realisasi4'     => $this->input->post('realisasi'),
                    'pencapaian4'    => $this->input->post('pencapaian')
                );
                $this->User_model->input_triwulan_anggaran4($data);
                echo 'Data Triwulan IV disimpan!';
            }
        }




        if ($_POST['action'] == 'edit') {
            if ($_POST['id_triwulan'] == 1) {
                $data = array(
                    'realisasi1'      => $this->input->post('realisasi'),
                    'pencapaian1'     => $this->input->post('pencapaian')
                );
                $this->User_model->edit_triwulan1($this->input->post('id_perjanjian'), $data);
                echo 'Data Triwulan 1 disimpan!';
            } elseif ($_POST['id_triwulan'] == 2) {
                $data = array(
                    'realisasi2'      => $this->input->post('realisasi'),
                    'pencapaian2'     => $this->input->post('pencapaian')
                );
                $this->User_model->edit_triwulan2($this->input->post('id_perjanjian'), $data);
                echo 'Data Triwulan II disimpan!';
            } elseif ($_POST['id_triwulan'] == 3) {
                $data = array(
                    'realisasi3'      => $this->input->post('realisasi'),
                    'pencapaian3'     => $this->input->post('pencapaian')
                );
                $this->User_model->edit_triwulan3($this->input->post('id_perjanjian'), $data);
                echo 'Data Triwulan III disimpan!';
            } elseif ($_POST['id_triwulan'] == 4) {
                $data = array(
                    'realisasi4'     => $this->input->post('realisasi'),
                    'pencapaian4'    => $this->input->post('pencapaian')
                );
                $this->User_model->edit_triwulan4($this->input->post('id_perjanjian'), $data);
                echo 'Data Triwulan IV disimpan!';
            }
        }

        if ($_POST['action'] == 'edit_anggaran') {
            if ($_POST['id_triwulan'] == 1) {
                $data = array(
                    'realisasi1'      => $this->input->post('realisasi'),
                    'pencapaian1'     => $this->input->post('pencapaian')
                );
                $this->User_model->edit_triwulan_kegiatan1($this->input->post('id_perjanjian'), $data);
                echo 'Data Triwulan 1 disimpan!';
            } elseif ($_POST['id_triwulan'] == 2) {
                $data = array(
                    'realisasi2'      => $this->input->post('realisasi'),
                    'pencapaian2'     => $this->input->post('pencapaian')
                );
                $this->User_model->edit_triwulan_kegiatan2($this->input->post('id_perjanjian'), $data);
                echo 'Data Triwulan II disimpan!';
            } elseif ($_POST['id_triwulan'] == 3) {
                $data = array(
                    'realisasi3'      => $this->input->post('realisasi'),
                    'pencapaian3'     => $this->input->post('pencapaian')
                );
                $this->User_model->edit_triwulan_kegiatan3($this->input->post('id_perjanjian'), $data);
                echo 'Data Triwulan III disimpan!';
            } elseif ($_POST['id_triwulan'] == 4) {
                $data = array(
                    'realisasi4'     => $this->input->post('realisasi'),
                    'pencapaian4'    => $this->input->post('pencapaian')
                );
                $this->User_model->edit_triwulan_kegiatan4($this->input->post('id_perjanjian'), $data);
                echo 'Data Triwulan IV disimpan!';
            }
        }
    }

    // PRINT PENGUKURAN KINERJA
    public function printPengukuranKinerja($user, $tahun, $triwulan, $atasan, $tanggal)
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Print Pengukuran Kinerja';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['data_user'] = $this->db->get_where('user_details', ['id_user_details' => $user])->row_array();
        $data['data_tahun'] = $this->db->get_where('tahun', ['tahun_id' => $tahun])->row_array();
        $data['data_triwulan'] = $triwulan;
        $data['data_atasan'] = $this->db->get_where('user_details', ['id_user_details' => $atasan])->row_array();
        $data['tanggal_cetak'] = $tanggal;

        $this->load->view('print/print_pengukuran_kinerja', $data);
    }
} //End Class
