<?php
  Class user extends CI_Model{
    function __construct(){
      parent :: __construct();
    }
    public function get_user_by_mail_pas($email,$password){
      $user = $this->db->where('email',$email)
                       ->where('password',$password)
                       ->get('users')
                       ->result();
      if(count($user) > 0){
        return $user[0];
      }else{
        return null;
      }
    }
  }