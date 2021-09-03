<?php

class Master_model extends CI_Model
{
    // DATATABLE ROLE
    var $table = "user_role";

    var $order_column = array(null, 'role', null);
    var $order_column2 = array(null, 'menu', null);
    var $order_column3 = array(null, 'menu_id', 'title', 'url', 'icon', 'is_active', null);


    public function make_query()
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if (isset($_POST["search"]["value"])) {
            $this->db->like('role', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'ASC');
        }
    }

    public function make_datatables()
    {
        $this->make_query();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // END DATATABLE ROLE

    // DATATABLE MENU
    public function make_query_menu()
    {
        $this->db->select('*');
        $this->db->from('user_menu');

        if (isset($_POST["search"]["value"])) {
            $this->db->like('menu', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'ASC');
        }
    }

    public function make_datatables_menu()
    {
        $this->make_query_menu();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_menu()
    {
        $this->make_query_menu();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_menu()
    {
        $this->db->select("*");
        $this->db->from('user_menu');
        return $this->db->count_all_results();
    }
    // END DATATABLE MENU

    // DATATABLE SUBMENU
    public function make_query_submenu()
    {
        $this->db->select('*');
        $this->db->from('user_sub_menu');
        $this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');

        if (isset($_POST["search"]["value"])) {
            $this->db->like('user_sub_menu.menu_id', $_POST["search"]["value"]);
            $this->db->or_like('user_sub_menu.title', $_POST["search"]["value"]);
            $this->db->or_like('user_sub_menu.url', $_POST["search"]["value"]);
            $this->db->or_like('user_sub_menu.is_active', $_POST["search"]["value"]);
        }

        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column3[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_submenu', 'ASC');
        }
    }

    public function make_datatables_submenu()
    {
        $this->make_query_submenu();

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_submenu()
    {
        $this->make_query_submenu();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_data_submenu()
    {
        $this->db->select("*");
        $this->db->from('user_sub_menu');
        return $this->db->count_all_results();
    }
    // END DATATABLE SUBMENU



    // -------------------------------------------------
    // ROLE MODEL
    // -------------------------------------------------
    public function add_role($data)
    {
        $this->db->insert('user_role', $data);
    }

    public function fetch_single_role($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('user_role');
        return $query->result();
    }

    public function edit_role($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user_role', $data);
    }

    public function delete_role($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }



    // -------------------------------------------------
    // MENU MODEL
    // -------------------------------------------------
    public function add_menu($data)
    {
        $this->db->insert('user_menu', $data);
    }

    public function fetch_single_menu($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('user_menu');
        return $query->result();
    }

    public function edit_menu($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
    }

    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }




    // -------------------------------------------------
    // SUB MENU MODEL
    // -------------------------------------------------
    public function add_submenu($data)
    {
        $this->db->insert('user_sub_menu', $data);
    }

    public function fetch_single_submenu($id)
    {
        $this->db->where('id_submenu', $id);
        $query = $this->db->get('user_sub_menu');
        return $query->result();
    }

    public function edit_submenu($id, $data)
    {
        $this->db->where('id_submenu', $id);
        $this->db->update('user_sub_menu', $data);
    }

    public function delete_submenu($id)
    {
        $this->db->where('id_submenu', $id);
        $this->db->delete('user_sub_menu');
    }
}
