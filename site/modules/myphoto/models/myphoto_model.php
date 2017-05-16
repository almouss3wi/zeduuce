<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Myphoto_Model extends MX_Controller { 
    public function __construct() {
        parent::__construct(); 
    }
    function getPhoto($user=NULL){
        $this->db->select('*')->from('user_image');
        if($user){
            $this->db->where("userID",$user);
        }
        $query = $this->db->get()->result();
        return $query;
    }
}