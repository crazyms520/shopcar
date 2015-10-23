<?php
  Class user extends CI_Model{
    function __construct(){
      parent :: __construct();
    }
    public function get_user_by_acc_pas($account,$password){
      $user = $this->db->where('account',$account)
                       ->where('password',$password)
                       ->get('users')
                       ->result();
      if(count($user) > 0){
        return $user[0];
      }else{
        return null;
      }
    }

    public function get_user_by_id($user_id){
      $user = $this->db->where('id',$user_id)
                       ->get('users')
                       ->result();

    if(count($user) > 0 ){
        return $user[0];
      }else{
        return null;
      }
    }

    public function register($data){
      $this->db->insert('users',$data);
      return $this->db->insert_id();
    }

    public function get_all_books(){
      return $this->db->get('books')
                      ->result();

    }
  }