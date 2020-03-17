<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{	
		
		if($this->session->userdata('username') != ""){
			redirect(base_url(). 'dashboard');
		}
		
		$this->load->view('includes/header');
		$this->load->view('login_form');
		$this->load->view('includes/footer');
	}
	
	function validate_credentials(){
		$this->load->model('model_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->model_user->can_login($username,$password);
		if($user->type > -1 ){
			$session_data = array(
				'info' => $user,
				'uid' => $user->user_id,
				'username' => $username,
				'user_type' => $user->type
			);
			$this->session->set_userdata($session_data);
			
			redirect(base_url(). 'dashboard');
		}else{
			$this->session->set_flashdata('error','Invalid Username Or Password');
			redirect(base_url(). 'login');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url(). 'login');
	}

	function signup(){
		$this->load->view('includes/header');
		$this->load->view('signup_form');
		$this->load->view('includes/footer');
	}

}



