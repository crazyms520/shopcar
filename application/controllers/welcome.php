<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user');
	}
	public function index()
	{
		$login = $this->session->userdata('login');
		$navbar = $this->load->view('_navbar',array(
			'page' => 'home',
			'login' => $login
			),true);
		$this->load->view('welcome_message',array(
			'navbar' => $navbar
			));
	}

	public function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->user->get_user_by_mail_pas($email,$password);
		if($email && $password){
			if($user){
				$this->session->set_userdata('user_id',$user->id);
				$this->session->set_userdata('login','YES');
				redirect('welcome');
			}else{
				$this->session->set_flashdata('message','登入失敗');
				redirect('welcome');
			}
		}else{
			$this->session->set_flashdata('message','帳號密碼有誤');
			redirect('welcome');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */