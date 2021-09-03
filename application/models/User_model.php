<?php

class User_model extends CI_Model
{
    public function upload_dokumen($kirim_data)
    {
        $this->db->insert('pengaduan', $kirim_data);
    }
    // -------------------------------------------------
    //  PERJANJIAN KINERJA 
    // -------------------------------------------------
    public function tambah_sasaran($data)
    {
        $this->db->insert('sasaran', $data);
    }

    public function tambah_indikator($data)
    {
        $this->db->insert('indikator', $data);
    }

    public function tambah_perjanjian($data)
    {
        $this->db->insert('perjanjian_kinerja', $data);
    }

    public function tambah_program_kegiatan($data)
    {
        $this->db->insert('program_kegiatan', $data);
    }

    public function hapus_perjanjian_kinerja($id)
    {
        $this->db->where('id_perjanjian_kinerja', $id);
        $this->db->delete('perjanjian_kinerja');
    }

    public function hapus_program_kegiatan($id)
    {
        $this->db->where('id_program_kegiatan', $id);
        $this->db->delete('program_kegiatan');
    }

    public function tambah_program($data)
    {
        $this->db->insert('program', $data);
    }

    public function tambah_kegiatan($data)
    {
        $this->db->insert('kegiatan', $data);
    }


    // DATATABLE SASARAN
    var $order_column_sasaran = array(null, 'nama_tahun', 'nama_sasaran', null);

    public function make_query_sasaran()
    {
        if ($this->input->post('idUser')) {
            $this->db->where('sasaran.id_user_detail', $this->input->post('idUser'));
        }

        $this->db->select('*');
        $this->db->from('sasaran');
        $this->db->join('tahun', 'tahun.tahun_id = sasaran.tahun_id', 'LEFT');

        if (isset($_POST["search"]["value"])) {
            $this->db->like('nama_sasaran', $_POST["search"]["value"]);
            $this->db->like('tahun.nama_tahun', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_sasaran[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_sasaran', 'DESC');
        }
    }

    public function make_datatables_sasaran()
    {
        $this->make_query_sasaran();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_sasaran()
    {
        $this->make_query_sasaran();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_sasaran()
    {
        $this->db->select("*");
        $this->db->from('sasaran');
        return $this->db->count_all_results();
    }
    // END DATATABLE SASARAN


    // DATATABLE INDIKATOR
    var $order_column_indikator = array(null, 'nama_tahun', 'nama_indikator', null);

    public function make_query_indikator()
    {
        if ($this->input->post('idUser')) {
            $this->db->like('indikator.id_user_detail', $this->input->post('idUser'));
        }

        $this->db->select('*');
        $this->db->from('indikator');
        $this->db->join('tahun', 'tahun.tahun_id = indikator.tahun_id');

        if (isset($_POST["search"]["value"])) {
            $this->db->like('nama_indikator', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_indikator[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_indikator', 'DESC');
        }
    }

    public function make_datatables_indikator()
    {
        $this->make_query_indikator();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_indikator()
    {
        $this->make_query_indikator();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_indikator()
    {
        $this->db->select("*");
        $this->db->from('indikator');
        return $this->db->count_all_results();
    }
    // END DATATABLE INDIKATOR


    // DATATABLE PERJANJIAN KINERJA
    var $order_column_perjanjian_kinerja1 = array(null, 'nama_sasaran', 'nama_indikator', 'target', null);

    public function make_query_perjanjian_kinerja()
    {
        if ($this->input->post('idTahun')) {
            $this->db->where('perjanjian_kinerja.tahun_id', $this->input->post('idTahun'));
            $this->db->where('perjanjian_kinerja.id_user_detail', $this->input->post('idUser'));
        }

        $this->db->select('*');
        $this->db->from('perjanjian_kinerja');
        $this->db->join('tahun', 'tahun.tahun_id = perjanjian_kinerja.tahun_id');
        $this->db->join('sasaran', 'sasaran.id_sasaran = perjanjian_kinerja.id_sasaran');
        $this->db->join('indikator', 'indikator.id_indikator = perjanjian_kinerja.id_indikator');

        if (($_POST["search"]["value"])) {
            $this->db->like('indikator.nama_indikator', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_perjanjian_kinerja1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_perjanjian_kinerja', 'ASC');
        }
    }

    public function make_datatables_perjanjian_kinerja()
    {
        $this->make_query_perjanjian_kinerja();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_perjanjian_kinerja()
    {
        $this->make_query_perjanjian_kinerja();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_perjanjian_kinerja()
    {
        $this->db->select("*");
        $this->db->from('perjanjian_kinerja');
        return $this->db->count_all_results();
    }
    // END DATATABLE PERJANJIAN KINERJA

    // DATATABLE PROGRAM & KEGIATAN TAB 2
    var $order_column_program_kegiatan = array(null, 'nama_program', 'nama_kegiatan', 'anggaran_program', null);

    public function make_query_program_kegiatan()
    {
        if ($this->input->post('idTahun')) {
            $this->db->where('program_kegiatan.tahun_id', $this->input->post('idTahun'));
            $this->db->where('program_kegiatan.id_user_detail', $this->input->post('idUser'));
        }

        $this->db->select('*');
        $this->db->from('program_kegiatan');
        $this->db->join('tahun', 'tahun.tahun_id = program_kegiatan.tahun_id');
        $this->db->join('program', 'program.id_program = program_kegiatan.id_program');
        $this->db->join('kegiatan', 'kegiatan.id_kegiatan = program_kegiatan.id_kegiatan');

        if (($_POST["search"]["value"])) {
            $this->db->like('kegiatan.nama_kegiatan', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_program_kegiatan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_program_kegiatan', 'ASC');
        }
    }

    public function make_datatables_program_kegiatan()
    {
        $this->make_query_program_kegiatan();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_program_kegiatan()
    {
        $this->make_query_program_kegiatan();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_program_kegiatan()
    {
        $this->db->select("*");
        $this->db->from('program_kegiatan');
        return $this->db->count_all_results();
    }
    // END DATATABLE PROGRAM & KEGIATAN


    // DATATABLE PROGRAM    
    var $order_column_program = array(null, 'nama_program', 'keterangan_program', null);

    public function make_query_program()
    {
        if ($this->input->post('idUser')) {
            $this->db->where('program.id_user_detail', $this->input->post('idUser'));
        }

        $this->db->select('*');
        $this->db->from('program');
        $this->db->join('tahun', 'tahun.tahun_id = program.tahun_id', 'LEFT');

        if (isset($_POST["search"]["value"])) {
            $this->db->like('program.nama_program', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_program[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_program', 'DESC');
        }
    }

    public function make_datatables_program()
    {
        $this->make_query_program();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_program()
    {
        $this->make_query_program();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_program()
    {
        $this->db->select("*");
        $this->db->from('program');
        return $this->db->count_all_results();
    }
    // END DATATABLE PROGRAM

    // DATATABLE KEGIATAN    
    var $order_column_kegiatan = array(null, 'nama_kegiatan', 'nama_tahun', null);

    public function make_query_kegiatan()
    {
        if ($this->input->post('idUser')) {
            $this->db->where('kegiatan.id_user_detail', $this->input->post('idUser'));
        }

        $this->db->select('*');
        $this->db->from('kegiatan');
        $this->db->join('tahun', 'tahun.tahun_id = kegiatan.tahun_id', 'LEFT');

        if (isset($_POST["search"]["value"])) {
            $this->db->like('kegiatan.nama_kegiatan', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_kegiatan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_kegiatan', 'DESC');
        }
    }

    public function make_datatables_kegiatan()
    {
        $this->make_query_kegiatan();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_kegiatan()
    {
        $this->make_query_kegiatan();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_kegiatan()
    {
        $this->db->select("*");
        $this->db->from('kegiatan');
        return $this->db->count_all_results();
    }
    // END DATATABLE KEGIATAN












    // -------------------------------------------------
    // PENGUKURAN KINERJA
    // -------------------------------------------------
    public function fetch_single_pengukuran($id)
    {
        $this->db->from('perjanjian_kinerja');
        $this->db->join('sasaran', 'sasaran.id_sasaran = perjanjian_kinerja.id_sasaran');
        $this->db->join('indikator', 'indikator.id_indikator = perjanjian_kinerja.id_indikator');
        $this->db->join('triwulan_1', 'triwulan_1.id_perjanjian1 = perjanjian_kinerja.id_perjanjian_kinerja', 'LEFT');
        $this->db->join('triwulan_2', 'triwulan_2.id_perjanjian2 = perjanjian_kinerja.id_perjanjian_kinerja', 'LEFT');
        $this->db->join('triwulan_3', 'triwulan_3.id_perjanjian3 = perjanjian_kinerja.id_perjanjian_kinerja', 'LEFT');
        $this->db->join('triwulan_4', 'triwulan_4.id_perjanjian4 = perjanjian_kinerja.id_perjanjian_kinerja', 'LEFT');
        $this->db->where('perjanjian_kinerja.id_perjanjian_kinerja', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_single_program_kegiatan($id)
    {
        $this->db->from('program_kegiatan');
        $this->db->join('program', 'program.id_program = program_kegiatan.id_program');
        $this->db->join('kegiatan', 'kegiatan.id_kegiatan = program_kegiatan.id_kegiatan');
        $this->db->join('kegiatan_triwulan_1', 'kegiatan_triwulan_1.id_kegiatan1 = program_kegiatan.id_program_kegiatan', 'LEFT');
        $this->db->join('kegiatan_triwulan_2', 'kegiatan_triwulan_2.id_kegiatan2 = program_kegiatan.id_program_kegiatan', 'LEFT');
        $this->db->join('kegiatan_triwulan_3', 'kegiatan_triwulan_3.id_kegiatan3 = program_kegiatan.id_program_kegiatan', 'LEFT');
        $this->db->join('kegiatan_triwulan_4', 'kegiatan_triwulan_4.id_kegiatan4 = program_kegiatan.id_program_kegiatan', 'LEFT');
        $this->db->where('program_kegiatan.id_program_kegiatan', $id);
        $query = $this->db->get();
        return $query->result();
    }

    // INPUT TRIWULAN PERJANJIAN KINERJA
    public function input_triwulan1($data)
    {
        $this->db->insert('triwulan_1', $data);
    }

    public function input_triwulan2($data)
    {
        $this->db->insert('triwulan_2', $data);
    }

    public function input_triwulan3($data)
    {
        $this->db->insert('triwulan_3', $data);
    }

    public function input_triwulan4($data)
    {
        $this->db->insert('triwulan_4', $data);
    }

    // INPUT TRIWULAN ANGGARAN
    public function input_triwulan_anggaran1($data)
    {
        $this->db->insert('kegiatan_triwulan_1', $data);
    }

    public function input_triwulan_anggaran2($data)
    {
        $this->db->insert('kegiatan_triwulan_2', $data);
    }

    public function input_triwulan_anggaran3($data)
    {
        $this->db->insert('kegiatan_triwulan_3', $data);
    }

    public function input_triwulan_anggaran4($data)
    {
        $this->db->insert('kegiatan_triwulan_4', $data);
    }

    // EDIT TRIWULAN PERJANJIAN KINERJA
    public function edit_triwulan1($id, $data)
    {
        $this->db->where('id_perjanjian1', $id);
        $this->db->update('triwulan_1', $data);
    }

    public function edit_triwulan2($id, $data)
    {
        $this->db->where('id_perjanjian2', $id);
        $this->db->update('triwulan_2', $data);
    }

    public function edit_triwulan3($id, $data)
    {
        $this->db->where('id_perjanjian3', $id);
        $this->db->update('triwulan_3', $data);
    }

    public function edit_triwulan4($id, $data)
    {
        $this->db->where('id_perjanjian4', $id);
        $this->db->update('triwulan_4', $data);
    }

    // EDIT TRIWULAN ANGGARAN
    public function edit_triwulan_kegiatan1($id, $data)
    {
        $this->db->where('id_kegiatan1', $id);
        $this->db->update('kegiatan_triwulan_1', $data);
    }

    public function edit_triwulan_kegiatan2($id, $data)
    {
        $this->db->where('id_kegiatan2', $id);
        $this->db->update('kegiatan_triwulan_2', $data);
    }

    public function edit_triwulan_kegiatan3($id, $data)
    {
        $this->db->where('id_kegiatan3', $id);
        $this->db->update('kegiatan_triwulan_3', $data);
    }

    public function edit_triwulan_kegiatan4($id, $data)
    {
        $this->db->where('id_kegiatan4', $id);
        $this->db->update('kegiatan_triwulan_4', $data);
    }


    // DATATABLE PENGUKURAN KINERJA
    var $order_column_pengukuran_kinerja = array(null, 'nama_sasaran', 'nama_indikator', 'target', null, null, null);

    public function make_query_pengukuran_kinerja()
    {
        if ($this->input->post('idUser')) {
            $this->db->where('perjanjian_kinerja.id_user_detail', $this->input->post('idUser'));
            $this->db->where('perjanjian_kinerja.tahun_id', $this->input->post('idTahun'));
        }

        $this->db->select('*');
        $this->db->from('perjanjian_kinerja');
        $this->db->join('tahun', 'tahun.tahun_id = perjanjian_kinerja.tahun_id');
        $this->db->join('sasaran', 'sasaran.id_sasaran = perjanjian_kinerja.id_sasaran');
        $this->db->join('indikator', 'indikator.id_indikator = perjanjian_kinerja.id_indikator');
        $this->db->join('triwulan_1', 'triwulan_1.id_perjanjian1 = perjanjian_kinerja.id_perjanjian_kinerja', 'LEFT');
        $this->db->join('triwulan_2', 'triwulan_2.id_perjanjian2 = perjanjian_kinerja.id_perjanjian_kinerja', 'LEFT');
        $this->db->join('triwulan_3', 'triwulan_3.id_perjanjian3 = perjanjian_kinerja.id_perjanjian_kinerja', 'LEFT');
        $this->db->join('triwulan_4', 'triwulan_4.id_perjanjian4 = perjanjian_kinerja.id_perjanjian_kinerja', 'LEFT');

        if (($_POST["search"]["value"])) {
            $this->db->like('indikator.nama_indikator', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_pengukuran_kinerja[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_perjanjian_kinerja', 'ASC');
        }
    }

    public function make_datatables_pengukuran_kinerja()
    {
        $this->make_query_pengukuran_kinerja();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_pengukuran_kinerja()
    {
        $this->make_query_pengukuran_kinerja();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_pengukuran_kinerja()
    {
        $this->db->select("*");
        $this->db->from('perjanjian_kinerja');
        return $this->db->count_all_results();
    }
    // END DATATABLE PENGUKURAN

    // DATATABLE PROGRAM & KEGIATAN
    var $order_column_input_program_kegiatan = array(null, 'nama_program', 'nama_kegiatan', 'anggaran_program', 'keterangan_program');

    public function make_query_input_program_kegiatan()
    {
        if ($this->input->post('idUser')) {
            $this->db->where('program_kegiatan.id_user_detail', $this->input->post('idUser'));
            $this->db->where('program_kegiatan.tahun_id', $this->input->post('idTahun'));
        }

        $this->db->select('*');
        $this->db->from('program_kegiatan');
        $this->db->join('tahun', 'tahun.tahun_id = program_kegiatan.tahun_id');
        $this->db->join('program', 'program.id_program = program_kegiatan.id_program');
        $this->db->join('kegiatan', 'kegiatan.id_kegiatan = program_kegiatan.id_kegiatan');
        $this->db->join('kegiatan_triwulan_1', 'kegiatan_triwulan_1.id_kegiatan1 = program_kegiatan.id_program_kegiatan', 'LEFT');
        $this->db->join('kegiatan_triwulan_2', 'kegiatan_triwulan_2.id_kegiatan2 = program_kegiatan.id_program_kegiatan', 'LEFT');
        $this->db->join('kegiatan_triwulan_3', 'kegiatan_triwulan_3.id_kegiatan3 = program_kegiatan.id_program_kegiatan', 'LEFT');
        $this->db->join('kegiatan_triwulan_4', 'kegiatan_triwulan_4.id_kegiatan4 = program_kegiatan.id_program_kegiatan', 'LEFT');

        if (($_POST["search"]["value"])) {
            $this->db->like('kegiatan.nama_kegiatan', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_input_program_kegiatan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_program_kegiatan', 'ASC');
        }
    }

    public function make_datatables_input_program_kegiatan()
    {
        $this->make_query_input_program_kegiatan();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_input_program_kegiatan()
    {
        $this->make_query_input_program_kegiatan();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_input_program_kegiatan()
    {
        $this->db->select("*");
        $this->db->from('program_kegiatan');
        return $this->db->count_all_results();
    }
    // END DATATABLE PENGUKURAN






    public function fetch_single_pk($id)
    {
        $this->db->from('perjanjian_kinerja');
        $this->db->where('id_perjanjian_kinerja', $id);
        $query = $this->db->get();
        return $query->result();
    }


















    // -------------------------------------------------
    // PROFILE
    // -------------------------------------------------
    public function update_data_pribadi($id, $data)
    {
        $this->db->where('id_user_details', $id);
        $this->db->update('user_details', $data);
    }

    public function simpan_data_jabatan($data)
    {
        $this->db->insert('riwayat_jabatan', $data);
    }

    public function update_profil($id, $data)
    {
        $this->db->where('id_user_detail', $id);
        $this->db->update('user', $data);
    }









    // -------------------------------------------------
    // USER / INDEX
    // -------------------------------------------------

    // DATATABLE RIWAYAT JABATAN
    var $order_column_usulan_jabatan = array(null, 'nama_pegawai', 'nama_bidang', 'nama_jabatan', null);

    public function make_query_usulan_jabatan()
    {
        if ($this->input->post('idUser')) {
            $this->db->where('riwayat_jabatan.id_pegawai', $this->input->post('idUser'));
        }

        $this->db->select('*');
        $this->db->from('riwayat_jabatan');
        $this->db->join('user_details', 'user_details.id_user_details = riwayat_jabatan.id_pegawai');
        $this->db->join('bidang', 'bidang.id_bidang = riwayat_jabatan.id_bidang');
        $this->db->join('jabatan', 'jabatan.id_jabatan = riwayat_jabatan.id_jabatan');
        $this->db->where('riwayat_jabatan.status_riwayat_jabatan', 1);
        $this->db->or_where('riwayat_jabatan.status_riwayat_jabatan', 0);
        $this->db->or_where('riwayat_jabatan.status_riwayat_jabatan', 2);

        if (isset($_POST["search"]["value"])) {
            $this->db->like('user_details.nama_pegawai', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_usulan_jabatan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_riwayat_jabatan', 'DESC');
        }
    }

    public function make_datatables_usulan_jabatan()
    {
        $this->make_query_usulan_jabatan();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_usulan_jabatan()
    {
        $this->make_query_usulan_jabatan();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_usulan_jabatan()
    {
        $this->db->select("*");
        $this->db->from('riwayat_jabatan');
        return $this->db->count_all_results();
    }
    // // END DATATABLE PEGAWAI
}
