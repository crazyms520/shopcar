<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user');
		$this->load->helper('cookie');
	}
	public function index()
	{
		$login = $this->session->userdata('login');
		$user_id = $this->session->userdata('user_id');
		$user = $this->user->get_user_by_id($user_id);
		$navbar = $this->load->view('_navbar',array(
			'page' => 'home',
			'login' => $login
			),true);
		$this->load->view('welcome_message',array(
			'navbar' => $navbar,
			'user' => $user
			));
	}
	public function login(){
		$account = $this->input->post('account');
		$password = $this->input->post('password');
		$user = $this->user->get_user_by_acc_pas($account,$password);
		if($account && $password){
			if($user){
				$this->session->set_userdata('user_id',$user->id);
				$this->session->set_userdata('login','YES');
				$this->session->set_flashdata('message','登入成功');
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
	public function register(){
		$login = $this->session->userdata('login');
		$navbar = $this->load->view('_navbar',array(
			'login' => $login,
			'page' => ''
			),true);
		$this->load->view('register',array(
			'navbar' => $navbar
			));
	}
	public function register_post(){
		$account = $this->input->post('account');
		$name = $this->input->post('name');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		$user = $this->user->get_user_by_acc_pas($account,$password);
		if(!$user){
			if($password == $repassword){
				$id = $this->user->register(array(
					'account' => $account,
					'name' => $name,
					'password' => $password
					));
			}else{
				$this->session->set_flashdata('message','密碼確認錯誤');
				redirect('welcome/register');
			}
		}else{
			$this->session->set_flashdata('message','帳號重覆');
			redirect('welcome/register');
		}
		if($id){
			$this->session->set_flashdata('message','註冊成功快登入吧');
			return redirect(site_url('welcome'));
		}
		$this->load->view('register');
	}
	public function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('login');
		return redirect(site_url('welcome'));
	}

	public function shop(){
		$login = $this->session->userdata('login');
		$navbar = $this->load->view('_navbar',array(
			'page' => 'shop',
			'login' => $login
			),true);
		$books =  $this->user->get_all_books();
		$this->load->view('shop',array(
			'navbar' => $navbar,
			'books' => $books
			));
	}

	public function shop_post(){
		$name = $this->input->post('book_name');
		$quantity = $this->input->post('quantity');
		$book_name = $this->input->cookie('book_name');
		if(empty($book_name)){
			$this->input->set_cookie('book_name',$name,86500);
			$this->input->set_cookie('quantity',$quantity,86500);
		}else{
			$book_name_array = explode(",",$this->input->cookie('book_name'));
			$book_quantity_array = explode(",",$quantity);
			$book_name_array = $name;
			$this->input->set_cookie('book_name_array',implode(",",$book_name_array));
			$this->input->set_cookie('book_quantity_array',implode(",",$book_quantity_array));

		}
		if($name && $quantity){
			$this->session->set_flashdata('message','已放入購物車');
		}

		return redirect(site_url('welcome/shop'));
	}

	public function shopcar(){
		$book_name = $this->input->cookie('book_name_array');
		echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
		var_dump ($book_name);
		exit ();
		$this->load->view('shopcar',$book);
	}
}