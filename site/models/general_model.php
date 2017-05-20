<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class General_model extends CI_Model{
	function __construct(){
        parent::__construct();
	}
    function getMetaData($id=NULL){
        $query = $this->db->select('*')
                ->from('seo')
                ->where('seo.id',$id)
                ->where("seo.bl_active",1)
                ->get()->row();
	    return $query;
    }
    
    /** Static content*/
    function getNewsStatic($code=NULL){
        $query = $this->db->select('*')
                ->from('content_static')
                ->where('code', $code)
                ->where('bl_active', 1)
                ->get()->row();
        return $query;
    }
    function getNewsStaticID($id=NULL){
        $query = $this->db->select('*')
                ->from('content_static')
                ->where('id', $id)
                ->where('bl_active', 1)
                ->get()->row();
        return $query;
    }
    
    function saveContact($data=NULL){
        if($this->db->insert('contact',$data)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
}