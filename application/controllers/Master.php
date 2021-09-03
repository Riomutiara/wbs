<?php

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Selamat Datang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('master/index', $data);
        $this->load->view('templates/footer');
    }





    // ---------------------------------------------------------------
    // ROLE 
    // ---------------------------------------------------------------
    public function role()
    {
        $data['title'] = 'SIPOLIN |';
        $data['title2'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('master/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($id)
    {
        $data['title'] = 'Setting |';
        $data['title2'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $id])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('master/role_access', $data);
        $this->load->view('templates/footer');
    }

    public function tableRole()
    {
        $fetch_data = $this->Master_model->make_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->role;
            $sub_array[] = '<a href="#" class="access" id="' . $row->id . '" data-toggle="tooltip" title="Akses"> <i class="ft-settings text-success mr-1"></i> </a>
                            <a href="#" class="delete" id="' . $row->id . '" data-toggle="tooltip" title="Hapus"> <i class="ft-trash text-danger"></i> </a>';
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Master_model->get_all_data(),
            "recordsFiltered"     => $this->Master_model->get_filtered_data(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function addRole()
    {
        if ($_POST['action'] == 'add') {
            $data = array(
                'role' => $this->input->post('role')
            );
            $this->Master_model->add_role($data);
            echo 'Role berhasil ditambahkan!';
        }
    }

    public function deleteRole()
    {
        $this->Master_model->delete_role($_POST['id']);
        echo "Role berhasil dihapus!";
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
            echo 'Akses Aktif';
        } else {
            $this->db->delete('user_access_menu', $data);
            echo 'Akses Non Aktif';
        }
    }







    // ---------------------------------------------------------------
    // MENU
    // ---------------------------------------------------------------
    public function menu()
    {
        $data['title'] = 'Setting |';
        $data['title2'] = 'Menu';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('master/menu', $data);
        $this->load->view('templates/footer');
    }

    public function tableMenu()
    {
        $fetch_data = $this->Master_model->make_datatables_menu();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->menu;
            $sub_array[] = '<a href="#" class="edit" id="' . $row->id . '" data-toggle="tooltip" title="Edit"> <i class="ft-edit mr-1"></i> </a>
            <a href="#" class="delete" id="' . $row->id . '" data-toggle="tooltip" title="Hapus"> <i class="ft-trash text-danger"></i> </a>';
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Master_model->get_all_data_menu(),
            "recordsFiltered"     => $this->Master_model->get_filtered_data_menu(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function addMenu()
    {
        if ($_POST['action'] == 'add') {
            $data = array(
                'menu' => $this->input->post('menu'),
                'icon' => $this->input->post('icon'),
                'role' => $this->input->post('role')
            );
            $this->Master_model->add_menu($data);
            echo 'Menu berhasil ditambahkan!';
        }

        if ($_POST['action'] == 'edit') {
            $data = array(
                'menu' => $this->input->post('menu'),
                'icon' => $this->input->post('icon'),
                'role' => $this->input->post('role')
            );
            $this->Master_model->edit_menu($this->input->post('id'), $data);
            echo 'Menu berhasil diedit!';
        }
    }

    public function fetchSingleMenu()
    {
        $output = array();
        $data = $this->Master_model->fetch_single_menu($_POST['id']);

        foreach ($data as $row) {
            $output['menu'] = $row->menu;
            $output['icon'] = $row->icon;
            $output['role'] = $row->role;
        }
        echo json_encode($output);
    }

    public function deleteMenu()
    {
        $this->Master_model->delete_menu($_POST['id']);
        echo "Menu berhasil dihapus!";
    }







    // ---------------------------------------------------------------
    // SUB MENU
    // ---------------------------------------------------------------
    public function submenu()
    {
        $data['title'] = 'Setting |';
        $data['title2'] = 'Sub Menu';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/topbar_menu', $data);
        $this->load->view('master/sub_menu', $data);
        $this->load->view('templates/footer');
    }

    public function tableSubMenu()
    {
        $fetch_data = $this->Master_model->make_datatables_submenu();
        $data = array();
        $no = $_POST['start'];
        foreach ($fetch_data as $row) {
            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = $row->menu;
            $sub_array[] = $row->title;                   
            $sub_array[] = $row->url;
            if ($row->is_active == 1) {
                $sub_array[] = '<span class="badge badge-primary">Aktif</span>';
            } else {
                $sub_array[] = '<span class="badge badge-danger">Tidak aktif</span>';
            }
            $sub_array[] = '<a href="#" class="edit" id="' . $row->id_submenu . '" data-toggle="tooltip" title="Edit"> <i class="ft-edit mr-1"></i> </a>
            <a href="#" class="delete" id="' . $row->id_submenu . '" data-toggle="tooltip" title="Hapus"> <i class="ft-trash text-danger"></i> </a>';
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                => intval($_POST['draw']),
            "recordsTotal"        => $this->Master_model->get_all_data_submenu(),
            "recordsFiltered"     => $this->Master_model->get_filtered_data_submenu(),
            "data"                => $data
        );
        echo json_encode($output);
    }

    public function addSubmenu()
    {
        if ($_POST['action'] == 'add') {
            $data = array(
                'menu_id'       => $this->input->post('menu_id'),
                'title'         => $this->input->post('title'),
                'url'           => $this->input->post('url'),
                'is_active'     => $this->input->post('is_active')                
            );
            $this->Master_model->add_submenu($data);
            echo 'Sub Menu berhasil ditambahkan!';
        }

        if ($_POST['action'] == 'edit') {
            $data = array(
                'menu_id'       => $this->input->post('menu_id'),
                'title'         => $this->input->post('title'),
                'url'           => $this->input->post('url'),
                'is_active'     => $this->input->post('is_active')
            );
            $this->Master_model->edit_submenu($this->input->post('id'), $data);
            echo 'Sub Menu berhasil diedit!';
        }
    }

    public function fetchSingleSubMenu()
    {
        $output = array();
        $data = $this->Master_model->fetch_single_submenu($_POST['id']);

        foreach ($data as $row) {
            $output['menu_id'] = $row->menu_id;
            $output['title'] = $row->title;
            $output['url'] = $row->url;
            $output['active'] = $row->is_active;            
        }
        echo json_encode($output);
    }

    public function deleteSubMenu()
    {
        $this->Master_model->delete_submenu($_POST['id']);
        echo "Menu berhasil dihapus!";
    }
}
