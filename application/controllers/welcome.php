<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user');
		$this->load->helper('cookie');
		$this->load->library('pagination');

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
		delete_cookie('book_name_list');
		delete_cookie('book_price_list');
		delete_cookie('book_quantity_list');
		return redirect(site_url('welcome'));
	}

	public function shop($per_page=1){
		$per_page = $this->input->get('per_page');

		$config['base_url'] = 'http://crazyms.com/shopcar/index.php/welcome/shop?';

		$config['total_rows'] = count($this->user->get_all_books());
		$config['per_page'] = 6;
		$config['use_page_numbers'] = true;
		$config['page_query_string'] = true;


		if($per_page){
        $offset = ($per_page-1) * $config['per_page'];
      }else{
        $offset = 0;
      }

    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';

    $config['first_link'] = '第一頁';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['prev_link'] = '上一頁';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['next_link'] = '下一頁';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['last_link'] = '最後頁';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);

    $books =  $this->user->get_books($config['per_page'],$offset);
    $pagination =  $this->pagination->create_links();

    $login = $this->session->userdata('login');
		$navbar = $this->load->view('_navbar',array(
			'page' => 'shop',
			'login' => $login
			),true);
		$this->load->view('shop',array(
			'navbar' => $navbar,
			'books' => $books,
			'pagination' => $pagination
			));
	}

	public function shop_post(){
		$login = $this->session->userdata('login');
		$name = $this->input->post('book_name');
		$quantity = $this->input->post('quantity');
		$price = $this->input->post('book_price')*$quantity;
		$book_name_list = $this->input->cookie('book_name_list');


		if($login === 'YES'){
			if(empty($this->input->cookie('book_name_list'))){
				$this->input->set_cookie('book_name_list',$name,3600);
				$this->input->set_cookie('book_price_list',$price,3600);
				$this->input->set_cookie('book_quantity_list',$quantity,3600);
				$this->session->set_flashdata('message','已放入購物車');
				return redirect(site_url('welcome/shop'));

			}else{
				$book_name_array = explode(' ',$this->input->cookie('book_name_list'));
				$book_name_array[]= $name ;
				$this->input->set_cookie('book_name_list',implode(' ',$book_name_array),3600);

				$book_price_array = explode(' ',$this->input->cookie('book_price_list'));
				$book_price_array[] = $price ;
				$this->input->set_cookie('book_price_list',implode(' ', $book_price_array),3600);

				$book_quantity_array = explode(' ', $this->input->cookie('book_quantity_list'));
				$book_quantity_array[] = $quantity;
				$this->input->set_cookie('book_quantity_list',implode(' ', $book_quantity_array),3600);
				$this->session->set_flashdata('message','已放入購物車');
				return redirect(site_url('welcome/shop'));
			}
		}else{
			$this->session->set_flashdata('message','請先登入');
			return redirect(site_url('welcome/shop'));
		}
	}

	public function shopcar(){
		$login = $this->session->userdata('login');
		$books = explode(' ',$this->input->cookie('book_name_list'));
		$prices = explode(' ', $this->input->cookie('book_price_list'));
		$quantitys = explode(' ', $this->input->cookie('book_quantity_list'));
		// echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
		// var_dump (implode(' ',$books));
		// echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
		// var_dump (isset($books));
		// echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
		// var_dump (empty($books));
		// exit ();

		$navbar = $this->load->view('_navbar',array(
			'page' => 'shopcar',
			'login' => $login
			),true);
		if($login === 'YES'){
			$this->load->view('shopcar',array(
				'books' => $books,
				'prices' => $prices,
				'quantitys' => $quantitys,
				'navbar' => $navbar
				));
		}else{
			$this->load->view('shopcar',array(
				'navbar' => $navbar,
				'login' => $login
				));
		}
	}
}