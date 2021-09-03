<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    }
    // $role_id = $ci->session->userdata('role_id');
    // // $user_id = $ci->session->userdata('id_user_detail');
    // $role = $ci->uri->segment(1);

    // $queryMenu = $ci->db->get_where('user_menu', ['role' => $role])->row_array();
    // $menu_id = $queryMenu['id'];

    // $userAccess = $ci->db->get_where('user_access_menu', [
    //     'role_id' => $role_id,
    //     'menu_id' => $menu_id,
    //     // 'id_user_detail' => $user_id
    // ]);

    // if ($userAccess->num_rows() < 1 ) {
    //     redirect('auth/blocked');
    // }

}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

// function check_access2($user2, $menu_id)
// {
//     $ci = get_instance();

//     $ci->db->where('id_user_detail', $user2);
//     $ci->db->where('id_single_menu', $menu_id);
//     $result = $ci->db->get('user_access_single_menu');

//     if ($result->num_rows() > 0) {
//         return "checked='checked'";
//     }
// }
