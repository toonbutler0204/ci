<?php 

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->user_model->checkLogin($username, $password);
        if ($result->num_rows() > 0) {
            $user = $result->row();
            // ห่อหมก
            $data = [
                'user_id' => $user->user_id,
                'username' => $user->username,
                'fullname' => $user->fullname,
                'user_type_id' => $user->user_type_id,
                'email' => $user->email,
                'age' => $user->age
            ];
            // เก็บห่อหมก
            $this->session->set_userdata($data);
            redirect('/');
        } else {
            //fail logged in
            redirect('/');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
