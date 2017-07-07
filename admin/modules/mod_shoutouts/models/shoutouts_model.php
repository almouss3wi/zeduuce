<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Shoutouts_model extends CI_Model{
	function __construct(){
        parent::__construct();
	}
	function getAllShoutouts($num=NULL,$offset=NULL,$search=NULL){
        if($search['name']){
            $where = "content LIKE '%".$search['name']."%'";
            $this->db->where($where);
        }
        $result = $this->db->select("us.*, u.name")
                ->from("user_shoutouts as us")
                ->join("user as u", "us.userId = u.id")
                ->order_by('id','DESC')
                ->get()->result();
		return $result;
	}
	function getNumShoutouts($search=NULL){
        if($search['name']){
            $where = "content LIKE '%".$search['name']."%'";
            $this->db->where($where);
        }
        $query = $this->db->get('user_shoutouts')->num_rows();
		return $query;
	}
	function saveEmail($data=NULL,$id=NULL){
        if($id){
            $this->db->where('id',$id);
            $this->db->update('email_template',$data);
            return $id;
        }else{
            if($this->db->insert('email_template',$data)){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
	}
	function getEmailByID($id=NULL){
		 $query = $this->db->where('id',$id)->get('email_template')->row();
		 return $query;
	}
	function delete($id=NULL){
		$this->db->where('id',$id);
        if($this->db->delete('user_shoutouts')){
            return true;
        }else{
            return false;
        }
	}
}
?>