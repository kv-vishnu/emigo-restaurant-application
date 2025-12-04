<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('website/Usermodel');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    // Registration form
    public function register() {
        $this->load->view('website/header');
        $this->load->view('website/register');
        $this->load->view('website/footer');
    }

    // Handle user registration
    public function register_user() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('website/header');
            $this->load->view('website/register');
            $this->load->view('website/footer');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );
            $this->Usermodel->insert_user($data);
            $this->session->set_flashdata('success', 'Registration successful');
            redirect('website/user/login');
        }
    }

    // Login form
    public function login() {
        $this->load->view('website/header');
        $this->load->view('website/login');
        $this->load->view('website/footer');
    }

    // Handle user login
    public function login_user() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('website/header');
            $this->load->view('login');
            $this->load->view('website/footer');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->Usermodel->get_user_by_email($email);
            
            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('username', $user->username);
                redirect('website/home');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('website/user/login');
            }
        }
    }

    // Dashboard for logged-in users
    // public function dashboard() {
    //     if (!$this->session->userdata('user_id')) {
    //         redirect('website/user/login');
    //     }

    //     $this->load->view('dashboard');
    // }

    // Logout
    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('success', 'Logged out successfully');
        redirect('website/user/login');
    }
}
