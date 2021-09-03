<?php

class Admin_model extends CI_Model
{
    // -------------------------------------------------
    // MENU PEGAWAI
    // -------------------------------------------------
    public function tambah_pegawai($data)
    {
        $this->db->insert('user_details', $data);
    }

    public function fetch_single_pegawai($id)
    {
        $this->db->where('user_details.id_user_details', $id);
        $this->db->from('user_details', $id);
        $this->db->join('user', 'user.id_user_detail = user_details.id_user_details', 'LEFT');
        $this->db->join('bidang', 'bidang.id_bidang = user_details.id_bidang');
        $this->db->join('jabatan', 'jabatan.id_jabatan = user_details.id_jabatan');

        $query = $this->db->get();
        return $query->result();
    }

    public function edit_pegawai($id, $data)
    {
        $this->db->where('id_user_details', $id);
        $this->db->update('user_details', $data);
    }

    public function fetch_single_user($id)
    {
        $this->db->where('id_user_details', $id);
        $query = $this->db->get('user_details');
        return $query->result();
    }

    public function tambah_akses($data)
    {
        $this->db->insert('user', $data);
    }

    public function edit_akses($id, $data)
    {
        $this->db->where('id_user_detail', $id);
        $this->db->update('user', $data);
    }

    // DATATABLE PEGAWAI
    var $order_column = array(null, 'nama_pegawai', 'bidang', 'jabatan', 'jenis_kelamin', 'is_active', null);

    public function make_query_pegawai()
    {
        $this->db->select('*');
        $this->db->from('user_details');
        $this->db->join('user', 'user.id_user_detail = user_details.id_user_details', 'LEFT');
        $this->db->join('bidang', 'bidang.id_bidang = user_details.id_bidang', 'LEFT');
        $this->db->join('jabatan', 'jabatan.id_jabatan = user_details.id_jabatan', 'LEFT');

        if (isset($_POST["search"]["value"])) {
            $this->db->like('nama_pegawai', $_POST["search"]["value"]);
            $this->db->or_like('nip', $_POST["search"]["value"]);
            $this->db->or_like('tempat_lahir', $_POST["search"]["value"]);
            $this->db->or_like('tanggal_lahir', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_user_details', 'DESC');
        }
    }

    public function make_datatables_pegawai()
    {
        $this->make_query_pegawai();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_pegawai()
    {
        $this->make_query_pegawai();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_pegawai()
    {
        $this->db->select("*");
        $this->db->from('user_details');
        return $this->db->count_all_results();
    }
    // // END DATATABLE PEGAWAI




















    // -------------------------------------------------
    // INDEX ADMIN
    // -------------------------------------------------
    // CRUD
    public function verifikasi_usulan_jabatan($id, $data)
    {
        $this->db->where('id_riwayat_jabatan', $id);
        $this->db->update('riwayat_Jabatan', $data);
    }

    public function tolak_usulan_jabatan($id, $data)
    {
        $this->db->where('id_riwayat_jabatan', $id);
        $this->db->update('riwayat_Jabatan', $data);
    }

    public function non_aktif_usulan($id, $data)
    {
        $this->db->where('id_riwayat_jabatan', $id);
        $this->db->update('riwayat_Jabatan', $data);
    }

    public function fetch_single_usulan_jabatan($id)
    {
        $this->db->where('riwayat_jabatan.id_riwayat_jabatan', $id);
        $this->db->from('riwayat_jabatan');
        // $this->db->join('user', 'user.id_user_detail = riwayat_jabatan.id_pegawai');
        // $this->db->join('bidang', 'bidang.id_bidang = user_details.id_bidang');
        // $this->db->join('jabatan', 'jabatan.id_jabatan = user_details.id_jabatan');

        $query = $this->db->get();
        return $query->result();
    }



    // DATATABLE USULAN JABATAN
    var $order_column_usulan_jabatan = array(null, 'nama_pegawai', 'nama_bidang', 'nama_jabatan', 'status_riwayat_jabatan', null);

    public function make_query_usulan_jabatan()
    {
        $this->db->select('*');
        $this->db->from('riwayat_jabatan');
        $this->db->join('user_details', 'user_details.id_user_details = riwayat_jabatan.id_pegawai');
        $this->db->join('bidang', 'bidang.id_bidang = riwayat_jabatan.id_bidang');
        $this->db->join('jabatan', 'jabatan.id_jabatan = riwayat_jabatan.id_jabatan');
        // $this->db->where('riwayat_jabatan.status_riwayat_jabatan', 0);

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
    // END DATATABLE PEGAWAI





















    // -------------------------------------------------
    // MENU INPUT BIDANG
    // -------------------------------------------------
    public function tambah_bidang($data)
    {
        $this->db->insert('bidang', $data);
    }

    public function hapus_bidang($id)
    {
        $this->db->where('id_bidang', $id);
        $this->db->delete('bidang');
    }

    public function tambah_jabatan($data)
    {
        $this->db->insert('jabatan', $data);
    }

    public function hapus_jabatan($id)
    {
        $this->db->where('id_jabatan', $id);
        $this->db->delete('jabatan');
    }

    // DATATABLE BIDANG
    var $order_column_bidang = array(null, 'nama_bidang');

    public function make_query_bidang()
    {
        $this->db->select('*');
        $this->db->from('bidang');

        if (isset($_POST["search"]["value"])) {
            $this->db->like('nama_bidang', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_bidang[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_bidang', 'DESC');
        }
    }

    public function make_datatables_bidang()
    {
        $this->make_query_bidang();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_bidang()
    {
        $this->make_query_bidang();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_bidang()
    {
        $this->db->select("*");
        $this->db->from('bidang');
        return $this->db->count_all_results();
    }
    // // END DATATABLE BIDANG

    // DATATABLE JABATAN
    var $order_column_jabatan = array(null, 'nama_jabatan');

    public function make_query_jabatan()
    {
        $this->db->select('*');
        $this->db->from('jabatan');

        if (isset($_POST["search"]["value"])) {
            $this->db->like('nama_jabatan', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column_jabatan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_jabatan', 'DESC');
        }
    }

    public function make_datatables_jabatan()
    {
        $this->make_query_jabatan();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_jabatan()
    {
        $this->make_query_jabatan();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_jabatan()
    {
        $this->db->select("*");
        $this->db->from('jabatan');
        return $this->db->count_all_results();
    }
    // END DATATABLE JABATAN
}
