<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller{
	function __construct(){
        parent::__construct();
	}
	function index(){
		//No think
	}
    function deleteimage(){
         $table = $this->input->post('table');
		 $field = $this->input->post('field');
		 $id = $this->input->post('id');
         $fielddelete = $this->input->post('fielddelete');
         $this->db->set($fielddelete,"");
		 $this->db->where($field,$id);
		 $this->db->update($table);
		 echo true;
         return;
	}
    function deletedata(){
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        $query = $this->db->where('id',$id)->delete($table);
        echo true;
        return;
	}
}
?>